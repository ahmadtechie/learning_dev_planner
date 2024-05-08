<div class="col-md-6 mx-auto">
    <div class="card card-info">
        <div class="card-header">
            <?php if (isset($competency)): ?>
                <h3 class="card-title">Edit Competency</h3>
            <?php else: ?>
                <h3 class="card-title">Create Competency</h3>
            <?php endif; ?>
        </div>

        <div class="card-body">
            <?php include(APPPATH . 'Views/includes/message.php'); ?>

            <?php if (isset($competency)): ?>
                <?= form_open(url_to('ldm.competencies.update', esc($competency['id']))) ?>
            <?php else: ?>
                <?= form_open(url_to('ldm.competencies.create')) ?>
            <?php endif; ?>

            <div class="form-group">
                <label for="competency_name">Competency Name <span>*</span></label>
                <input id="competency_name" type="text" name="competency_name" value="<?= isset($competency) ? esc($competency['competency_name']) : set_value('competency_name') ?>" class="form-control" placeholder="Enter competency name" required>
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('competency_name')) ? $validation->getError('competency_name') : '' ?>
                </span>
            </div>
            <div class="form-group">
                <label for="competency_type_id">Competency Type <span>*</span></label>
                <select id="competency_type_id" name="competency_type_id" class="form-control" required>
                    <option value="">Select Competency Type</option>
                    <?php if (!empty($competencyTypes)): ?>
                        <?php foreach ($competencyTypes as $competencyType): ?>
                            <option value="<?= $competencyType['id'] ?>" <?= (isset($competency) && $competency['competency_type_id'] == $competencyType['id']) ? 'selected' : '' ?>>
                                <?= $competencyType['name'] ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif ?>
                </select>
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('competency_type_id')) ? $validation->getError('competency_type_id') : '' ?>
                </span>
            </div>
            <div class="form-group">
                <label for="qualification">Descriptors <span>*</span></label>
                <textarea id="qualification" name="description" class="form-control" rows="3" placeholder="Enter Description" required><?= isset($competency) ? esc($competency['description']) : set_value('description') ?></textarea>
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('description')) ? $validation->getError('description') : '' ?>
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
<?php include(APPPATH . 'Views/tables/competency_table.php'); ?>

