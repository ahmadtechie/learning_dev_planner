<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Created Groups</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped groupTable">
                            <thead>
                            <tr>
                                <th>Group Name</th>
                                <th>Division Name</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php use App\Models\DivisionModel;

                            if (!empty($groups) && is_array($groups)): ?>
                                <?php foreach ($groups as $group): ?>
                                    <?php
                                    $model = new DivisionModel();
                                    if ($group['division_id']) {
                                        $divisionData = $model->find($group['division_id']);
                                        if ($divisionData !== null && isset($divisionData['division_name'])) {
                                            $division_name = $divisionData['division_name'];
                                        } else {
                                            $division_name = '-';
                                        }
                                    } else {
                                        $division_name = '-';
                                    }
                                    ?>
                                    <tr>
                                        <td><?= $group['group_name']; ?></td>
                                        <td><?= $division_name ?></td>
                                        <td><?= $group['created_at']; ?></td>
                                        <td><?= $group['updated_at']; ?></td>
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
                                                       href="<?= url_to('ldm.groups.edit', $group['id']) ?>">Edit</a>
                                                    <a class="dropdown-item delete-btn"
                                                       href="#" onclick="confirmDelete(<?= $group['id'] ?>)">Delete</a>
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
    function confirmDelete(groupId) {
        if (confirm("Are you sure you want to delete this group?")) {
            window.location.href = "<?= url_to('ldm.groups.delete') ?>?group_id=" + groupId;
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