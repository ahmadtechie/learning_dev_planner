<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="<?php echo base_url("images/favicon.png") ?>" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">LD Planner</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo base_url("dist/img/user2-160x160.jpg") ?>" class="img-circle elevation-2"
                     alt="User Image">
            </div>
            <div class="info">
                <?php if (isset($userInfo)): ?>
                    <a href="#" class="d-block"><?= "{$userInfo['first_name']} {$userInfo['last_name']}" ?> </a>
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
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="/" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <!-- Reporting Module -->
                <?php if (in_array('reporting_role_id', session()->get('employeeRoles'))): ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Reporting Module
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <!-- Add reporting module items here -->
                        </ul>
                    </li>
                <?php endif; ?>

                <!-- Org. Structure -->
                <?php if (in_array('org_structure_role_id', session()->get('employeeRoles'))): ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-sitemap"></i>
                            <p>
                                Org. Structure
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <!-- Add organization structure items here -->
                        </ul>
                    </li>
                <?php endif; ?>

                <!-- Employee Data -->
                <?php if (in_array('employee_data_role_id', session()->get('employeeRoles'))): ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user-md"></i>
                            <p>
                                Employee Data
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <!-- Add employee data items here -->
                        </ul>
                    </li>
                <?php endif; ?>

                <!-- Add more menu items based on roles -->

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
