<?php
$loggedInEmployeeId = session()->get('loggedInEmployee');

?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Personal Development Plans</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered competencyTable table-striped">
                            <thead>
                            <tr>
                                <th>Cycle</th>
                                <th>Competency</th>
                                <th>Average Rating</th>
                                <th>Assigned Intervention</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            use App\Models\CompetencyModel;
                            use App\Models\DevelopmentCycleModel;
                            use App\Models\EmailLogModel;
                            use App\Models\EmployeeInterventionsModel;
                            use App\Models\InterventionClassModel;
                            use App\Models\LearningInterventionModel;

                            if (!empty($myPlans)):
                                foreach ($myPlans as $plan):
                                    $devCycleModel = model(DevelopmentCycleModel::class);
                                    $competencyModel = model(CompetencyModel::class);
                                    $interventionModel = model(LearningInterventionModel::class);
                                    $employeeInterventionModel = model(EmployeeInterventionsModel::class);
                                    $emailLogModel = model(EmailLogModel::class);
                                    $classModel = model(InterventionClassModel::class);
                                    $cycle = $devCycleModel->find($plan['cycle_id']);
                                    $competency = $competencyModel->find($plan['competency_id']);
                                    $assignedIntervention = '';

                                    $employeeInterventions = $employeeInterventionModel
                                        ->select('employee_interventions.*, learning_intervention.competency_id')
                                        ->join('learning_intervention', 'learning_intervention.id = employee_interventions.intervention_id')
                                        ->where('employee_id', $loggedInEmployeeId)
                                        ->where('learning_intervention.competency_id', $competency['id'])
                                        ->findAll();

                                    if (!empty($employeeInterventions)) {
                                        foreach ($employeeInterventions as $employeeIntervention) {
                                            $intervention = $interventionModel->find($employeeIntervention['intervention_id']);
                                            if ($intervention) {
                                                $classIds = explode(',', $employeeIntervention['class_id']);
                                                $classNames = [];
                                                foreach ($classIds as $classId) {
                                                    $class = $classModel->find($classId);
                                                    if ($class) {
                                                        $classNames[] = $class['class_name'];
                                                    }
                                                }
                                                $assignedIntervention .= "{$intervention['intervention_name']}: " . implode(', ', $classNames) . "<br>";
                                            }
                                        }
                                    } else {
                                        $assignedIntervention = '-';
                                    }
                                    ?>
                                    <tr>
                                        <td><?= $cycle['cycle_year'] ?></td>
                                        <td><?= $competency['competency_name'] ?></td>
                                        <td><?= $plan['average_rating'] ?></td>
                                        <td><?= $assignedIntervention ?></td>
                                    </tr>
                                <?php
                                endforeach;
                            else:
                                ?>
                                <tr>
                                    <td colspan="4">No plans found</td>
                                </tr>
                            <?php
                            endif;
                            ?>
                            </tbody>
                        </table>
                    </div>
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
