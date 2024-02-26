<?php if (session()->has('success')): ?>
    <div id="successAlert" class="alert alert-success" role="alert">
        <?= session('success') ?>
    </div>
    <script>
        setTimeout(function () {
            $("#successAlert").fadeOut("slow");
        }, 3000);
    </script>
<?php elseif (session()->has('deleted')): ?>
    <div id="errorAlert" class="alert alert-danger" role="alert">
        <?= session('deleted') ?>
    </div>
    <script>
        // Hide the error alert after 3 seconds
        setTimeout(function () {
            $("#errorAlert").fadeOut("slow");
        }, 3000);
    </script>
<?php endif; ?>