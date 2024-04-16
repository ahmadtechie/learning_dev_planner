<div class="col-md-6 mx-auto">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Employee-Intervention Mapping</h3>
        </div>

        <div class="card-body">
            <?php use App\Models\LearningInterventionModel;

            include(APPPATH . 'Views/includes/message.php'); ?>
            <?= form_open(url_to('ldm.intervention.map.create')) ?>
            <div class="form-group">
                <label for="employee_ids">Select Employees <span>*</span></label>
                <select id="employee_ids" data-placeholder="Select employees" name="employee_ids[]" multiple="multiple"
                        required style="width: 100%; height: 150px">
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
                                <?= "{$employee['first_name']} {$employee['last_name']} [{$employee['username']}]" ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </select>
                <span class="text-danger"><?= isset($validation) && $validation->hasError('employee_ids[]') ? $validation->getError('employee_ids[]') : '' ?></span>
            </div>
            <div class="form-group">
                <label for="intervention_id">Learning Intervention <span>*</span></label>
                <select id="intervention_id" class="form-control" name="intervention_id" required>
                    <option>Choose Intervention</option>
                    <?php $selected_intervention_id = set_value('intervention_id') ?>
                    <?php if (!empty($interventions) && is_array($interventions)): ?>
                        <?php foreach ($interventions as $intervention): ?>
                            <?php
                            $interventionModel = new LearningInterventionModel();
                            $intervention = $interventionModel->find($intervention['id']);
                            ?>
                            <?php if ($intervention['id'] === $selected_intervention_id): ?>
                                <option value="<?= $intervention['id'] ?>"
                                        selected><?= $intervention['intervention_name'] ?></option>
                            <?php else: ?>
                                <option value="<?= $intervention['id'] ?>"><?= $intervention['intervention_name'] ?></option>
                            <?php endif ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('intervention_id')) ? $validation->getError('intervention_id') : '' ?>
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


<?php include(APPPATH . 'Views/tables/employee_interventions_table.php'); ?>
