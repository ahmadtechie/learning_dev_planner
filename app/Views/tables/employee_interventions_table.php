<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Employee-Interventions Mappings</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped employeeInterventionsTable">
                            <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Cycle Year</th>
                                <th>Interventions</th>
                                <th>Email Sent?</th>
                                <th>Last Updated</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            use App\Models\EmployeeInterventionsModel;
                            use App\Models\LearningInterventionModel;
                            use App\Models\InterventionClassModel;
                            use App\Models\EmployeeModel;
                            use App\Models\DevelopmentCycleModel;
                            use App\Models\EmailLogModel;

                            $employeeInterventionsModel = model(EmployeeInterventionsModel::class);
                            $interventionModel = model(LearningInterventionModel::class);
                            $classModel = model(InterventionClassModel::class);
                            $cycleModel = model(DevelopmentCycleModel::class);
                            $employeeModel = model(EmployeeModel::class);
                            $emailLogModel = model(EmailLogModel::class);

                            $employeeInterventions = $employeeInterventionsModel
                                ->groupBy('id, employee_id, cycle_id')
                                ->findAll();


                            if (!empty($employeeInterventions) && is_array($employeeInterventions)) {
                                foreach ($employeeInterventions as $employeeIntervention) {
                                    $employee = $employeeModel->getEmployeeDetailsWithUser($employeeIntervention['employee_id']);
                                    if (!$employee) {
                                        continue;
                                    }
                                    $cycle_year = $cycleModel->find($employeeIntervention['cycle_id']);
                                    if (!$cycle_year) {
                                        continue;
                                    }
                                    $is_mail_sent = 0;

                                    $interventionsData = $employeeInterventionsModel
                                        ->where('employee_id', $employeeIntervention['employee_id'])
                                        ->where('cycle_id', $employeeIntervention['cycle_id'])
                                        ->findAll();

                                    $interventionClasses = [];
                                    foreach ($interventionsData as $interventionData) {
                                        $intervention = $interventionModel->find($interventionData['intervention_id']);
                                        if ($intervention) {
                                            $is_mail_sent = $emailLogModel
                                                ->where('type', 'employee_intervention_invite')
                                                ->where('email', $employee['email'])
                                                ->where('intervention_id', $interventionData['intervention_id'])
                                                ->countAllResults();
                                            $classIds = explode(',', $interventionData['class_id']);
                                            foreach ($classIds as $classId) {
                                                $class = $classModel->find($classId);
                                                if ($class) {
                                                    $interventionClasses[$intervention['intervention_name']][] = $class['class_name'];
                                                }
                                            }
                                        }
                                    }
                                    echo "<tr>";
                                    echo "<td>{$employee['first_name']} {$employee['last_name']} [{$employee['username']}]</td>";
                                    echo "<td>{$cycle_year['cycle_year']}</td>";
                                    echo "<td>";
                                    foreach ($interventionClasses as $interventionName => $classNames) {
                                        echo "{$interventionName}: " . implode(', ', $classNames) . "<br>";
                                    }
                                    echo "</td>";
                                    echo "<td>";
                                    if ($is_mail_sent) echo 'Yes'; else echo 'No';
                                    echo "</td>";
                                    echo "<td>{$employeeIntervention['updated_at']}</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No employee interventions found</td></tr>";
                            }
                            ?>
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
            "order": [[4, "desc"]],

        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
