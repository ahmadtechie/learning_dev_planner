<div class="col-md-6 mx-auto">
    <div class="card card-info">
        <div class="card-header">
            <?php if (isset($vendor)): ?>
                <h3 class="card-title">Edit Vendor</h3>
            <?php else: ?>
                <h3 class="card-title">Create Vendor</h3>
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
            <?php if (isset($vendor)): ?>
                <?= form_open(url_to('ldm.vendor.update', esc($vendor['id']))) ?>
            <?php else: ?>
                <?= form_open(url_to('ldm.vendor.create')) ?>
            <?php endif; ?>

            <div class="form-group">
                <label for="intervention_id">Learning Intervention</label>
                <select id="intervention_id" name="intervention_id" class="form-control" required>
                    <option value="">Select Intervention</option>
                    <?php foreach ($interventions as $intervention): ?>
                        <?php
                            $interventionModel = model(\App\Models\LearningInterventionModel::class);
                            $intervention = $interventionModel->find($intervention['id'])
                        ?>
                        <option value="<?= $intervention['id'] ?>" <?= (isset($vendor) && $vendor['intervention_id'] == $intervention['id']) ? 'selected' : '' ?>>
                            <?= $intervention['intervention_name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('intervention_id')) ? $validation->getError('intervention_id') : '' ?>
                </span>
            </div>

            <div class="form-group">
                <label for="vendor_name">Vendor Name <span>*</span></label>
                <input id="vendor_name" type="text" name="vendor_name" value="<?= isset($vendor) ? esc($vendor['vendor_name']) : set_value('vendor_name') ?>" class="form-control" placeholder="Enter Vendor Name" required>
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('vendor_name')) ? $validation->getError('vendor_name') : '' ?>
                </span>
            </div>
            <div class="form-group">
                <label for="contact_person">Contact Person</label>
                <input id="contact_person" type="text" name="contact_person" value="<?= isset($vendor) ? esc($vendor['contact_person']) : set_value('contact_person') ?>" class="form-control" placeholder="Enter Contact Person">
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('contact_person')) ? $validation->getError('contact_person') : '' ?>
                </span>
            </div>
            <div class="form-group">
                <label for="contact_email">Contact Email</label>
                <input id="contact_email" type="email" name="contact_email" value="<?= isset($vendor) ? esc($vendor['contact_email']) : set_value('contact_email') ?>" class="form-control" placeholder="Enter Contact Email">
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('contact_email')) ? $validation->getError('contact_email') : '' ?>
                </span>
            </div>
            <div class="form-group">
                <label for="contact_phone">Contact Phone</label>
                <input id="contact_phone" type="text" name="contact_phone" value="<?= isset($vendor) ? esc($vendor['contact_phone']) : set_value('contact_phone') ?>" class="form-control" placeholder="Enter Contact Phone">
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('contact_phone')) ? $validation->getError('contact_phone') : '' ?>
                </span>
            </div>
            <div class="form-group">
                <label for="service_provided">Service Provided</label>
                <input id="service_provided" type="text" name="service_provided" value="<?= isset($vendor) ? esc($vendor['service_provided']) : set_value('service_provided') ?>" class="form-control" placeholder="Enter Service Provided">
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('service_provided')) ? $validation->getError('service_provided') : '' ?>
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
<?php include(APPPATH . 'Views/tables/vendors_table.php'); ?>
