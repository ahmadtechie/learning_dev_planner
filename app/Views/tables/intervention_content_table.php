<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Intervention Content</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Learning Intervention</th>
                    <th>Modules</th>
                    <th>Updated At</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php use App\Models\LearningInterventionModel;

                if (!empty($interventionContent)): ?>
                    <?php foreach ($interventionContent as $content): ?>
                        <?php
                        $interventionModel = new LearningInterventionModel();
                        $intervention = $interventionModel->find($content['intervention_id']);
                        ?>
                        <tr>
                            <td><?= $intervention['intervention_name'] . ' [' . $intervention['intervention_id']  . ']'?></td>
                            <td><?= $content['modules'] ?></td>
                            <td><?= $content['updated_at'] ?></td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                           href="<?= url_to('ldm.intervention.content.edit', $content['id']) ?>">Edit</a>
                                        <a class="dropdown-item"
                                           href="#" onclick="confirmDelete(<?= $content['id'] ?>)">Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No intervention content found.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<script>
    function confirmDelete(contentId) {
        if (confirm("Are you sure you want to delete this content?")) {
            window.location.href = "<?= url_to('ldm.intervention.content.delete') ?>?content_id=" + contentId;
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
            "order": [[2, "desc"]],

        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
