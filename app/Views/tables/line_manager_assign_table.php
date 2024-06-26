<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Line Manager Assignments</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped lineManagerAssignTable">
                            <thead>
                            <tr>
                                <th>Line Manager</th>
                                <th>Job Title</th>
                                <th>Direct Reports</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($line_managers) && is_array($line_managers)): ?>
                                <?php foreach ($line_managers as $line_manager): ?>
                                <?php
                                    $employeeModel = model(\App\Models\EmployeeModel::class);
                                    $employees_under_manager = $employeeModel->getEmployeesUnderLineManager($line_manager['employee_id'])
                                ?>
                                    <tr>
                                        <td><?= "{$line_manager['first_name']} {$line_manager['last_name']}" . " [" . $line_manager['username'] . "]" ?></td>
                                        <td><?= $line_manager['job_title']; ?></td>
                                        <td>
                                            <?php if (!empty($employees_under_manager) && is_array($employees_under_manager)): ?>
                                                <?php foreach ($employees_under_manager as $employee_under_manager): ?>
                                                    <?= "{$employee_under_manager['first_name']} {$employee_under_manager['last_name']}," ?>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                        </td>
                                        <td><?= $line_manager['updated_at']; ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button"
                                                        class="btn btn-secondary dropdown-toggle"
                                                        data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item edit-btn"
                                                       href="<?= url_to('ldm.line.manager.edit', $line_manager['employee_id']) ?>">Edit</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5">No line manager assignments found</td>
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

<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": [
                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible'
                    }
                }
                , "colvis",
            ],
            "order": [[3, "desc"]],

        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
