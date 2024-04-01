<?php //echo url_to('ldm.employee.upload.preview') ?>
<div class="row ">
    <div class="col-md-8 mx-auto">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Employee Data Upload</h3>
            </div>
            <div class="card-body">
                <form id="uploadForm" class="dropzone" action="<?= site_url('ldm.employee.upload') ?>">
                    <div class="fallback">
                        <input name="file" type="file" multiple />
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button id="previewBtn" class="btn btn-info">Preview</button>
                <button id="submitBtn" class="btn btn-success">Submit</button>
                Download the CSV format to be used for the upload <a href="<?= url_to('ldm.employee.format') ?>">employee_bulk_upload_template.csv</a>
            </div>
        </div>
    </div>
</div>