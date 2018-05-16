<header class="card text-center bg-light text-dark rounded p-3 mb-4">
    <h4>Add Employee</h4>
</header>

<?php include_view('employee/partials/form', [ 'employee' => null, 'type' => 'add' ]); ?>