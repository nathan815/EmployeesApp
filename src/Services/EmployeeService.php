<?php
namespace App\Services;

use App\Models\Employee;

class EmployeeService extends Service {

    /** @return Employee[] */
    public function getAllEmployees($orderBy = null, $limit = null) {
        $sql = "SELECT * FROM employees";
        if($orderBy) {
            $sql .= " ORDER BY $orderBy";
        }
        if(is_int($limit)) {
            $sql .= " LIMIT $limit";
        }
        $this->dataQuery->query($sql);
        return $this->dataQuery->fetchAllIntoObjects('App\Models\Employee');
    }

    /** @return Employee */
    public function findById($id) {
        $sql = "SELECT * FROM employees WHERE id = :id";
        $this->dataQuery->preparedQuery($sql, ['id' => $id]);
        $employee = $this->dataQuery->fetchRowIntoObject('App\Models\Employee');
        return $employee;
    }

    public function update(Employee $employee) {
        $sql = "UPDATE employees SET first_name = :first_name, last_name = :last_name, updated_at = now() WHERE id = :id";
        $this->dataQuery->preparedQuery($sql, [
            'first_name' => $employee->first_name,
            'last_name' => $employee->last_name,
            'id' => $employee->id
        ]);
        return $this->dataQuery->rowsAffected();
    }

    public function create(Employee $employee) {
        $sql = "INSERT INTO  employees ( first_name, last_name, created_at ) VALUES ( :first_name, :last_name, now() )";
        $this->dataQuery->preparedQuery($sql, [
            'first_name' => $employee->first_name,
            'last_name' => $employee->last_name
        ]);
        return $this->dataQuery->rowsAffected();
    }

    public function delete(Employee $employee) {
        $sql = "DELETE FROM employees WHERE id = :id";
        $this->dataQuery->preparedQuery($sql, [
            'id' => $employee->id
        ]);
        return $this->dataQuery->rowsAffected();
    }

}