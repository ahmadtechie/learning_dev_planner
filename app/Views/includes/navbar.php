<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?php echo base_url("dist/img/AdminLTELogo.png") ?>" alt="AdminLTELogo"
         height="60" width="60">
</div>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/home" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->

        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= url_to('ldm.change.password') ?>">Change Password</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <?php if(session()->has('loggedInUser')): ?>
                <a href="<?= url_to('ldm.logout') ?>" class="nav-link">Logout</a>
            <?php else: ?>
                <a href="<?= url_to('ldm.login') ?>" class="nav-link">Login</a>
            <?php endif; ?>
        </li>
    </ul>
</nav>
<!-- /.navbar -->