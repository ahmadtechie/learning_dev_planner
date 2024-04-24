<div class="container">
    <div class="card col-md-4 mx-auto">
        <div class="card-body login-card-body">
            <p class="login-box-msg">You are only one step a way from your new password, enter your old password first</p>

            <?= form_open(url_to('ldm.change.password.save')) ?>
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
            <div class="input-group mb-3">
                <input type="password" name="current_password" class="form-control" placeholder="Old Password">
            </div>
            <div class="input-group mb-3">
                <input type="password" name="new_password" class="form-control" placeholder="New Password">
            </div>
            <div class="input-group mb-3">
                <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password">
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">Change password</button>
                </div>
                <!-- /.col -->
            </div>
            <?= form_close() ?>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
