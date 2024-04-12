<section class="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Register New Employee</h3>
                    </div>
                    <?php if (!empty(session()->getFlashdata('success'))): ?>
                        <div id="successAlert" class="alert alert-success" role="alert">
                            <?= session('success') ?>
                        </div>
                        <script>
                            setTimeout(function () {
                                $("#successAlert").fadeOut("slow");
                            }, 3000);
                        </script>
                    <?php endif; ?>
                    <?php if (!empty(session()->getFlashdata('error'))): ?>
                        <div id="errorAlert" class="alert alert-danger" role="alert">
                            <?= session('error') ?>
                        </div>
                        <script>
                            setTimeout(function () {
                                $("#errorAlert").fadeOut("slow");
                            }, 3000);
                        </script>
                    <?php endif; ?>
                    <div class="card-body">
                        <?= form_open(url_to('ldm.employee.create')) ?>
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
                            <label>Job</label>
                            <select class="form-control" name="job_id" required>
                                <option>Choose Job</option>
                                <?php if (!empty($jobs) && is_array($jobs)): ?>
                                    <?php foreach ($jobs as $job): ?>
                                        <?php if (set_value('job_id') == $job['id']): ?>
                                            <option value="<?= $job['id'] ?>" selected><?= esc($job['job_title']) ?></option>
                                        <?php else: ?>
                                            <option value="<?= $job['id'] ?>" selected><?= esc($job['job_title']) ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <span class="text-danger">
                                    <?= (isset($validation) && $validation->hasError('job_id')) ? $validation->getError('job_id') : '' ?>
                                </span>
                        </div>
                        <div class="form-group">
                            <label>Line Manager</label>
                            <select class="form-control" name="line_manager_id">
                                <option>Choose Line Manager</option>
                                <?php
                                $model = new \App\Models\UserModel();
                                ?>
                                <?php if (!empty($user_roles) && is_array($user_roles)): ?>
                                    <?php foreach ($user_roles as $user_role): ?>
                                        <?php if ($user_role['role'] == 'LineManager'):
                                            $user = $model->find($user_role['user_id']);
                                            ?>
                                            <option value="<?= $user_role['user_id'] ?>"><?= esc($user['first_name']); esc($user['last_name']);  ?></option>
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
<?php //include(APPPATH . 'Views/tables/employees_table.php'); ?>

