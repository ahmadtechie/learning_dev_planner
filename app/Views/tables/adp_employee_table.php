<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Employees With Competency Need</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped employeeTable">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email Address</th>
                                <th>Job</th>
                                <th>Line Manager</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            use App\Models\JobModel;

                            if (!empty($employeesWithCompetency) && is_array($employeesWithCompetency)): ?>
                                <?php foreach ($employeesWithCompetency

                                               as $employee): ?>
                                    <?php
                                    $jobModel = new JobModel();
                                    $jobData = $jobModel->find($employee['job_id']);
                                    ?>
                                    <tr>
                                        <td><?= $employee['first_name'] . ' ' . $employee['last_name'] . ' [' . $employee['username'] . ']' ?? '' ?></td>
                                        <td><?= $employee['email'] ?? '' ?></td>
                                        <td><?= $jobData['job_title'] ?? '' ?></td>
                                        <td><?= $employee['line_manager_name'] ?? '-' ?></td>
                                    </tr>
                                <?php endforeach; ?>
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
            "order": [[0, "desc"]],

        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>