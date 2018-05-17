<?php
/**
 * All Routes/Endpoints
 */

return [
    [ 'GET', '/', 'EmployeeController', 'index'],

    [ 'GET', '/employees/{id}/edit', 'EmployeeController', 'edit' ],
    [ 'POST', '/employees/{id}/edit', 'EmployeeController', 'editSave' ],

    [ 'POST', '/employees/{id}/delete', 'EmployeeController', 'delete' ],

    [ 'GET', '/employees/new', 'EmployeeController', 'addForm' ],
    [ 'POST', '/employees/new', 'EmployeeController', 'add' ],
];