<div class="col-md-6 mx-auto">
    <div class="card card-info">
        <div class="card-header">
            <?php if (isset($assign)): ?>
                <h3 class="card-title">Reassign Line Manager</h3>
            <?php else: ?>
                <h3 class="card-title">Assign Line Manager</h3>
            <?php endif; ?>
        </div>

        <div class="card-body">
            <?php include(APPPATH . 'Views/includes/message.php'); ?>

            <?php if (isset($assign)): ?>
                <?= form_open(url_to('ldm.line.manager.update', esc($assign['id']))) ?>
            <?php else: ?>
                <?= form_open(url_to('ldm.line.manager.create')) ?>
            <?php endif; ?>

            <div class="form-group">
                <label for="line_manager">Line Manager <span>*</span></label>
                <select id="line_manager" class="form-control" name="line_manager_id" required>
                    <option>Choose Line Manager</option>
                    <?php $selected_line_manager_id = isset($assign) ? $assign['id'] : set_value('line_manager_id') ?>
                    <?php if (!empty($line_managers) && is_array($line_managers)): ?>
                        <?php foreach ($line_managers as $line_manager): ?>
                            <?php if ($line_manager['id'] === $selected_line_manager_id): ?>
                                <option value="<?= $line_manager['employee_id'] ?>"
                                        selected><?= "{$line_manager['first_name']} {$line_manager['last_name']}" ?></option>
                            <?php else: ?>
                                <option value="<?= $line_manager['employee_id'] ?>"><?= "{$line_manager['first_name']} {$line_manager['last_name']}" ?></option>
                            <?php endif ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('line_manager_id')) ? $validation->getError('line_manager_id') : '' ?>
                </span>
            </div>
            <div class="form-group">
                <label for="employee_ids">Select Employees <span>*</span></label>
                <select id="employee_ids" data-placeholder="Select employees" name="employee_ids[]" multiple="multiple"
                        required style="width: 100%;">
                    <?php if (!empty($employees) && is_array($employees)): ?>
                        <?php foreach ($employees as $employee): ?>
                            <?php
                            $isSelected = false;
                            if (!empty($selected_employees) && is_array($selected_employees)) {
                                foreach ($selected_employees as $selected_employee) {
                                    if ($employee['id'] == $selected_employee['id']) {
                                        $isSelected = true;
                                        break;
                                    }
                                }
                            }
                            ?>
                            <option value="<?= $employee['employee_id'] ?>" <?= set_select('employee_ids[]', $employee['id'], $isSelected) ?>>
                                <?= "{$employee['first_name']} {$employee['last_name']}" ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </select>
                <span class="text-danger"><?= isset($validation) && $validation->hasError('employee_ids[]') ? $validation->getError('employee_ids[]') : '' ?></span>
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


<?php include(APPPATH . 'Views/tables/line_manager_assign_table.php'); ?>

