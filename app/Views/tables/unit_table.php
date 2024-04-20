<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Created Units</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table unitTable table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Unit Name</th>
                                <th>Department Name</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($units) && is_array($units)): ?>
                                <?php foreach ($units as $unit): ?>
                                    <?php
                                    $model = new \App\Models\DepartmentModel();
                                    if ($unit['department_id']) {
                                        $departmentData = $model->find($unit['department_id']);
                                        if ($departmentData !== null && isset($departmentData['department_name'])) {
                                            $department_name = $departmentData['department_name'];
                                        } else {
                                            $department_name = 'Unknown Department';
                                        }
                                    } else {
                                        $department_name = 'No Department';
                                    }
                                    ?>
                                    <tr>
                                        <td><?= $unit['unit_name']; ?></td>
                                        <td><?= $department_name ?></td>
                                        <td><?= $unit['created_at']; ?></td>
                                        <td><?= $unit['updated_at']; ?></td>
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
                                                       href="<?= url_to('ldm.units.edit', $unit['id']) ?>">Edit</a>
                                                    <a class="dropdown-item delete-btn"
                                                       href="#" onclick="confirmDelete(<?= $unit['id']?>)">Delete</a>
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
    function confirmDelete(unitId) {
        if (confirm("Are you sure you want to delete this unit?")) {
            window.location.href = "<?= url_to('ldm.units.delete') ?>?unit_id=" + unitId;
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
            "order": [[3, "desc"]],

        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>