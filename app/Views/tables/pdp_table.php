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
                                    $assignedIntervention = '-';

                                    $interventionClasses = [];
                                    $is_competency_intervention_exist = $interventionModel->where('competency_id', $competency['id'])->findAll();
                                    if (!empty($is_competency_intervention_exist)) {
                                        foreach ($is_competency_intervention_exist as $competency_intervention) {
                                            $intervention = $interventionModel->find($competency_intervention['id']);
                                            if ($intervention) {
                                                if (!isset($intervention['class_id'])) continue;
                                                $classIds = explode(',', $intervention['class_id']);
                                                foreach ($classIds as $classId) {
                                                    $class = $classModel->find($classId);
                                                    if ($class) {
                                                        $interventionClasses[$intervention['intervention_name']][] = $class['class_name'];
                                                    }
                                                }
                                            }
                                        }
                                        foreach ($interventionClasses as $interventionName => $classNames) {
                                            $assignedIntervention .= "{$interventionName}: " . implode(', ', $classNames) . "<br>";
                                        }
                                    }
                                    ?>
                                    <tr>
                                        <td><?= $cycle['cycle_year'] ?></td>
                                        <td><?= $competency['competency_name'] ?></td>
                                        <td><?= $plan['average_rating'] ?></td>
                                        <td><?= $assignedIntervention ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
