<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <?php if (isset($thisEmployee)): ?>
                            <h3 class="card-title">Competency Needs for Employee: <strong><?= $thisEmployee['first_name'] ?> <?= $thisEmployee['last_name'] ?></strong></h3>
                        <?php elseif (isset($thisLineManager)): ?>
                            <h3 class="card-title">Competency Needs of <strong><?= $thisLineManager['first_name'] ?> <?= $thisLineManager['last_name'] ?>'s</strong> Direct Reports</h3>
                        <?php elseif (isset($thisUnit)): ?>
                            <h3 class="card-title">Competency Needs of Employees in Unit: <strong><?= $thisUnit['unit_name'] ?></strong></h3>
                        <?php elseif (isset($thisDepartment)): ?>
                            <h3 class="card-title">Competency Needs of Employees in Department: <strong><?= $thisDepartment['department_name'] ?></strong></h3>
                        <?php elseif (isset($thisGroup)): ?>
                            <h3 class="card-title">Competency Needs of Employees in Group: <strong><?= $thisGroup['group_name'] ?></strong></h3>
                        <?php elseif (isset($thisDivision)): ?>
                            <h3 class="card-title">Competency Needs of Employees in Division: <strong><?= $thisDivision['division_name'] ?></strong></h3>
                        <?php else: ?>
                            <h3 class="card-title">Competency Needs for Employees</h3>
                        <?php endif; ?>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Competency Name</th>
                                <th>Competency Type</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            use App\Models\CompetencyTypeModel;
                            $competencyTypeModel = model(CompetencyTypeModel::class);
                            ?>
                            <?php if (!empty($competencies) && is_array($competencies)): ?>
                                <?php foreach ($competencies as $competency): ?>

                                    <tr data-division-id="<?= $competency['id'] ?>">
                                        <?php if($competency['competency_type_id']) $competencyType = $competencyTypeModel->find($competency['competency_type_id'])['name']; else $competencyType = '' ?>
                                        <td><?= $competency['competency_name']; ?></td>
                                        <td><?= $competencyType ?></td>
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