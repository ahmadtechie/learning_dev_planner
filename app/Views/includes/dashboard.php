<section class="content">
    <div class="container-fluid">
        <?php if (isset($userData['learningDevRoleId']) and in_array($userData['learningDevRoleId'], session()->get('employeeRoles'))): ?>
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $total_competencies ?? 0 ?></h3>
                            <p>Total Competencies</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $total_users ?? 0 ?></h3>
                            <p>Total Onboarded Users</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $total_divisions ?? 0 ?></h3>
                            <p>Total Divisions</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?= $total_groups ?? 0 ?></h3>
                            <p>Total Groups</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $total_departments ?? 0 ?></h3>
                            <p>Total Departments</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $total_units ?? 0 ?></h3>
                            <p>Total Units</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $total_line_managers ?? 0 ?></h3>
                            <p>Total Line Managers</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $total_development_cycles ?? 0 ?></h3>
                            <p>Total Development Cycles</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $total_active_cycle_completed_ratings ?? 0 ?></h3>
                            <p>Total Completed Ratings</p>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif (isset($userData['employeeRoleId']) and in_array($userData['employeeRoleId'], session()->get('employeeRoles'))): ?>
            <!-- ./col -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h4><?php if($user_department) echo $user_department['department_name']; else echo 'Not Assigned' ?></h4>
                            <p>User Department</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h4><?php if($user_unit) echo $user_unit['unit_name']; else echo 'Not Assigned' ?></h4>
                            <p>User Unit</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h4><?php if ($user_line_manager) echo $user_line_manager['first_name'] . ' ' . $user_line_manager['last_name']; else echo'' ?></h4>
                            <p>Line Manager</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h4><?php if ($user_job) echo $user_job['job_title']; else echo 'Not Assigned' ?></h4>
                            <p>Job</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $user_completed_cycles ?? '' ?></h3>
                            <p>Total Completed Cycles</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $user_total_job_competencies ?? '' ?></h3>
                            <p>Total Job Competencies</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $user_total_interventions ?? 0 ?></h3>
                            <p>Total Assigned Interventions</p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>
</section>