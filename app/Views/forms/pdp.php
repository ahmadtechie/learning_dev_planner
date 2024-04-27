<?php

use App\Models\CompetencyModel;

$loggedInEmployeeId = session()->get('loggedInEmployee');

?>
<section class="content">
    <div class="container">
        <!-- Header Section -->

        <!-- Rate Self Section -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Personal Development Plan:
                            <strong><?= $loggedInUserFullName ?? '' ?></strong></h3>
                    </div>
                    <?= form_open(url_to('ldm.dashboard.pdp.create')) ?>
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
                            <label for="dev_cycle">Development
                                Cycle: <?= '(' . $active_cycle['cycle_year'] . ')' ?? '' ?></label>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="competency">Top 'n' Competencies</label>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="average_rating">Average Rating</label>
                            </div>
                        </div>
                        <?php if (!empty($employee_ratings)): ?>
                            <?php $competencyModel = model(CompetencyModel::class); ?>
                            <?php if (!empty($employee_ratings)): ?>
                                <?php foreach ($employee_ratings as $ratingCount => $rating): ?>
                                    <?php $competency = $competencyModel->find($rating['competency_id']); ?>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <select class="form-control competency-select"
                                                    id="competency<?= $ratingCount ?>"
                                                    name="competency<?= $ratingCount ?>"
                                                    required>
                                                <option value="<?= $competency['id'] ?>"
                                                        selected><?= $competency['competency_name'] ?></option>
                                                <?php foreach ($employee_ratings as $otherRating): ?>
                                                    <?php if ($otherRating['competency_id'] != $competency['id']): ?>
                                                        <?php $otherCompetency = $competencyModel->find($otherRating['competency_id']); ?>
                                                        <option value="<?= $otherCompetency['id'] ?>"><?= $otherCompetency['competency_name'] ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php
                                            $avg_rating = ($rating['self_rating'] + $rating['line_manager_rating']) / 2;
                                            ?>
                                            <input type="hidden" name="average_rating<?= $ratingCount ?>" value="<?= $avg_rating ?>">
                                            <span class="ml-5"><?= $avg_rating ?></span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <?php if (isset($line_manager) and $line_manager['employee_id'] === $loggedInEmployeeId): ?>
                        <div class="row card-footer justify-content-center">
                            <button type="submit" class="btn btn-primary col-md-3">Submit</button>
                        </div>
                        <?= form_close() ?>
                    <?php endif ?>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Employee and Line Manager Sign-off</h3>
                    </div>
                    <div class="card-body">
                        <!--                        // Logic to determine whether to show employee sign-off or line manager sign-off checkbox-->
                        <?php if (isset($line_manager) and $line_manager['employee_id'] === $loggedInEmployeeId): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="employee-signoff"
                                       name="employee_signed_off">
                                <label class="form-check-label" for="employee-signoff">Employee Sign-off</label>
                            </div>
                            <?php if (isset($employeeSignedOff) and !$employeeSignedOff): ?>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if (isset($line_manager) and $line_manager['employee_id'] === $loggedInEmployeeId): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="lm-signoff"
                                       name="line_manager_signed_off">
                                <label class="form-check-label" for="lm-signoff">Line Manager Sign-off</label>
                            </div>
                            <?php if (isset($employeeSignedOff) and !$employeeSignedOff): ?>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>

                    <div class="row card-footer justify-content-center">
                        <button type="submit" class="btn btn-primary col-md-3">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include(APPPATH . 'Views/tables/pdp_table.php'); ?>

