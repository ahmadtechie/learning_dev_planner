<div class="col-md-4 mx-auto">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title"><?= isset($intervention_type) ? 'Edit \'' . esc($intervention_type['name']) . '\' ': 'Create Intervention Type' ?> </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
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
            <?php if (isset($intervention_type)): ?>
                <?= form_open(url_to('ldm.intervention.type.update', esc($intervention_type['id']))) ?>
            <?php else: ?>
                <?= form_open(url_to('ldm.intervention.type.create')) ?>
            <?php endif; ?>

            <div class="form-group">
                <label>Intervention Type Name <span class="required">*</span></label>
                <input type="text" name="name" value="<?= isset($intervention_type) ? esc($intervention_type['name']) : set_value('name') ?>"
                       class="form-control" placeholder="Enter Intervention Type Name" required>
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('name')) ? $validation->getError('name') : '' ?>
                </span>
            </div>

            <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                    <button class="btn btn-primary" type="reset">Reset</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
            <?= form_close() ?>
        </div>
        <!-- /.card-body -->
    </div>
</div>
<?php include(APPPATH . 'Views/tables/intervention_type_table.php'); ?>
