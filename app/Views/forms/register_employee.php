<section class="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Register New Staff</h3>
                    </div>
                    <?= form_open(url_to('ldm.employee.create')) ?>
                    <div class="card-body">
                            <div class="form-group">
                                <label for="InputEmail">Email address</label>
                                <input type="email" name="email" class="form-control" id="InputEmail" placeholder="Enter email" value="<?= set_value('email') ?>" required>
                                <span class="text-danger">
                                    <?= (isset($validation) && $validation->hasError('email')) ? $validation->getError('email') : '' ?>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="FirstName">First Name</label>
                                <input type="text" name="first_name" class="form-control" id="FirstName" placeholder="Enter first name" value="<?= set_value('first_name')  ?>" required>
                                <span class="text-danger">
                                    <?= (isset($validation) && $validation->hasError('first_name')) ? $validation->getError('first_name') : '' ?>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="LastName">Last Name</label>
                                <input type="text" name="last_name" class="form-control" id="LastName" placeholder="Enter last name" value="<?= set_value('last_name')  ?>" required>
                                <span class="text-danger">
                                    <?= (isset($validation) && $validation->hasError('last_name')) ? $validation->getError('last_name') : '' ?>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="job">Job</label>
                                <select id="job" class="form-control" name="job_id" required>
                                    <option>Choose Job</option>
                                    <?php if (!empty($jobs) && is_array($jobs)): ?>
                                        <?php foreach ($jobs as $job): ?>
                                            <?php if (set_value('job_id') == $job['id']): ?>
                                                <option value="<?= $job['id'] ?>" selected><?= esc($job['job_title']) ?></option>
                                            <?php else: ?>
                                                <option value="<?= $job['id'] ?>"><?= esc($job['job_title']) ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <span class="text-danger">
                                    <?= (isset($validation) && $validation->hasError('job_id')) ? $validation->getError('job_id') : '' ?>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="role_ids">Select Roles <span>*</span></label>
                                <select id="role_ids" class="select2" data-placeholder="Select roles"
                                        name="role_ids[]" multiple="multiple" required style="width: 100%;">
                                    <?php if (!empty($roles) && is_array($roles)): ?>
                                        <?php foreach ($roles as $role): ?>
                                            <?php
                                            $isSelected = false;
                                            if (!empty($selected_roles) && is_array($selected_roles)) {
                                                foreach ($selected_roles as $selected_role) {
                                                    if ($role['id'] == $selected_role['id']) {
                                                        $isSelected = true;
                                                        break;
                                                    }
                                                }
                                            }
                                            ?>
                                            <option value="<?= $role['id'] ?>" <?= set_select('role_ids[]', $role['id'], $isSelected) ?>>
                                                <?= $role['name'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <span class="text-danger"><?= isset($validation) && $validation->hasError('role_ids[]') ? $validation->getError('role_ids[]') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="line_manager">Line Manager</label>
                                <select id="line_manager" class="form-control" name="line_manager_id">
                                    <option>Choose Line Manager</option>
                                    <?php
                                        $model = new \App\Models\UserModel();
                                    ?>
                                    <?php if (!empty($line_managers) && is_array($line_managers)): ?>
                                        <?php $selected_line_manager_id = isset($employee) ? $employee['line_manager_id'] : set_value('line_manager_id') ?>
                                        <?php foreach ($line_managers as $line_manager): ?>
                                            <?php if ($line_manager['id'] === $selected_line_manager_id): ?>
                                                <option value="<?= $line_manager['employee_id'] ?>" selected><?= esc($line_manager['first_name']); esc($line_manager['last_name']);  ?></option>
                                            <?php else: ?>
                                                <option value="<?= $line_manager['employee_id'] ?>"><?= esc($line_manager['first_name']); esc($line_manager['last_name']);  ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <span class="text-danger">
                                    <?= (isset($validation) && $validation->hasError('line_manager_id')) ? $validation->getError('line_manager_id') : '' ?>
                                </span>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include(APPPATH . 'Views/tables/employees_table.php'); ?>

