<header class="card text-center bg-light text-dark rounded p-3 mb-4">
    <h3>Edit Details</h3>
    <p class="m-0">Employee #<?=$employee->id?></p>
</header>

<?php include_view('employee/partials/form', [ 'employee' => $employee, 'type' => 'edit' ]); ?>