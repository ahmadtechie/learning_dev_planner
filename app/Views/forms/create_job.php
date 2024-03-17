<div class="col-md-6 mx-auto">
    <div class="card card-info">
        <div class="card-header">
            <?php if (isset($job)): ?>
                <h3 class="card-title">Edit Job</h3>
            <?php else: ?>
                <h3 class="card-title">Create Job</h3>
            <?php endif; ?>
        </div>

        <div class="card-body">
            <?php if (isset($job)): ?>
                <?= form_open(url_to('ldm.jobs.update', esc($job['id']))) ?>
            <?php else: ?>
                <?= form_open(url_to('ldm.jobs.create')) ?>
            <?php endif; ?>

            <div class="form-group">
                <label for="job_title">Job Title <span>*</span></label>
                <input id="job_title" type="text" name="job_title" value="<?= isset($job) ? esc($job['job_title']) : set_value('job_title') ?>" class="form-control" placeholder="Enter Job Title" required>
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('job_title')) ? $validation->getError('job_title') : '' ?>
                </span>
            </div>
            <div class="form-group">
                <label for="qualification">Qualifications <span>*</span></label>
                <textarea id="qualification" name="qualifications" class="form-control" rows="3" placeholder="Enter Qualifications" required><?= isset($job) ? esc($job['qualifications']) : set_value('qualifications') ?></textarea>
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('qualifications')) ? $validation->getError('qualifications') : '' ?>
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
<?php include(APPPATH . 'Views/tables/job_table.php'); ?>

