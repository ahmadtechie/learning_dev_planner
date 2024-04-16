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
                                <th>Interventions</th>
                                <th>Updated At</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            use App\Models\EmployeeInterventionsModel;
                            use App\Models\LearningInterventionModel;

                            $employeeInterventionsModel = model(EmployeeInterventionsModel::class);
                            $interventionModel = model(LearningInterventionModel::class);
                            ?>
                            <?php if (!empty($employees) && is_array($employees)): ?>
                                <?php foreach ($employees as $employee): ?>
                                    <?php $employeeInterventions = $employeeInterventionsModel->where('employee_id', $employee['employee_id'])->findAll() ?>
                                    <tr>
                                        <td><?= "{$employee['first_name']} {$employee['last_name']} [{$employee['username']}]"  ?></td>
                                        <td><?php if (!empty($employeeInterventions)): ?>
                                                <?php foreach ($employeeInterventions as $employeeIntervention): ?>
                                                    <?php $intervention = $interventionModel->find($employeeIntervention['intervention_id']) ?>
                                                    <?= $intervention['intervention_name'] . ', ' ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?></td>
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
