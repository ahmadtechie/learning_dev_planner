<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Validate Employee Ratings</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?= form_open(url_to('ldm.rating.validate.update')) ?>
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
                        <div class="p-0">
                            <table id="example1" class="table table-hover">
                                <tbody>
                                <?php

                                use App\Models\DevelopmentContractingModel;
                                use App\Models\CompetencyModel;
                                use App\Models\DevelopmentCycleModel;
                                use App\Models\EmployeeModel;

                                $cycleModel = new DevelopmentCycleModel();
                                $activeCycle = $cycleModel->where('is_active', 1)->first();
                                ?>
                                <?php
                                $ratingModel = new DevelopmentContractingModel();
                                $competencyModel = new CompetencyModel();
                                $employeeModel = new EmployeeModel();
                                $loggedInLineMngId = session()->get('loggedInEmployee');
                                $lineManagerEmployees = $employeeModel->getEmployeesForLineManagerRating($loggedInLineMngId);
                                ?>
                                <?php foreach ($lineManagerEmployees as $lineManagerEmployee): ?>
                                    <?php
                                    $employee_ratings = $ratingModel
                                        ->where('employee_id', $lineManagerEmployee['employee_id'])
                                        ->where('cycle_id', $activeCycle['id'])
                                        ->orderBy('updated_at', 'ASC')
                                        ->findAll();
                                    if (empty($employee_ratings)):
                                        continue;
                                    endif;
                                    ?>
                                    <tr data-employee="<?= $lineManagerEmployee['employee_id'] ?>"
                                        class="expandable-row">
                                        <td>
                                            <i class="expandable-table-caret fas fa-caret-right fa-fw"></i>
                                            <?= $lineManagerEmployee['first_name'] . ' ' . $lineManagerEmployee['last_name'] ?>
                                        </td>
                                    </tr>
                                    <tr class="expandable-content" style="display: none;">
                                        <td>
                                            <div class="p-0">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>Dev Cycle Year</th>
                                                        <th>Competency</th>
                                                        <th>Employee Rating</th>
                                                        <th>Line Manager Rating</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach ($employee_ratings as $employee_rating): ?>
                                                        <?php $competency = $competencyModel->find($employee_rating['competency_id']); ?>
                                                        <tr>
                                                            <td><?= $activeCycle['cycle_year'] ?></td>
                                                            <td><?= $competency['competency_name'] ?></td>
                                                            <td><?= $employee_rating['self_rating'] ?></td>
                                                            <td>
                                                                <select name="line_manager_ratings[]">
                                                                    <?php for ($i = 1; $i <= 10; $i++) { ?>
                                                                        <?php if ($i == $employee_rating['line_manager_rating']): ?>
                                                                            <option value="<?= $i ?>"
                                                                                    selected><?= $i ?></option>
                                                                        <?php else: ?>
                                                                            <option value="<?= $i ?>"><?= $i ?></option>
                                                                        <?php endif; ?>
                                                                    <?php } ?>
                                                                </select>
                                                                <input type="hidden" name="competency_ids[]"
                                                                       value="<?= $competency['id'] ?>">
                                                                <input type="hidden" name="employee_ids[]"
                                                                       value="<?= $lineManagerEmployee['employee_id'] ?>">
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        <?= form_close() ?>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    $(document).ready(function () {
        $('.expandable-row').click(function () {
            $(this).next('.expandable-content').toggle();
            $(this).find('.expandable-table-caret').toggleClass('fa-caret-right fa-caret-down');
        });
    });
</script>


