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
                        <table id="example1" class="table table-bordered table-striped">
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
                                        if ($departmentData !== null && isset($unitData['department_name'])) {
                                            $department_name = $departmentData['department_name'];
                                        } else {
                                            // Handle the case where department data is not found or 'department_name' is not set
                                            $department_name = 'Unknown Department';
                                        }
                                    } else {
                                        // Handle the case where 'division_id' is not set
                                        $department_name = 'No Department';
                                    }
//                                    $division_name = $model->find($group['division_id'])['division_name'];
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
                                                       href="<?= url_to('ldm.units.delete', $unit['id']) ?>">Delete</a>
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