<?php
namespace App\Controllers;

use App\Database\DatabaseConnection;
use App\Models\Employee;
use App\Services\EmployeeService;
use App\Utils\FlashMessage;

class EmployeeController extends Controller {
    private $employeeService;

    public function __construct() {
        parent::__construct();
        $this->employeeService = new EmployeeService(DatabaseConnection::getInstance());
    }

    public function index() {
        $employees = $this->employeeService->getAllEmployees('created_at DESC');
        $this->view->render('home', [
            'title' => 'All Employees',
            'employees' => $employees
        ]);
    }

    public function edit($id) {
        $employee = $this->employeeService->findById($id);
        if(!$employee) {
            $this->outputError(404);
        }
        $this->view->render('employee/edit', [
            'title' => 'Edit Employee ' . $id,
            'employee' => $employee
        ]);
    }

    public function editSave($id) {
        $firstName = $this->request->post('first_name');
        $lastName = $this->request->post('last_name');
        $employee = $this->employeeService->findById($id);
        if(!$employee) {
            $this->outputError(404);
        }
        $isChanged = $employee->first_name != $firstName || $employee->last_name != $lastName;
        if($isChanged) {
            $employee->first_name = $firstName;
            $employee->last_name = $lastName;
            if($employee->isValid()) {
                if($this->employeeService->update($employee)) {
                    FlashMessage::send('Employee details have been updated.', 'success');
                }
                else {
                    FlashMessage::send('Error updating employee', 'danger');
                }
            }
            else {
                FlashMessage::send('<b>Error:</b> ' . $employee->getErrorString(), 'danger');
                $this->sendBackFormData([ 'employee' => $employee ]);
            }
        }
        $this->redirect('/employees/' . $id . '/edit');
    }

    public function addForm() {
        $this->view->render('employee/add', [ 'title' => 'Add Employee' ]);
    }

    public function add() {
        $firstName = $this->request->post('first_name');
        $lastName = $this->request->post('last_name');
        $employee = new Employee();
        $employee->first_name = $firstName;
        $employee->last_name =$lastName;
        $redirectUrl = '/employees/new';
        if($employee->isValid()) {
            if($this->employeeService->create($employee)) {
                FlashMessage::send('Created employee successfully.', 'success');
                $redirectUrl = '/';
            }
            else {
                FlashMessage::send('Unable to create employee.', 'danger');
            }
        }
        else {
            FlashMessage::send('<b>Error:</b> ' . $employee->getErrorString(), 'danger');
        }
        $this->redirect($redirectUrl);
    }

    public function delete($id) {
        $employee = $this->employeeService->findById($id);
        if($employee) {
            if($this->employeeService->delete($employee)) {
                FlashMessage::send('Deleted employee ' . $id . ' successfully.', 'secondary');
            }
            else {
                FlashMessage::send('Unable to delete employee.', 'danger');
            }
        }
        else {
            FlashMessage::send('Employee ' . $id . ' does not exist.', 'danger');
        }
        $this->redirect('/');
    }
}