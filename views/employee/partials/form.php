<form action="" method="post">
    <div class="form-group">
        <label for="fname">First Name:</label>
        <input type="text" name="first_name" id="fname" class="form-control" value="<?= isset($employee) ? $employee->first_name : '' ?>" />
    </div>
    <div class="form-group">
        <label for="lname">Last Name:</label>
        <input type="text" name="last_name" id="lname" class="form-control" value="<?= isset($employee) ? $employee->last_name : '' ?>" />
    </div>
    <button type="submit" class="btn btn-primary">
        <?= $type == 'add' ? 'Create' : 'Save Changes' ?>
    </button>
</form>