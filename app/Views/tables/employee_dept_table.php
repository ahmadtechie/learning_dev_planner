<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Employee Departments/Units</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="EmployeeDeptTable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Department</th>
                                <th>Unit</th>
                                <th>Updated At</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($employees) && is_array($employees)): ?>
                                <?php foreach ($employees as $employee): ?>
                                    <tr>
                                        <td><?= "{$employee['first_name']} {$employee['last_name']}"  ?></td>
                                        <td><?= $employee['department_name']; ?></td>
                                        <td><?= $employee['unit_name']; ?></td>
                                        <td><?= $employee['updated_at']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5">No employee organizational record found</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>
