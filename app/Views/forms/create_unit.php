<div class="col-md-6 mx-auto">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title"><?= isset($unit) ? 'Edit \'' . esc($unit['unit_name']) . '\' ' : 'Create Unit' ?> </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php include(APPPATH . 'Views/includes/message.php'); ?>

            <?php if (isset($unit)): ?>
                <?= form_open(url_to('ldm.units.update', $unit['id'])) ?>
            <?php else: ?>
                <?= form_open(url_to('ldm.units.create')) ?>
            <?php endif; ?>

            <div class="form-group">
                <label for=unit_name">Unit Name <span class="required">*</span></label>
                <input id="unit_name" type="text" name="unit_name" value="<?= isset($unit) ? esc($unit['unit_name']) : set_value('unit_name') ?>"
                       class="form-control" placeholder="Enter Unit Name" required>
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('unit_name')) ? $validation->getError('unit_name') : '' ?>
                </span>
            </div>
            <div class="form-group">
                <label for="department">Department</label>
                <select id="department" class="form-control" name="department_id">
                    <option>Choose Department</option>
                    <?php $selected_department_id = isset($unit) ? $unit['department_id'] : set_value('department_id'); ?>
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
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('department_id')) ? $validation->getError('department_id') : '' ?>
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

<?php include(APPPATH . 'Views/tables/unit_table.php'); ?>

