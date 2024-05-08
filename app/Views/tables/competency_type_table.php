<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Intervention Types</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped interventionTypesTable">
                            <thead>
                            <tr>
                                <th>Type Name</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($competencyTypes) && is_array($competencyTypes)): ?>
                                <?php foreach ($competencyTypes as $competencyType): ?>
                                    <tr>
                                        <td><?= esc($competencyType['name']); ?></td>
                                        <td><?= esc($competencyType['created_at']); ?></td>
                                        <td><?= esc($competencyType['updated_at']); ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button"
                                                        class="btn btn-secondary dropdown-toggle"
                                                        data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item edit-btn"
                                                       href="<?= url_to('ldm.competencies.types.edit', $competencyType['id']) ?>">Edit</a>
                                                    <a class="dropdown-item delete-btn"
                                                       href="#" onclick="confirmDelete(<?= $competencyType['id'] ?>)">Delete</a>
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
    function confirmDelete(competencyTypeId) {
        if (confirm("Are you sure you want to delete this competency type?")) {
            window.location.href = "<?= url_to('ldm.competencies.types.delete') ?>?competency_type_id=" + competencyTypeId;
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
