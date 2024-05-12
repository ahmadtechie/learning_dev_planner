<!-- Main Sidebar Container -->
<aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php url_to('ldm.home') ?>" class="h1" style="display: inline-block; vertical-align: middle;">
        <img src="<?php echo base_url("images/LD planner horizontal W.png") ?>" alt="LIM Logo" class="brand-image"
             style="padding-left: 5px; width: 170px; height: 50px; margin-right: 10px; background-size: cover">
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <?php if (isset($userData)): ?>
                    <a href="#"
                       class="d-block"><?= "{$userData['userInfo']['first_name']} {$userData['userInfo']['last_name']}" ?>
                        :
                        <?php if (isset($userData['learningDevRoleId']) and in_array($userData['learningDevRoleId'], session()->get('employeeRoles'))): ?>
                            LDM
                        <?php elseif (isset($userData['trainerRoleId']) and in_array($userData['trainerRoleId'], session()->get('employeeRoles'))): ?>
                            Trainer
                        <?php elseif (isset($userData['lineManagerRoleId']) and in_array($userData['lineManagerRoleId'], session()->get('employeeRoles'))): ?>
                            Line Manager
                        <?php elseif (isset($userData['employeeRoleId']) and in_array($userData['employeeRoleId'], session()->get('employeeRoles'))): ?>
                            Employee
                        <?php endif; ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                       aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item menu-open">
                    <a href="/" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php if (isset($userData['learningDevRoleId']) and in_array($userData['learningDevRoleId'], session()->get('employeeRoles'))): ?>
                        <li class="nav-item">
                            <a href="<?= url_to('ldm.dashboard.adp') ?>" class="nav-link <?= strpos(url_to('ldm.dashboard.adp'), uri_string()) ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>ADP Report Dashboard</p>
                            </a>
                        </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a href="<?= url_to('ldm.dashboard.pdp') ?>" class="nav-link <?= strpos(url_to('ldm.dashboard.pdp'), uri_string()) ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>PDP Report Dashboard</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php if (isset($userData['learningDevRoleId']) and in_array($userData['learningDevRoleId'], session()->get('employeeRoles'))): ?>
                    <li class="nav-item <?= strpos(uri_string(), "structure") ? 'menu-open' : ''; ?>">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-sitemap"></i>
                            <p>
                                Org. Structure
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= url_to('ldm.divisions') ?>" class="nav-link <?= strpos(url_to('ldm.divisions'), uri_string()) ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Divisions</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= url_to('ldm.groups') ?>" class="nav-link <?= strpos(url_to('ldm.groups'), uri_string()) ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Groups</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= url_to('ldm.departments') ?>" class="nav-link <?= strpos(url_to('ldm.departments'), uri_string()) ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Departments</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= url_to('ldm.units') ?>" class="nav-link <?= strpos(url_to('ldm.units'), uri_string()) ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Units</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item <?= strpos(uri_string(), "users") ? 'menu-open' : ''; ?>">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user-md"></i>
                            <p>
                                System Users
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= url_to('ldm.employee') ?>" class="nav-link <?= strpos(url_to('ldm.employee'), uri_string()) ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Users Data</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= url_to('ldm.employee.upload') ?>" class="nav-link <?= strpos(url_to('ldm.employee.upload'), uri_string()) ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>CSV Upload</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= url_to('ldm.line.manager') ?>" class="nav-link <?= strpos(url_to('ldm.line.manager'), uri_string()) ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Assign Line Managers</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= url_to('ldm.map.org') ?>" class="nav-link <?= strpos(url_to('ldm.map.org'), uri_string()) ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Link Employees to Org</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item <?= strpos(uri_string(), "competency") ? 'menu-open' : ''; ?>">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-snowflake"></i>
                            <p>
                                Competency Frameworks
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= url_to('ldm.jobs') ?>" class="nav-link <?= strpos(url_to('ldm.jobs'), uri_string()) ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Jobs</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= url_to('ldm.competencies.types') ?>" class="nav-link <?= strpos(url_to('ldm.competencies.types'), uri_string()) ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Competency Types</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= url_to('ldm.competencies') ?>" class="nav-link <?= strpos(url_to('ldm.competencies'), uri_string()) ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Competencies</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= url_to('ldm.competencies.mapping') ?>" class="nav-link <?= strpos(url_to('ldm.competencies.mapping'), uri_string()) ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Job-Competency Mapping</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item <?= strpos(uri_string(), "development") ? 'menu-open' : ''; ?>">
                        <a href="<?= url_to('ldm.cycle') ?>" class="nav-link">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                                Development Cycle
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= url_to('ldm.cycle') ?>" class="nav-link <?= strpos(url_to('ldm.cycle'), uri_string()) ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Cycle Set Up</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= url_to('ldm.employee.invite') ?>" class="nav-link <?= strpos(url_to('ldm.employee.invite'), uri_string()) ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Employees Invite</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
                <li class="nav-item <?= strpos(uri_string(), "contracting") ? 'menu-open' : ''; ?>">
                    <a href="" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Development Contracts
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= url_to('ldm.rating.self') ?>" class="nav-link <?= strpos(url_to('ldm.rating.self'), uri_string()) ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Rate Self</p>
                            </a>
                        </li>
                        <?php if (isset($userData['lineManagerRoleId']) and in_array($userData['lineManagerRoleId'], session()->get('employeeRoles'))): ?>
                            <li class="nav-item">
                                <a href="<?= url_to('ldm.rating.validate') ?>" class="nav-link <?= strpos(url_to('ldm.rating.validate'), uri_string()) ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Validate Ratings</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= url_to('ldm.rating.pdp') ?>" class="nav-link <?= strpos(url_to('ldm.rating.pdp'), uri_string()) ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Manage PDPs</p>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php if (isset($userData['learningDevRoleId']) and in_array($userData['learningDevRoleId'], session()->get('employeeRoles'))): ?>
                    <li class="nav-item <?= strpos(uri_string(), "intervention") ? 'menu-open' : ''; ?>">
                        <a href="" class="nav-link">
                            <i class="nav-icon far fa-object-group"></i>
                            <p>
                                Intervention Management
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= url_to('ldm.learning.intervention') ?>" class="nav-link <?= strpos(url_to('ldm.learning.intervention'), uri_string()) ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Learning Interventions</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= url_to('ldm.intervention.type') ?>" class="nav-link <?= strpos(url_to('ldm.intervention.type'), uri_string()) ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Intervention Types</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= url_to('ldm.vendor') ?>" class="nav-link <?= strpos(url_to('ldm.vendor'), uri_string()) ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Intervention Vendors</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= url_to('ldm.intervention.class') ?>" class="nav-link <?= strpos(url_to('ldm.intervention.class'), uri_string()) ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Intervention Classes</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= url_to('ldm.intervention.content') ?>" class="nav-link <?= strpos(url_to('ldm.intervention.content'), uri_string()) ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Intervention Contents</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= url_to('ldm.intervention.map') ?>" class="nav-link <?= strpos(url_to('ldm.intervention.map'), uri_string()) ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Map Interventions</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if (isset($userData['learningDevRoleId']) and
                    (
                        in_array($userData['learningDevRoleId'], session()->get('employeeRoles')) or
                        in_array($userData['trainerRoleId'], session()->get('employeeRoles'))
                    )): ?>
                    <li class="nav-item <?= strpos(uri_string(), "trainer") ? 'menu-open' : ''; ?>">
                        <a href="" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>
                                Trainer Management
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= url_to('ldm.intervention.attendance') ?>" class="nav-link <?= strpos(url_to('ldm.intervention.attendance'), uri_string()) ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Training Attendance</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= url_to('ldm.feedback.invite') ?>" class="nav-link <?= strpos(url_to('ldm.feedback.invite'), uri_string()) ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Feedback Invite</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
    <div class="sidebar-custom text-center">
        <a href="<?= url_to('ldm.logout') ?>" class="text-white"  style="font-size: 20px"><ion-icon name="log-out-outline"></ion-icon></a>
    </div>
</aside>