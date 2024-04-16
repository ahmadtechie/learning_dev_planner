<div class="col-md-6 mx-auto">
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
            <?= form_open(url_to('ldm.intervention.content.create')) ?>

            <div class="form-group">
                <label for="intervention_id">Learning Intervention</label>
                <select id="intervention_id" name="intervention_id" class="form-control" required>
                    <option value="">Select Intervention</option>
                    <?php foreach ($interventions as $intervention): ?>
                        <option value="<?= $intervention['id'] ?>" <?= (isset($intervention_content) && $intervention_content['intervention_id'] == $intervention['id']) ? 'selected' : '' ?>>
                            <?= $intervention['intervention_name']  ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('intervention_id')) ? $validation->getError('intervention_id') : '' ?>
                </span>
            </div>

            <div class="form-group">
                <label for="module_title">Module Title</label>
                <input type="text" id="module_title" name="module_title" class="form-control" value="<?= isset($intervention_content) ? esc($intervention_content['module_title']) : set_value('module_title') ?>" required>
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('module_title')) ? $validation->getError('module_title') : '' ?>
                </span>
            </div>

            <div class="form-group">
                <label for="sub_topic">Sub Topic</label>
                <input type="text" id="sub_topic" name="sub_topic" class="form-control" value="<?= isset($intervention_content) ? esc($intervention_content['sub_topic']) : set_value('sub_topic') ?>" required>
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('sub_topic')) ? $validation->getError('sub_topic') : '' ?>
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

