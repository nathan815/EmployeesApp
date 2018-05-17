<?php
namespace App\Models;

class Employee extends Model {

    const FIRST_NAME_MAX_LENGTH = 30;
    const LAST_NAME_MAX_LENGTH = 30;

    public $id;
    public $first_name;
    public $last_name;
    public $created_at;

    public function isValid() {
        $this->validateFirstName();
        $this->validateLastName();
        return !$this->hasErrors();
    }

    private function validateFirstName() {
        $length = strlen($this->first_name);
        if(!is_string($this->first_name) || $length === 0) {
            $this->addError('First name is required');
        }
        else if($length > self::FIRST_NAME_MAX_LENGTH) {
            $this->addError('First name cannot exceed ' . self::FIRST_NAME_MAX_LENGTH . ' characters');
        }
    }

    private function validateLastName() {
        $length = strlen($this->last_name);
        if(!is_string($this->last_name) || $length === 0) {
            $this->addError('Last name is required');
        }
        else if($length > self::LAST_NAME_MAX_LENGTH) {
            $this->addError('First name cannot exceed ' . self::LAST_NAME_MAX_LENGTH . ' characters');
        }
    }

}