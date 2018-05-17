<header class="card card-body bg-light text-dark rounded p-3 mb-4 flex-row justify-content-between">
    <h4>All Employees</h4>
    <a href="/employees/new" class="btn btn-success"><i class="fas fa-plus"></i> Add Employee</a>
</header>
<?php if($employees): ?>
    <table class="table table-hover mt-4 employees">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Created</th>
                <th>Updated</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($employees as $employee): ?>
            <tr data-id="<?=$employee->id?>">
                <td><?=$employee->id?></td>
                <td><?=$employee->first_name?></td>
                <td><?=$employee->last_name?></td>
                <td>
                    <time class="timeago" datetime="<?=$employee->created_at?>"><?=$employee->created_at?></time>
                </td>
                <td>
                    <time class="timeago" datetime="<?=$employee->updated_at?>"><?=$employee->updated_at ? $employee->updated_at : '--'?></time>
                </td>
                <td>
                    <form action="/employees/<?=$employee->id?>/delete" method="post" class="delete text-right">
                        <a href="/employees/<?=$employee->id?>/edit" class="btn btn-secondary btn-sm edit">
                            <i class="fas fa-pencil-alt"></i> Edit
                        </a>
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash delete"></i> Delete
                        </button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <div class="alert alert-secondary mt-3">There are no employees.</div>
<?php endif; ?>