<div class="col-md-6 mx-auto">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title"><?= isset($department) ? 'Edit \'' . esc($department['department_name']) . '\' ' : 'Create Department' ?> </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php include(APPPATH . 'Views/includes/message.php'); ?>

            <?php if (isset($department)): ?>
                <?= form_open(url_to('ldm.departments.update', esc($department['id']))) ?>
            <?php else: ?>
                <?= form_open(url_to('ldm.departments.create')) ?>
            <?php endif; ?>

            <div class="form-group">
                <label for="department_name">Department Name <span>*</span></label>
                <input type="text" id="department_name" name="department_name"
                       value="<?= isset($department) ? esc($department['department_name']) : set_value('department_name') ?>"
                       class="form-control" placeholder="Enter Division Name">
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('department_name')) ? $validation->getError('department_name') : '' ?>
                </span>
            </div>
            <div class="form-group">
                <label for="division">Group</label>
                <select id="division" class="form-control" name="group_id" required>
                    <option>Choose Group</option>
                    <?php $selected_group_id = isset($department) ? $department['group_id'] : set_value('group_id') ?>
                    <?php if (!empty($groups) && is_array($groups)): ?>
                        <?php foreach ($groups as $group): ?>
                            <?php if ($group['id'] === $selected_group_id): ?>
                                <option value="<?= $group['id'] ?>" selected><?= esc($group['group_name']) ?></option>
                            <?php else: ?>
                                <option value="<?= $group['id'] ?>"><?= esc($group['group_name']) ?></option>
                            <?php endif ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('group_id')) ? $validation->getError('group_id') : '' ?>
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
<?php include(APPPATH . 'Views/tables/department_table.php'); ?>

