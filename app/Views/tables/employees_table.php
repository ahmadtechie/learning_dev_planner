<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Employees</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="employeeTable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email Address</th>
                                <th>Job</th>
                                <th>Roles</th>
                                <th>Line Manager</th>
                                <th>Updated At</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($employees) && is_array($employees)): ?>
                                <?php foreach ($employees as $employee): ?>
                                    <?php
                                    $jobModel = new \App\Models\JobModel();
                                    $employeeModel = new \App\Models\EmployeeModel();

                                    $jobData = $jobModel->find($employee['job_id']);

                                    $lineManagerData = '-';

                                    if ($employee['line_manager_id'] !== null) {
                                        $lineManagerDetails = $employeeModel->getEmployeeDetailsWithUser($employee['line_manager_id']);

                                        if ($lineManagerDetails !== null) {
                                            $lineManagerData = $lineManagerDetails['first_name'];
                                        }
                                    }
                                    ?>
                                    <tr <?= $employee['deleted_at'] ? 'style="background-color: #f8d7da;"' : '' ?>>
                                        <td><?= $employee['first_name'] . ' ' . $employee['last_name'] ?? '' ?></td>
                                        <td><?= $employee['email'] ?? '' ?></td>
                                        <td><?= $jobData['job_title'] ?? '' ?></td>
                                        <td><?= $employee['user_roles'] ?? '' ?></td>
                                        <td><?= $lineManagerData ?></td>
                                        <td><?= $employee['updated_at'] ?? '' ?></td>
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
                                                       href="<?= url_to('ldm.employee.edit', $employee['employee_id']) ?>">Edit</a>
                                                    <?php if ($employee['deleted_at'] !== null): ?>
                                                        <a class="dropdown-item delete-btn"
                                                           href="<?= url_to('ldm.employee.activate', $employee['employee_id']) ?>">
                                                            Activate
                                                        </a>
                                                    <?php else: ?>
                                                        <a class="dropdown-item delete-btn"
                                                           href="<?= url_to('ldm.employee.delete', $employee['employee_id']) ?>">
                                                            Deactivate
                                                        </a>
                                                    <?php endif; ?>
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