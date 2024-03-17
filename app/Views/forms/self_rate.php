<section class="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Competency Rating</h3>
                    </div>
                    <?= form_open(url_to('ldm.rating.self')) ?>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="InputEmail"></label>
                                <input type="email" name="email" class="form-control" id="InputEmail" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="FirstName">First Name</label>
                                <input type="email" name="first_name" class="form-control" id="FirstName" placeholder="Enter first name">
                            </div>
                            <div class="form-group">
                                <label for="LastName">Last Name</label>
                                <input type="email" name="last_name" class="form-control" id="LastName" placeholder="Enter last name">
                            </div>
                            <div class="form-group">
                                <label>Job</label>
                                <select class="form-control">
                                    <option>Choose Job</option>
                                    <?php if (!empty($jobs) && is_array($jobs)): ?>
                                        <?php foreach ($jobs as $job): ?>
                                            <option value="<?= $job['id'] ?>"><?= esc($job['job_title']) ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Line Manager</label>
                                <select class="form-control">
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
                            </div>
                            <div class="form-group">
                                <label for="InputPassword">Password</label>
                                <input type="password" name="password" class="form-control" id="InputPassword" placeholder="Password">
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include(APPPATH . 'Views/tables/employees_table.php'); ?>

