<?php

use App\Models\CompetencyModel;

$loggedInEmployeeId = session()->get('loggedInEmployee');

?>
<section class="content">
    <div class="container">
        <!-- Rate Self Section -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Personal Development Plan:
                            <strong><?= $loggedInUserFullName ?? '' ?></strong></h3>
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

                        <h5 class="text-center">Development
                            Cycle <?= '(' . $active_cycle['cycle_year'] . ')' ?? '' ?></h5>
                        <div class="row mt-3">
                            <div class="col-md-10 mx-auto">
                                <div class="alert alert-info" role="alert">
                                    <strong>Hint:</strong>Below are
                                    the <?= isset($active_cycle) ? $active_cycle['max_competencies'] : '' ?> top
                                    competencies you're focusing on for the <?= $active_cycle['cycle_year'] ?> cycle.
                                </div>
                            </div>
                        </div>
                        <div class="form-row text-center">
                            <div class="form-group col-md-6">
                                <label for="competency">Selected Top <?= $active_cycle['max_competencies'] ?>
                                    Competencies</label>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="average_rating">Average Rating</label>
                            </div>
                        </div>

                        <?php if (!empty($employee_ratings)): ?>
                            <?php $competencyModel = model(CompetencyModel::class); ?>
                            <?php $ratingCount = 0; ?>
                            <?php foreach ($employee_ratings as $rating): ?>
                                <?php $competency = $competencyModel->find($rating['competency_id']); ?>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="ml-5">
                                            <input type="checkbox" class="form-check-input competency-checkbox"
                                                   id="competency<?= $ratingCount ?>"
                                                   name="competency<?= $ratingCount ?>"
                                                   value="<?= $competency['id'] ?>" <?= (in_array($competency['id'], array_column($activeCycleSelectedCompetencies, 'competency_id'))) ? 'checked' : '' ?> disabled>
                                            <?= $competency['competency_name'] ?>
                                        </label>
                                    </div>

                                    <div class="form-group col-md-6 text-center">
                                        <?php
                                        $avg_rating = ($rating['self_rating'] + $rating['line_manager_rating']) / 2;
                                        ?>
                                        <span class="ml-5"><?= $avg_rating ?></span>
                                        <input type="hidden" name="average_rating<?= $ratingCount ?>"
                                               value="<?= $avg_rating ?>">
                                    </div>
                                </div>
                                <?php $ratingCount++; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php if(!empty($activeCycleSelectedCompetencies)): ?>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Employee and Line Manager Sign-off</h3>
                    </div>
                    <div class="card-body">
                        <?= form_open(url_to('ldm.dashboard.pdp.signoff', $active_cycle['id']), array('id' => 'signOffForm')) ?>
                        <?php if (isset($employee) and $employee['id'] === $loggedInEmployeeId): ?>
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
                            <?php if (isset($lineManagerSignedOff) and !$lineManagerSignedOff): ?>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?= form_close(); ?>
                    </div>

                    <div class="row card-footer justify-content-center">
                        <button type="submit" class="btn btn-primary col-md-3">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php include(APPPATH . 'Views/tables/pdp_table.php'); ?>

