<section class="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Rate Self: <strong><?= session()->get('first_name') . ' ' . session()->get('last_name') ?></strong></h3>
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
                                <select id="dev_cycle" name="cycle_id" class="form-control">
                                    <option>Choose Dev Cycle</option>
                                    <?php if (!empty($cycles) && is_array($cycles)): ?>
                                        <?php foreach ($cycles as $cycle): ?>
                                            <option value="<?= $cycle['id'] ?>"><?= esc($cycle['cycle_year']) ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <?php for ($i = 1; $i <= $cycle['max_competencies']; $i++): ?>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="competency<?php echo $i; ?>">Competency <?php echo $i; ?> <span>*</span></label>
                                        <select class="form-control competency-select" id="competency<?php echo $i; ?>" name="competency<?php echo $i; ?>" required>
                                            <option value="">Select Competency</option>
                                            <?php if (!empty($competencies)): ?>
                                                <?php foreach ($competencies as $competency): ?>
                                                    <option value="<?php echo $competency['id']; ?>"><?php echo $competency['competency_name']; ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="rating<?php echo $i; ?>">Rating <span>*</span></label>
                                        <select class="form-control" id="rating<?php echo $i; ?>" name="rating<?php echo $i; ?>" required>
                                            <option value="">Select Rating</option>
                                            <?php for ($j = 1; $j <= 10; $j++): ?>
                                                <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </div>
                            <?php endfor; ?>
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
<?php include(APPPATH . 'Views/tables/employee_ratings_table.php'); ?>



