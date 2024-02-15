<div class="col-md-6 mx-auto">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title"><?= isset($unit) ? 'Edit \'' . esc($unit['unit_name']) . '\' ' : 'Create Unit' ?> </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php if (\Config\Services::validation()->getErrors()): ?>
                <div id="errorAlert" class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php foreach (\Config\Services::validation()->getErrors() as $error): ?>
                        <p><?= esc($error) ?></p>
                    <?php endforeach; ?>
                </div>

                <script>
                    // Hide the error alert after 3 seconds
                    setTimeout(function () {
                        $("#errorAlert").fadeOut("slow");
                    }, 3000);
                </script>
            <?php endif; ?>

            <?php if (isset($unit)): ?>
                <?= form_open(url_to('ldm.units.update', $unit['id'])) ?>
            <?php else: ?>
                <?= form_open(url_to('ldm.units.create')) ?>
            <?php endif; ?>

            <div class="form-group">
                <label>Unit Name <span class="required">*</span></label>
                <input type="text" name="division_name" value="<?= isset($unit) ? esc($unit['unit_name']) : '' ?>"
                       class="form-control" placeholder="Enter Division Name" required>
            </div>
            <div class="form-group">
                <label id="department">Department</label>
                <select class="form-control" name="department_id">
                    <option>Choose Department</option>
                    <?php $selected_department_id = isset($unit) ? $unit['department_id'] : ''; ?>
                    <?php if (!empty($departments) && is_array($departments)): ?>
                        <?php foreach ($departments as $department): ?>
                            <?php if ($department['id'] === $selected_department_id): ?>
                                <option value="<?= $department['id'] ?>"
                                        selected><?= esc($department['department_name']) ?></option>
                            <?php else: ?>
                                <option value="<?= $department['id'] ?>"><?= esc($department['department_name']) ?></option>
                            <?php endif ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
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
<?php include(APPPATH . 'Views/tables/unit_table.php'); ?>

