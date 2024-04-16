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
                                <th>Intervention ID</th>
                                <th>Class Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Venue</th>
                                <th>Updated At</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($interventionClasses as $class): ?>
                                <?php
                                $interventionModel = new \App\Models\LearningInterventionModel();
                                $intervention = $interventionModel->find($class['intervention_id']);
                                ?>

                                <tr>
                                    <td><?= $intervention['intervention_name'] ?></td>
                                    <td><?= $class['class_name']; ?></td>
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

<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print"],
            "order": [[ 5, "desc" ]]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
