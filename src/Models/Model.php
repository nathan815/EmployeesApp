<?php
namespace App\Models;

use App\Database\DatabaseConnection;
use App\Database\DataQuery;

abstract class Model {

    protected $validationErrors = [];

    public abstract function isValid();

    public function getErrors() {
        return $this->validationErrors;
    }

    public function getErrorString() {
        return implode(', ', $this->validationErrors);
    }

    protected function addError($message) {
        $this->validationErrors[] = $message;
    }

    protected function hasErrors() {
        return sizeof($this->validationErrors) > 0;
    }

}