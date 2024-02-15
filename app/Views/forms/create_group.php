<div class="col-md-6 mx-auto">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title"><?= isset($group) ? 'Edit \'' . esc($group['group_name']) . '\' ': 'Create Group' ?> </h3>
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

            <?php if (isset($group)): ?>
                <?= form_open(url_to('ldm.groups.update', esc($group['id']))) ?>
            <?php else: ?>
                <?= form_open(url_to('ldm.groups.create')) ?>
            <?php endif; ?>

            <div class="form-group">
                <label>Group Name <span>*</span></label>
                <input type="text" name="group_name" value="<?= isset($group) ? esc($group['group_name']) : '' ?>"
                       class="form-control" placeholder="Enter Group Name" required>
            </div>
            <div class="form-group">
                <label id="division">Division</label>
                <select class="form-control" name="division_id">
                    <option>Choose Division</option>
                    <?php $selected_division_id = isset($group) ? $group['division_id'] : ''; ?>
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

