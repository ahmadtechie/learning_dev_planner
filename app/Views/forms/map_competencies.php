<div class="col-md-6 mx-auto">
    <div class="card card-info">
        <div class="card-header">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-md-8">
                    <?php if (isset($job)): ?>
                        <h3 class="card-title">Edit Job Competencies</h3>
                    <?php else: ?>
                        <h3 class="card-title">Create Job Competencies</h3>
                    <?php endif; ?>
                </div>
                <div class="col-md-4">
                    <a href="<?= url_to('ldm.competencies') ?>" class="btn btn-dark text-light mb-1">Add Competency</a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <?php include(APPPATH . 'Views/includes/message.php'); ?>

            <?php if (isset($job)): ?>
                <?= form_open(url_to('ldm.competencies.mapping.update', esc($job['id']))) ?>
            <?php else: ?>
                <?= form_open(url_to('ldm.competencies.mapping.create')) ?>
            <?php endif; ?>

            <div class="form-group">
                <label for="job">Job <span>*</span></label>
                <select id="job" class="form-control" name="job_id" required>
                    <option>Choose Job</option>
                    <?php $selected_job_id = isset($job) ? $job['id'] : set_value('job_id') ?>
                    <?php if (!empty($jobs) && is_array($jobs)): ?>
                        <?php foreach ($jobs as $job): ?>
                            <?php if ($job['id'] === $selected_job_id): ?>
                                <option value="<?= $job['id'] ?>" selected><?= esc($job['job_title']) ?></option>
                            <?php else: ?>
                                <option value="<?= $job['id'] ?>"><?= esc($job['job_title']) ?></option>
                            <?php endif ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('job_id')) ? $validation->getError('job_id') : '' ?>
                </span>
            </div>
            <div class="form-group">
                <label for="competency_ids">Select Competencies <span>*</span></label>
                <select id="competency_ids" class="select2" data-placeholder="Select competencies"
                        name="competency_ids[]" multiple="multiple" required style="width: 100%;">
                    <?php if (!empty($competencies) && is_array($competencies)): ?>
                        <?php foreach ($competencies as $competency): ?>
                            <?php
                            $isSelected = false;
                            if (!empty($job_competencies) && is_array($job_competencies)) {
                                foreach ($job_competencies as $job_competency) {
                                    if ($competency['id'] == $job_competency['id']) {
                                        $isSelected = true;
                                        break;
                                    }
                                }
                            }
                            ?>
                            <option value="<?= $competency['id'] ?>" <?= set_select('competency_ids[]', $competency['id'], $isSelected) ?>>
                                <?= $competency['competency_name'] ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <span class="text-danger"><?= isset($validation) && $validation->hasError('competency_ids[]') ? $validation->getError('competency_ids[]') : '' ?></span>
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


<?php include(APPPATH . 'Views/tables/competency_mapping_table.php'); ?>

