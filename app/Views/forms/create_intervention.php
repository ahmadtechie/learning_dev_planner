<section class="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Register Vendor</h3>
                    </div>
                    <?= form_open(url_to('ldm.employee.create')) ?>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="InputVendorName">Vendor Name</label>
                            <input type="email" name="email" class="form-control" id="InputVendorName" placeholder="Enter Vendor Name" value="<?= set_value('vendor_name') ?>" required>
                            <span class="text-danger">
                                <?= (isset($validation) && $validation->hasError('vendor_name')) ? $validation->getError('vendor_name') : '' ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="ContactPerson">Contact Person</label>
                            <input type="text" name="contact_person" class="form-control" id="ContactPerson" placeholder="Enter Contact Person" value="<?= set_value('contact_person')  ?>" required>
                            <span class="text-danger">
                                <?= (isset($validation) && $validation->hasError('contact_person')) ? $validation->getError('contact_person') : '' ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="ContactEmail">Contact Email</label>
                            <input type="text" name="contact_email" class="form-control" id="ContactEmail" placeholder="Enter Email" value="<?= set_value('contact_email')  ?>" required>
                            <span class="text-danger">
                                    <?= (isset($validation) && $validation->hasError('contact_email')) ? $validation->getError('contact_email') : '' ?>
                                </span>
                        </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include(APPPATH . 'Views/tables/vendors_table.php'); ?>

