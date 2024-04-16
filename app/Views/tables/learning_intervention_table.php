<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Learning Interventions</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped learningInterventionTable">
                            <thead>
                            <tr>
                                <th>Intervention Name</th>
                                <th>Trainer/Provider</th>
                                <th>Competency</th>
                                <th>Cycle</th>
                                <th>Intervention Type</th>
                                <th>Cost</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- Loop through learning interventions and populate table rows -->
                            <?php use App\Models\CompetencyModel;
                            use App\Models\DevelopmentCycleModel;
                            use App\Models\InterventionTypeModel;
                            use App\Models\EmployeeModel;

                            if (!empty($learningInterventions) && is_array($learningInterventions)): ?>
                                <?php foreach ($learningInterventions as $intervention): ?>
                                    <?php
                                    $interventionTypeModel = model(InterventionTypeModel::class);
                                    $cycleModel = model(DevelopmentCycleModel::class);
                                    $employeeModel = model(EmployeeModel::class);
                                    $competencyModel = model(CompetencyModel::class);

                                    $trainer = $employeeModel->getEmployeeDetailsWithUser($intervention['trainer_id']);
                                    $cycle = $cycleModel->find($intervention['cycle_id']);
                                    $intervention_type = $interventionTypeModel->find($intervention['intervention_type_id']);
                                    $competency = $competencyModel->find($intervention['competency_id'])
                                    ?>
                                    <tr>
                                        <td><?= $intervention['intervention_name'] ?></td>
                                        <td><?= $trainer['first_name'] . ' ' . $trainer['last_name'] ?></td>
                                        <td><?= $competency['competency_name'] ?></td>
                                        <td><?= $cycle['cycle_year'] ?></td>
                                        <td><?= $intervention_type['name']; ?></td>
                                        <td><?= $intervention['cost']; ?></td>
                                        <td>
                                            <!-- Add action buttons for editing and deleting -->
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="<?= url_to('ldm.learning.intervention.edit', $intervention['id']) ?>">Edit</a>
                                                    <a class="dropdown-item" href="<?= url_to('ldm.learning.intervention.delete', $intervention['id']) ?>">Delete</a>
                                                </div>
                                            </div>
                                        </td>
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
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print"],
            "order": [[ 3, "desc" ]]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
