<a href="/employees/new" class="btn btn-success"><i class="fas fa-plus"></i> Add Employee</a>
<span class="clearfix"></span>
<?php if($employees): ?>
    <table class="table mt-4">
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Created</th>
            <th></th>
        </tr>
        <?php foreach($employees as $employee): ?>
        <tr>
            <td><?=$employee->id?></td>
            <td><?=$employee->first_name?></td>
            <td><?=$employee->last_name?></td>
            <td><?=$employee->created_at?></td>
            <td>
                <form action="/employees/<?=$employee->id?>/delete" method="post" class="text-right">
                    <a href="/employees/<?=$employee->id?>/edit" class="btn btn-secondary btn-sm mr-2"><i class="fas fa-pencil-alt"></i> Edit</a>
                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <div class="alert alert-secondary mt-3">There are no employees.</div>
<?php endif; ?>