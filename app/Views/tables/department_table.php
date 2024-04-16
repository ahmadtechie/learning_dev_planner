<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Created Departments</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped departmentTable">
                            <thead>
                            <tr>
                                <th>Department Name</th>
                                <th>Group Name</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($departments) && is_array($departments)): ?>
                                <?php foreach ($departments as $department): ?>
                                    <?php
                                    $model = new \App\Models\GroupModel();
                                    if ($department['group_id']) {
                                        $groupData = $model->find($department['group_id']);
                                        if ($groupData !== null && isset($groupData['group_name'])) {
                                            $group_name = $groupData['group_name'];
                                        } else {
                                            // Handle the case where division data is not found or 'division_name' is not set
                                            $group_name = '-';
                                        }
                                    } else {
                                        $group_name = '-';
                                    }
                                    ?>
                                    <tr>
                                        <td><?= $department['department_name']; ?></td>
                                        <td><?= $group_name ?></td>
                                        <td><?= $department['created_at']; ?></td>
                                        <td><?= $department['updated_at']; ?></td>
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
                                                       href="<?= url_to('ldm.departments.edit', $department['id']) ?>">Edit</a>
                                                    <a class="dropdown-item delete-btn"
                                                       href="<?= url_to('ldm.departments.delete', $department['id']) ?>">Delete</a>
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