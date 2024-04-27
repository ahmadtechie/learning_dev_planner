<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LD Planner | Log in</title>
    <link rel="icon" href="<?php echo base_url("images/favicon.png") ?>">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url("plugins/fontawesome-free/css/all.min.css") ?>">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url("plugins/icheck-bootstrap/icheck-bootstrap.min.css") ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url("dist/css/adminlte.min.css") ?>">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="<?php url_to('ldm.home') ?>" class="h1" style="display: inline-block; vertical-align: middle;">
            <img src="<?php echo base_url("images/LD planner horizontal.png") ?>" alt="LIM Logo" class="brand-image"
                 style=" width: 200px; height: 80px; margin-right: 10px;">
        </a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>
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

            <?= form_open(url_to('ldm.login.auth')) ?>
            <?= csrf_field(); ?>
            <div class="input-group mb-3">
                <input type="email" class="form-control" placeholder="Email" name="email">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            <span class="text-danger"><?= isset($validation) && $validation->hasError('email') ? $validation->getError('email') : '' ?></span>
            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Password" name="password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <span class="text-danger"><?= isset($validation) && $validation->hasError('password') ? $validation->getError('password') : '' ?></span>
            <div class="row justify-content-center">
                <!-- /.col -->
                <div class="col-6 ">
                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </div>
        <?= form_close(); ?>

        <p class="text-center">
            <a href="<?= url_to('ldm.forgot.password') ?>">I forgot my password</a>
        </p>
    </div>
    <!-- /.login-card-body -->
</div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo base_url("plugins/jquery/jquery.min.js") ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url("plugins/bootstrap/js/bootstrap.bundle.min.js") ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url("dist/js/adminlte.min.js") ?>"></script>
</body>
</html>
