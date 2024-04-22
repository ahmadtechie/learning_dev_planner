<section class="content">
    <div class="container">
        <!-- Header Section -->
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h2>{employee_name} Personal Development Plan {cycle_year}</h2>
            </div>
        </div>

        <!-- Rate Self Section -->
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
                        <?php foreach ($competencies as $competency): ?>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="competency<?= $competency['id'] ?>">Competency <?= $competency['id'] ?> <span>*</span></label>
                                    <select class="form-control competency-select" id="competency<?= $competency['id'] ?>" name="competency<?= $competency['id'] ?>" required>
                                        <option value="<?= $competency['id'] ?>"><?= $competency['competency_name'] ?></option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Average Rating</label>
                                    <!-- Display average rating -->
                                    <p>Average Self: <?= $competency['average_self_rating'] ?></p>
                                    <p>Average Line Manager: <?= $competency['average_lm_rating'] ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>

        <!-- Employee and Line Manager Sign-off Section -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Employee and Line Manager Sign-off</h3>
                    </div>
                    <div class="card-body">
                        <!-- Include options for sign-off -->
                        <label for="employee-signoff">Employee Sign-off:</label>
                        <input type="checkbox" id="employee-signoff" name="employee-signoff">
                        <!-- Include date of Employee sign-off -->
                        <label for="lm-signoff">Line Manager Sign-off:</label>
                        <input type="checkbox" id="lm-signoff" name="lm-signoff">
                        <!-- Include date of LM sign-off -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
