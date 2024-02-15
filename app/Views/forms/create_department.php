<div class="col-md-6 mx-auto">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title"><?= isset($department) ? 'Edit \'' . esc($department['department_name']) . '\' ': 'Create Department' ?> </h3>
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

            <?php if (isset($department)): ?>
                <?= form_open(url_to('ldm.departments.update', esc($department['id']))) ?>
            <?php else: ?>
                <?= form_open(url_to('ldm.departments.create')) ?>
            <?php endif; ?>

            <div class="form-group">
                <label>Department Name <span>*</span></label>
                <input type="text" name="department_name" value="<?= isset($department) ? esc($department['department_name']) : '' ?>"
                       class="form-control" placeholder="Enter Division Name" required>
            </div>
            <div class="form-group">
                <label id="division">Group</label>
                <select class="form-control" name="group_id">
                    <option>Choose Group</option>
                    <?php $selected_group_id = isset($department) ? $department['group_id'] : ''; ?>
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

