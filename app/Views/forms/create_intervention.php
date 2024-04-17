<div class="col-md-6 mx-auto">
    <div class="card card-info">
        <div class="card-header">
            <?php if (isset($intervention)): ?>
                <h3 class="card-title">Edit Learning Intervention</h3>
            <?php else: ?>
                <h3 class="card-title">Create Learning Intervention</h3>
            <?php endif; ?>
        </div>

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
            <?php if (isset($intervention)): ?>
                <?= form_open(url_to('ldm.learning.intervention.update', esc($intervention['id']))) ?>
            <?php else: ?>
                <?= form_open(url_to('ldm.learning.intervention.create')) ?>
            <?php endif; ?>

            <div class="form-group">
                <label for="intervention_name">Intervention Name</label>
                <input id="intervention_name" type="text" name="intervention_name" class="form-control"
                       value="<?= isset($intervention) ? esc($intervention['intervention_name']) : set_value('intervention_name') ?>" required>
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('intervention_name')) ? $validation->getError('intervention_name') : '' ?>
                </span>
            </div>

            <div class="form-group">
                <label for="trainer_id">Trainer/Provider</label>
                <select id="trainer_id" name="trainer_id" class="form-control" required>
                    <option value="">Select Trainer</option>
                    <?php foreach ($trainers as $trainer): ?>
                        <option value="<?= $trainer['employee_id'] ?>" <?= (isset($intervention) && $intervention['trainer_id'] == $trainer['trainer_id']) ? 'selected' : '' ?>>
                            <?= $trainer['first_name']  . ' ' . $trainer['last_name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('trainer_id')) ? $validation->getError('trainer_id') : '' ?>
                </span>
            </div>

            <div class="form-group">
                <label for="competency_id">Competency</label>
                <select id="competency_id" name="competency_id" class="form-control" required>
                    <option value="">Select Competency</option>
                    <?php foreach ($competencies as $competency): ?>
                        <option value="<?= $competency['id'] ?>" <?= (isset($intervention) && $intervention['competency_id'] == $competency['id']) ? 'selected' : '' ?>>
                            <?= $competency['competency_name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('competency_id')) ? $validation->getError('competency_id') : '' ?>
                </span>
            </div>

            <div class="form-group">
                <label for="cycle_id">Development Cycle</label>
                <select id="cycle_id" name="cycle_id" class="form-control" required>
                    <option value="">Select Cycle</option>
                    <?php foreach ($cycles as $cycle): ?>
                        <option value="<?= $cycle['id'] ?>" <?= (isset($intervention) && $intervention['cycle_id'] == $cycle['id']) ? 'selected' : '' ?>>
                            <?= $cycle['cycle_year'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('cycle_id')) ? $validation->getError('cycle_id') : '' ?>
                </span>
            </div>

            <div class="form-group">
                <label for="intervention_type_id">Intervention Type</label>
                <select id="intervention_type_id" name="intervention_type_id" class="form-control" required>
                    <option value="">Select Intervention Type</option>
                    <?php foreach ($intervention_types as $intervention_type): ?>
                        <option value="<?= $intervention_type['id'] ?>" <?= (isset($intervention) && $intervention['intervention_type_id'] == $intervention_type['id']) ? 'selected' : '' ?>>
                            <?= $intervention_type['name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('intervention_type_id')) ? $validation->getError('intervention_type_id') : '' ?>
                </span>
            </div>

            <div class="form-group">
                <label for="cost">Cost</label>
                <input type="number" id="cost" name="cost" class="form-control"
                       value="<?= isset($intervention) ? esc($intervention['cost']) : set_value('cost') ?>" required>
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('cost')) ? $validation->getError('cost') : '' ?>
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
<?php include(APPPATH . 'Views/tables/learning_intervention_table.php'); ?>

