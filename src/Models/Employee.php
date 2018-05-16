<?php
namespace App\Models;

class Employee extends Model {

    protected $tableName = 'employees';

    public $id;
    public $first_name;
    public $last_name;

}