<div class="col-md-6 mx-auto">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Employees Dev Cycle Invite</h3>
        </div>

        <div class="card-body">
            <?= form_open(url_to('ldm.employee.invite.create')) ?>

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
            <div class="form-group">
                <label for="dev_cycle">Development Cycle <span>*</span></label>
                <select id="dev_cycle" class="form-control" name="cycle_id" required>
                    <option>Choose Cycle</option>
                    <?php $selected_cycle_id = set_value('cycle_id') ?>
                    <?php if (!empty($cycles) && is_array($cycles)): ?>
                        <?php foreach ($cycles as $cycle): ?>
                            <?php if ($cycle['id'] == $selected_cycle_id): ?>
                                <option value="<?= $cycle['id'] ?>"
                                        selected><?= $cycle['cycle_year'] ?></option>
                            <?php else: ?>
                                <option value="<?= $cycle['id'] ?>"><?= $cycle['cycle_year'] ?></option>
                            <?php endif ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('cycle_id')) ? $validation->getError('cycle_id') : '' ?>
                </span>
            </div>
            <div class="form-group">
                <label for="employee_ids">Select Employees (Unselect based on need) <span>*</span></label>
                <select id="employee_ids" data-placeholder="Select employees" name="employee_emails[]" multiple="multiple"
                        required style="width: 100%; height: 200px">
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
                            <option value="<?= $employee['email'] ?>" <?= set_select('employee_emails[]', $employee['id'], $isSelected) ?> selected>
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
    </div>
</div>


<?php include(APPPATH . 'Views/tables/cycle_email_log_table.php'); ?>
