<a href="/employees/new" class="btn btn-success"><i class="fas fa-plus"></i> Add Employee</a>
<span class="clearfix"></span>
<?php if($employees): ?>
    <table class="table mt-4">
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Created</th>
            <th>Updated</th>
            <th></th>
        </tr>
        <?php foreach($employees as $employee): ?>
        <tr>
            <td><?=$employee->id?></td>
            <td><?=$employee->first_name?></td>
            <td><?=$employee->last_name?></td>
            <td>
                <time class="timeago" datetime="<?=$employee->created_at?>"><?=$employee->created_at?></time>
            </td>
            <td>
                <time class="timeago" datetime="<?=$employee->updated_at?>"><?=$employee->updated_at ? $employee->updated_at : '--'?></time>
            </td>
            <td class="pr-0">
                <form action="/employees/<?=$employee->id?>/delete" method="post" class="text-right">
                    <a href="/employees/<?=$employee->id?>/edit" class="btn btn-secondary btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <div class="alert alert-secondary mt-3">There are no employees.</div>
<?php endif; ?>