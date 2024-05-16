<div class="col-md-6 mx-auto">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Submit Feedback</h3>
        </div>

        <div class="card-body">
            <?php include(APPPATH . 'Views/includes/message.php'); ?>
            <?php
            $cycle_id = $_GET['cycle_id'] ?? null;
            $intervention_id = $_GET['intervention_id'] ?? null;
            ?>
            <?= form_open(url_to('ldm.feedback.create') . '?cycle_id=' . $cycle_id . '&intervention_id=' . $intervention_id) ?>
            <div class="form-group">
                <label for="feedback_text">Message <span>*</span></label>
                <textarea id="feedback_text" name="feedback_text" class="form-control" rows="5"
                          placeholder="Enter Feedback"
                          required><?= set_value('description') ?></textarea>
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('feedback_text')) ? $validation->getError('feedback_text') : '' ?>
                </span>
            </div>
            <?php if (isset($hasEmployeeSubmitFeedback) and !$hasEmployeeSubmitFeedback and $cycle_id and $intervention_id): ?>
            <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                    <button class="btn btn-primary" type="reset">Reset</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
            <?= form_close() ?>
            <?php endif; ?>
        </div>
        <!-- /.card-body -->
    </div>
</div>
