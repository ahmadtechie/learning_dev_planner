<div class="col-md-6 mx-auto">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Create Intervention Class</h3>
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
            <?php if (isset($intervention_class)): ?>
                <?= form_open(url_to('ldm.intervention.class.update', esc($intervention_class['id']))) ?>
            <?php else: ?>
                <?= form_open(url_to('ldm.intervention.class.create')) ?>
            <?php endif; ?>

            <div class="form-group">
                <label for="intervention_id">Learning Intervention</label>
                <select id="intervention_id" name="intervention_id" class="form-control" required>
                    <option value="">Select Intervention</option>
                    <?php if (!empty($interventions)): ?>
                        <?php foreach ($interventions as $intervention): ?>
                            <option value="<?= $intervention['id'] ?>" <?= (isset($intervention_class) && $intervention_class['intervention_id'] == $intervention['id']) ? 'selected' : '' ?>>
                                <?= $intervention['intervention_name'] . ' [' . $intervention['intervention_id']  . ']' ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('intervention_id')) ? $validation->getError('intervention_id') : '' ?>
                </span>
            </div>

            <div class="form-group">
                <label for="class_name">Class Name</label>
                <input type="text" id="class_name" name="class_name" class="form-control"
                       value="<?= isset($intervention_class) ? esc($intervention_class['class_name']) : set_value('class_name') ?>"
                       required>
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('class_name')) ? $validation->getError('class_name') : '' ?>
                </span>
            </div>

            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" id="start_date" name="start_date" class="form-control"
                       value="<?= isset($intervention_class) ? esc($intervention_class['start_date']) : set_value('start_date') ?>"
                       required>
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('start_date')) ? $validation->getError('start_date') : '' ?>
                </span>
            </div>

            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" id="end_date" name="end_date" class="form-control"
                       value="<?= isset($intervention_class) ? esc($intervention_class['end_date']) : set_value('end_date') ?>"
                       required>
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('end_date')) ? $validation->getError('end_date') : '' ?>
                </span>
            </div>

            <div class="form-group">
                <label for="venue">Venue</label>
                <input type="text" id="venue" name="venue" class="form-control"
                       value="<?= isset($intervention_class) ? esc($intervention_class['venue']) : set_value('venue') ?>"
                       required>
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('venue')) ? $validation->getError('venue') : '' ?>
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
<?php include(APPPATH . 'Views/tables/intervention_classes_table.php'); ?>



