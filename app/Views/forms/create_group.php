<div class="col-md-6 mx-auto">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title"><?= isset($group) ? 'Edit \'' . esc($group['group_name']) . '\' ': 'Create Group' ?> </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php include(APPPATH . 'Views/includes/message.php'); ?>

            <?php if (isset($group)): ?>
                <?= form_open(url_to('ldm.groups.update', esc($group['id']))) ?>
            <?php else: ?>
                <?= form_open(url_to('ldm.groups.create')) ?>
            <?php endif; ?>

            <div class="form-group">
                <label for="group_name">Group Name <span>*</span></label>
                <input type="text" id="group_name" name="group_name" value="<?= isset($group) ? esc($group['group_name']) : set_value('group_name') ?>"
                       class="form-control" placeholder="Enter Group Name" required>
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('group_name')) ? $validation->getError('group_name') : '' ?>
                </span>
            </div>
            <div class="form-group">
                <label for="division">Division</label>
                <select id="division" class="form-control" name="division_id">
                    <option>Choose Division</option>
                    <?php $selected_division_id = isset($group) ? $group['division_id'] : set_value('division_id'); ?>
                    <?php if (!empty($divisions) && is_array($divisions)): ?>
                        <?php foreach ($divisions as $division): ?>
                            <?php if ($division['id'] === $selected_division_id): ?>
                            <option value="<?= $division['id'] ?>" selected><?= esc($division['division_name']) ?></option>
                            <?php else: ?>
                            <option value="<?= $division['id'] ?>"><?= esc($division['division_name']) ?></option>
                            <?php endif ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('division_id')) ? $validation->getError('division_id') : '' ?>
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
<?php include(APPPATH . 'Views/tables/group_table.php'); ?>

