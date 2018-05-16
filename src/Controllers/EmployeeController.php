<?php
namespace App\Controllers;

use App\Models\Employee;
use App\Utils\FlashMessage;

class EmployeeController extends Controller {
    private $employee;

    public function __construct()
    {
        parent::__construct();
        $this->employee = new Employee();
    }

    public function index() {
        $employees = $this->employee->getAll('*', 'created_at DESC');
        $this->view->assign('title', 'All Employees');
        $this->view->assign('employees', $employees);
        $this->view->render('home');
    }

    public function edit($id) {
        $employee = $this->employee->findById($id);
        if(!$employee) {
            $this->outputError(404);
        }
        $this->view->assign('title', 'Edit Employee ' . $id);
        $this->view->assign('employee', $employee);
        $this->view->render('employee/edit');
    }
    public function editSave($id) {
        $firstName = $this->request->post('first_name');
        $lastName = $this->request->post('last_name');
        $employeeModel = new Employee();
        $employee = $employeeModel->findById($id);
        if($employee->first_name != $firstName || $employee->last_name != $lastName) {
            $data = [
                'first_name' => $firstName,
                'last_name' => $lastName
            ];
            if($employeeModel->update($id, $data)) {
                FlashMessage::send('Employee updated.', 'success');
            }
            else {
                FlashMessage::send('Error updating employee', 'danger');
            }
        }
        $this->redirect('/employees/' . $id . '/edit');
    }

    public function addForm() {
        $this->view->render('employee/add');
    }

    public function add() {
        $firstName = $this->request->post('first_name');
        $lastName = $this->request->post('last_name');
        $employeeModel = new Employee();
        $isCreated = $employeeModel->create([
            'first_name' => $firstName,
            'last_name' => $lastName
        ]);
        if($isCreated) {
            FlashMessage::send('Created employee successfully.', 'success');
        }
        else {
            FlashMessage::send('Unable to create employee.', 'danger');
        }
        $this->redirect('/');
    }

    public function delete($id) {
        $employeeModel = new Employee();
        $isDeleted = $employeeModel->delete($id);
        if($isDeleted) {
            FlashMessage::send('Deleted employee ' . $id . ' successfully.', 'secondary');
        }
        else {
            FlashMessage::send('Unable to delete employee.', 'danger');
        }
        $this->redirect('/');
    }
}