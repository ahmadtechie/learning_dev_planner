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
                        <table id="example1" class="table table-bordered table-striped interventionClassTable">
                            <thead>
                            <tr>
                                <th>Intervention </th>
                                <th>Class Name</th>
                                <th>Cycle Year</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Venue</th>
                                <th>Updated At</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php use App\Models\DevelopmentCycleModel;
                            use App\Models\LearningInterventionModel;

                            if (!empty($interventionClasses) && is_array($interventionClasses)):
                            foreach ($interventionClasses as $class): ?>
                                <?php
                                $interventionModel = new LearningInterventionModel();
                                $intervention = $interventionModel->find($class['intervention_id']);
                                $cycleModel = new DevelopmentCycleModel();
                                $cycle = $cycleModel->find($intervention['cycle_id']);
                                ?>
                                <tr>
                                    <td><?= $intervention['intervention_name'] ?></td>
                                    <td><?= $class['class_name']; ?></td>
                                    <td><?= $cycle['cycle_year']; ?></td>
                                    <td><?= $class['start_date']; ?></td>
                                    <td><?= $class['end_date']; ?></td>
                                    <td><?= $class['venue']; ?></td>
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
                                                   href="#" onclick="confirmDelete(<?= $class['id'] ?>)">Delete</a>
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
    function confirmDelete(interventionClassId) {
        if (confirm("Are you sure you want to delete intervention class?")) {
            window.location.href = "<?= url_to('ldm.intervention.class.delete') ?>?intervention_class_id=" + interventionClassId;
        }
    }
</script>

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
            "order": [[6, "desc"]],

        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
