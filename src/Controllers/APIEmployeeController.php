<?php
namespace App\Controllers;

use App\Database\DatabaseConnection;
use App\Models\Employee;
use App\Services\EmployeeService;

class APIEmployeeController extends Controller {
    private $employeeService;

    public function __construct() {
        parent::__construct();
        $this->employeeService = new EmployeeService(DatabaseConnection::getInstance());
    }

    public function delete($id) {
        $employee = $this->employeeService->findById($id);
        if($employee && $this->employeeService->delete($employee)) {
            $this->outputJson([ 'success' => true ]);
        }
        else {
            $this->outputJson([ 'success' => false, 'error' => 'Unable to delete employee.' ]);
        }
    }
}