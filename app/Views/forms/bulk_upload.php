<div class="row ">
    <div class="col-md-8 mx-auto">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Upload Employee Data</h3>
            </div>
            <?= form_open_multipart(url_to('ldm.employee.upload.preview')) ?>
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
                <div class="form-group">
                    <label for="csv_file">Select CSV File</label>
                    <input type="file" class="form-control-file" id="csv_file" name="employee_csv" accept=".csv">
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
<!--                <button id="previewBtn" class="btn btn-info">Preview</button>-->
                <button id="submitBtn" class="btn btn-success">Preview</button>
                Download the CSV format to be used for the upload <a href="<?= url_to('ldm.employee.format') ?>">employee_bulk_upload_template.csv</a>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-8 mx-auto">
        <div class="alert alert-info" role="alert">
            <strong>Hint:</strong> Enter user roles as comma-separated values in the CSV file. Available roles include: LDM for Learning Development Manager, LineManager for Line Manager, Employee, and Trainer.
        </div>
    </div>
</div>
<?php if (isset($emailsNotInCSV)): ?>
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="alert alert-info" role="alert">
                <strong>Emails Not in CSV:</strong>
                <ul>
                    <?php foreach ($emailsNotInCSV as $email): ?>
                        <li><?= $email ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
<?php endif; ?>


<?php include(APPPATH . 'Views/tables/bulk_upload_preview.php'); ?>
