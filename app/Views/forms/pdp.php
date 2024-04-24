<?php

use App\Models\CompetencyModel;

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
                                <?php $competencyModel = model(CompetencyModel::class); ?>
                                <?php foreach ($employee_ratings as $ratingCount => $rating): ?>
                                    <?php $competency = $competencyModel->find($rating['competency_id']); ?>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <select class="form-control competency-select"
                                                    id="competency<?= $ratingCount ?>" name="competency<?= $ratingCount ?>"
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
                                                <input type="number" id="average_rating" name="average_rating"
                                                       value="<?= $avg_rating ?>" class="form-control" disabled>
                                                <?php $avg_rating_displayed = true; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="row card-footer justify-content-center">
                        <button type="submit" class="btn btn-primary col-md-3">Submit</button>
                    </div>
                    <?= form_close() ?>
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
                        <label for="employee-signoff">Employee Sign-off:</label>
                        <input type="checkbox" id="employee-signoff" name="employee-signoff">
                        <label for="lm-signoff">Line Manager Sign-off:</label>
                        <input type="checkbox" id="lm-signoff" name="lm-signoff">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
