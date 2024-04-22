<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Intervention Attendance Statuses</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered competencyTable table-striped">
                            <thead>
                            <tr>
                                <th>Intervention Name</th>
                                <th>Employee</th>
                                <th>Attendance Status</th>
                                <th>Attendance Date</th>
                                <th>Remarks</th>
                                <th>Updated At</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            use App\Models\EmployeeModel;
                            use App\Models\LearningInterventionModel;

                            $employeeModel = model(EmployeeModel::class);
                            $interventionModel = model(LearningInterventionModel::class);
                            ?>
                            <?php if (!empty($all_attendance) && is_array($all_attendance)): ?>
                                <?php foreach ($all_attendance as $attendance): ?>
                                    <?php
                                        $employeeData = $employeeModel->getEmployeeDetailsWithUser($attendance['employee_id']);
                                        $intervention = $interventionModel->find($attendance['intervention_id']);
                                    ?>
                                    <tr>
                                        <td><?= $intervention['intervention_name']; ?></td>
                                        <td><?= $employeeData['first_name'] . ' ' . $employeeData['last_name']; ?></td>
                                        <td><?= $attendance['attendance_status']; ?></td>
                                        <td><?= $attendance['attendance_date']; ?></td>
                                        <td><?= $attendance['remarks']; ?></td>
                                        <td><?= $attendance['updated_at']; ?></td>
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
            "order": [[5, "desc"]],

        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>