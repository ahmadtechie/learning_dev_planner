<div class="col-md-8 mx-auto">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Create Intervention Content</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
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
            <?php if (isset($intervention_content)): ?>
                <?= form_open(url_to('ldm.intervention.content.update', esc($intervention_content['id']))) ?>
            <?php else: ?>
                <?= form_open(url_to('ldm.intervention.content.create')) ?>
            <?php endif; ?>
            <div class="form-group">
                <label for="intervention_id">Learning Intervention <span>*</span></label>
                <select id="intervention_id" name="intervention_id" class="form-control" required>
                    <option value="">Select Intervention</option>
                    <?php if (!empty($interventions)): ?>
                        <?php foreach ($interventions as $intervention): ?>
                            <?php $selected_intervention_id = isset($intervention_content) ? $intervention_content['intervention_id'] : set_value('intervention_id'); ?>
                            <?php if ($selected_intervention_id == $intervention['id'] or set_value('intervention_id') == $intervention['id']): ?>
                                <option value="<?= $intervention['id'] ?>" selected>
                                    <?= $intervention['intervention_name'] . ' [' . $intervention['intervention_id'] . ']' ?>
                                </option>
                            <?php else: ?>
                                <option value="<?= $intervention['id'] ?>">
                                    <?= $intervention['intervention_name'] . ' [' . $intervention['intervention_id'] . ']' ?>
                                </option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="summernote1">Learning Objectives <span>*</span></label>
                <textarea id="summernote1" name="learning_objectives" required>
                    <?= isset($intervention_content) ? esc($intervention_content['learning_objectives']) : set_value('learning_objectives') ?>
                </textarea>
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('learning_objectives')) ? $validation->getError('learning_objectives') : '' ?>
                </span>
            </div>

            <div class="form-group">
                <label for="summernote">Modules/Titles/Lessons <span>*</span></label>
                <textarea id="summernote" name="modules">
                    <?= isset($intervention_content) ? esc($intervention_content['modules']) : set_value('modules') ?>
                </textarea>
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('modules')) ? $validation->getError('modules') : '' ?>
                </span>
            </div>

            <div class="form-group">
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
<?php include(APPPATH . 'Views/tables/intervention_content_table.php'); ?>

