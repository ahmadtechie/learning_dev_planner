<?php

use App\Models\LearningInterventionModel;
?>
<div class="col-md-6 mx-auto">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Feedback Capturing Invite</h3>
        </div>

        <div class="card-body">
            <?= form_open(url_to('ldm.feedback.invite.create')) ?>

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
            <div class="card-body">
                <?= form_open(url_to('ldm.feedback.invite.create')) ?>
                <div class="form-group">
                    <label for="cycle_id">Development Cycle <span>*</span></label>
                    <select id="cycle_id" name="cycle_id" class="form-control" required>
                        <option value="">Select Cycle</option>
                        <?php if (!empty($cycles) && is_array($cycles)): ?>
                            <?php foreach ($cycles as $cycle): ?>
                                <option value="<?= $cycle['id'] ?>" <?= (isset($intervention) && $intervention['cycle_id'] == $cycle['id']) ? 'selected' : '' ?>>
                                    <?= $cycle['cycle_year'] ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif ?>
                    </select>
                    <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('cycle_id')) ? $validation->getError('cycle_id') : '' ?>
                </span>
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
                <div class="form-group">
                    <label for="employee_ids">Select Employees <span>*</span></label>
                    <select id="employee_ids"  data-placeholder="Select employees" name="employee_emails[]" multiple="multiple"
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
                                <option value="<?= $employee['email'] ?>" <?= set_select('employee_ids[]', $employee['id'], $isSelected) ?>>
                                    <?= "{$employee['first_name']} {$employee['last_name']} [{$employee['username']}]" ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </select>
                    <span class="text-danger"><?= isset($validation) && $validation->hasError('employee_emails[]') ? $validation->getError('employee_emails[]') : '' ?></span>
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
</div>


<?php include(APPPATH . 'Views/tables/cycle_email_log_table.php'); ?>

<script>
    $(document).ready(function () {
        $('#cycle_id').on('change', function () {
            updateInterventions($(this).val());
        });
    });

    function updateInterventions(cycleId) {
        $.ajax({
            url: '<?= base_url() ?>ldm/intervention/fetch-interventions/',
            method: 'GET',
            data: {cycle_id: cycleId},
            success: function (data) {
                $('#intervention_id').html(data);
                $('#intervention_id').trigger('change');
            }
        });
    }

    $(document).ready(function() {
        $('#intervention_id').on('change', function() {
            updateEmployees();
        });
    });

    function updateEmployees() {
        let interventionId = $('#intervention_id').val();
        let cycleId = $('#cycle_id').val();
        $.ajax({
            url: '<?= base_url() ?>ldm/trainer/feedback/fetch-employees/',
            method: 'GET',
            data: {
                intervention_id: interventionId,
                cycle_id: cycleId,
            },
            success: function(data) {
                console.log(data)
                $('#employee_ids').html(data);
            },
            error: function(err) {
                console.log(err)
            }
        });
    }
</script>