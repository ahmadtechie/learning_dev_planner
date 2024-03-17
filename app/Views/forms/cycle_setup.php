<section class="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-info">
                    <div class="card-header">
                        <?php if (isset($cycle)): ?>
                            <h3 class="card-title">Edit Development Cycle</h3>
                        <?php else: ?>
                            <h3 class="card-title">Setup Development Cycle</h3>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <?php if (isset($cycle)): ?>
                            <?= form_open(url_to('ldm.cycle.update', esc($cycle['id']))) ?>
                        <?php else: ?>
                            <?= form_open(url_to('ldm.cycle.create')) ?>
                        <?php endif; ?>
                        <div class="form-group">
                            <label for="MaxCompetencies">Max Competencies</label>
                            <input type="number" name="max_competencies" class="form-control" id="MaxCompetencies"
                                   placeholder="Enter max competencies"
                                   value="<?= isset($cycle) ? esc($cycle['max_competencies']) : set_value('max_competencies') ?>">
                            <span class="text-danger">
                                <?= (isset($validation) && $validation->hasError('max_competencies')) ? $validation->getError('max_competencies') : '' ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="cycle_year">Cycle Year</label>
                            <select class="form-control" id="cycle_year" name="cycle_year">
                                <option>Select Cycle Year</option>
                                <?php
                                    $years = range(date('Y'), date('Y') + 2);
                                    foreach ($years as $year):
                                ?>
                                    <?php if (isset($cycle) and $cycle['cycle_year'] == $year): ?>
                                        <option value="<?= $year ?>" selected><?= $year ?></option>
                                    <?php else: ?>
                                        <option value="<?= $year ?>"><?= $year ?></option>
                                    <?php endif ?>
                                <?php endforeach; ?>
                            </select>
                            <span class="text-danger">
                                <?= (isset($validation) && $validation->hasError('cycle_year')) ? $validation->getError('cycle_year') : '' ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="month-picker">Start Month</label>
                            <select class="form-control" id="month-picker" name="start_month">
                                <option>Select Start Month</option>
                                <?php
                                $selected_start_month = isset($cycle) ? $cycle['start_month'] : set_value('$start_month');
                                $months = [
                                    1 => 'January',
                                    2 => 'February',
                                    3 => 'March',
                                    4 => 'April',
                                    5 => 'May',
                                    6 => 'June',
                                    7 => 'July',
                                    8 => 'August',
                                    9 => 'September',
                                    10 => 'October',
                                    11 => 'November',
                                    12 => 'December',
                                ];
                                ?>
                                <?php for($month = 1; $month <= count($months); $month++) { ?>
                                    <?php if ($month == $selected_start_month): ?>
                                        <option value="<?= $selected_start_month ?>"
                                                selected><?= $months[$selected_start_month] ?></option>
                                    <?php else: ?>
                                        <option value="<?= $month ?>"><?= $months[$month] ?></option>
                                    <?php endif; ?>
                                <?php } ?>
                            </select>
                            <span class="text-danger">
                                    <?= (isset($validation) && $validation->hasError('start_month')) ? $validation->getError('start_month') : '' ?>
                                </span>
                        </div>
                        <div class="form-group">
                            <label for="EndMonth">End Month</label>
                            <select class="form-control" id="month-picker" name="end_month">
                                <option>Select End Month</option>
                                <?php
                                $selected_end_month = isset($cycle) ? $cycle['end_month'] : set_value('end_month');
                                ?>
                                <?php for($month = 1; $month <= count($months); $month++) { ?>
                                    <?php if ($month == $selected_end_month): ?>
                                        <option value="<?= $selected_end_month ?>"
                                                selected><?= $months[$selected_end_month] ?></option>
                                    <?php else: ?>
                                        <option value="<?= $month ?>"><?= $months[$month] ?></option>
                                    <?php endif; ?>
                                <?php } ?>
                            </select>
                            <span class="text-danger">
                                <?= (isset($validation) && $validation->hasError('end_month')) ? $validation->getError('end_month') : '' ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="descriptor_text">Descriptor Text:</label>
                            <textarea class="form-control" id="descriptor_text" name="descriptor_text"
                                      rows="3"></textarea>
                            <span class="text-danger">
                                <?= (isset($validation) && $validation->hasError('descriptor_text')) ? $validation->getError('descriptor_text') : '' ?>
                            </span>
                        </div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-3">
                                <button class="btn btn-primary" type="reset">Reset</button>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include(APPPATH . 'Views/tables/cycle_table.php'); ?>

