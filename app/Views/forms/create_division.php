<div class="col-md-6 mx-auto">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title"><?= isset($division) ? 'Edit \'' . esc($division['division_name']) . '\' ': 'Create Division' ?> </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php include(APPPATH . 'Views/includes/message.php'); ?>

            <?php if (isset($division)): ?>
                <?= form_open(url_to('ldm.divisions.update', esc($division['id']))) ?>
            <?php else: ?>
                <?= form_open(url_to('ldm.divisions.create')) ?>
            <?php endif; ?>

            <div class="form-group">
                <label>Division Name <span class="required">*</span></label>
                <input type="text" name="division_name" value="<?= isset($division) ? esc($division['division_name']) : set_value('division_name') ?>"
                       class="form-control" placeholder="Enter Division Name" required>
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('division_name')) ? $validation->getError('division_name') : '' ?>
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
<?php include(APPPATH . 'Views/tables/division_table.php'); ?>

