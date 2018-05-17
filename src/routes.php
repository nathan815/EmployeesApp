<?php
/**
 * All Routes/Endpoints
 */

return [

    // Web Request Routes
    [ 'GET', '/', 'EmployeeController', 'index'],
    [ 'GET', '/employees/{id}/edit', 'EmployeeController', 'edit' ],
    [ 'POST', '/employees/{id}/edit', 'EmployeeController', 'editSave' ],
    [ 'POST', '/employees/{id}/delete', 'EmployeeController', 'delete' ],
    [ 'GET', '/employees/new', 'EmployeeController', 'addForm' ],
    [ 'POST', '/employees/new', 'EmployeeController', 'add' ],

    // API/Ajax Routes
    [ 'GET', '/api/employees', 'APIEmployeeController', 'listAll' ],
    [ 'POST', '/api/employees', 'APIEmployeeController', 'create' ],
    [ 'PUT', '/api/employees/{id}', 'APIEmployeeController', 'update' ],
    [ 'DELETE', '/api/employees/{id}', 'APIEmployeeController', 'delete' ],

];