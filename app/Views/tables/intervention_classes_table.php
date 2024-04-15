<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Intervention Classes</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="interventionClassTable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Intervention ID</th>
                                <th>Class Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Venue</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($interventionClasses as $class): ?>
                                <?php
                                $intervention_str = '-';
                                if (!empty($class['intervention_id'])) {
                                    $interventionModel = new \App\Models\LearningInterventionModel();
                                    $intervention = $interventionModel->find($class['intervention_id']);
                                    if (!empty($intervention)) {
                                        $cycleModel = model(\App\Models\DevelopmentCycleModel::class);
                                        $employeeModel = model(\App\Models\EmployeeModel::class);
                                        $cycle = $cycleModel->find($intervention['cycle_id']);
                                        $employee = $employeeModel->getEmployeeDetailsWithUser($intervention['trainer_id']);
                                        $intervention_str = $employee['first_name'] . ' ' . $employee['last_name'] . ' - ' . $cycle['cycle_year'];
                                    }
                                }
                                ?>

                                <tr>
                                    <td><?= $intervention_str ?></td>
                                    <td><?= $class['class_name']; ?></td>
                                    <td><?= $class['start_date']; ?></td>
                                    <td><?= $class['end_date']; ?></td>
                                    <td><?= $class['venue']; ?></td>
                                    <td><?= $class['created_at']; ?></td>
                                    <td><?= $class['updated_at']; ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-secondary dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                   href="<?= url_to('ldm.intervention.class.edit', $class['id']) ?>">Edit</a>
                                                <a class="dropdown-item"
                                                   href="<?= url_to('ldm.intervention.class.delete', $class['id']) ?>">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>
