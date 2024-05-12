<?php //echo session()->get('loggedInEmployee') ?>
<section class="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Rate Self:
                            <strong><?= session()->get('first_name') . ' ' . session()->get('last_name') ?></strong>
                        </h3>
                    </div>
                    <?= form_open(url_to('ldm.rating.self')) ?>
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
                            <label for="dev_cycle">Development Cycle <span>*</span></label>
                            <select id="dev_cycle" name="cycle_id" class="form-control" required>
                                <option value="">Choose Dev Cycle</option>
                                <?php if (!empty($cycles) && is_array($cycles)): ?>
                                    <?php foreach ($cycles as $cycle): ?>
                                        <option value="<?= $cycle['id'] ?>"><?= esc($cycle['cycle_year']) ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <?php if (!empty($competencies)): ?>
                            <label for="strengths_hint" class="form-text text-muted">Rate your strengths on each
                                competency (1 = Weak, 10 = Strong)</label>
                            <?php foreach ($competencies as $index => $competency): ?>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="competency<?php echo $index; ?>"
                                               class="text-gray-dark"><?php echo $competency['competency_name']; ?>
                                            <span>*</span>
                                        </label>
                                        <input id="competency<?php echo $index; ?>" type="hidden" name="competency<?php echo $index + 1; ?>" value="<?= $competency['id']; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <select class="form-control" id="rating<?php echo $index; ?>"
                                                name="rating<?php echo $index + 1; ?>" required>
                                            <option value="">Select Rating</option>
                                            <?php for ($j = 1; $j <= 10; $j++): ?>
                                                <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <div class="card-footer text-center">
                        <button type="reset"class="btn btn-primary">Reset</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include(APPPATH . 'Views/tables/employee_ratings_table.php'); ?>




