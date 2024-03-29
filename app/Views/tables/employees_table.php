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
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email Address</th>
                                <th>Job</th>
                                <th>Roles</th>
                                <th>Line Manager</th>
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

                                        if (isset($employee['line_manager_id'])) {
                                            $lineManagerData = $employeeModel->getEmployeeDetailsWithUser($employee['line_manager_id'])['first_name'];
                                        }
                                        $lineManagerData = 'None';
                                    ?>
                                    <tr>
                                        <td><?= $employee['first_name'] ?></td>
                                        <td><?= $employee['last_name'] ?></td>
                                        <td><?= $employee['email'] ?></td>
                                        <td><?= $jobData['job_title'] ?></td>
                                        <td><?= implode(', ', $employee['user_roles']) ?></td>
                                        <td><?= $lineManagerData ?></td>
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
                                                       href="">Edit</a>
                                                    <a class="dropdown-item delete-btn"
                                                       href="">Delete</a>
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