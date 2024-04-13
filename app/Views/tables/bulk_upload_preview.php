<?php if (!empty($errors)) : ?>
    <div class="alert alert-danger" role="alert">
        <ul>
            <?php foreach ($errors as $error) : ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<!-- Display validated CSV data -->
<?php if (!empty($data)) : ?>
    <table class="table">
        <thead>
            <tr>
                <th>Email</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Job</th>
                <th>Employee Roles</th>
                <th>Department</th>
                <th>Unit</th>
                <th>Line Manager</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $row) : ?>
                <tr>
                    <td><?= esc($row['email']) ?></td>
                    <td><?= esc($row['first_name']) ?></td>
                    <td><?= esc($row['last_name']) ?></td>
                    <td><?= esc($row['job']) ?></td>
                    <td><?= esc($row['employee_roles']) ?></td>
                    <td><?= esc($row['department']) ?></td>
                    <td><?= esc($row['unit']) ?></td>
                    <td><?= esc($row['line_manager']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
