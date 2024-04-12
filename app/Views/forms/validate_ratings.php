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
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Dev Cycle Year</th>
                                <th>Employee</th>
                                <th>Competency</th>
                                <th>Employee Rating</th>
                                <th>Line Manager Rating</th>
                            </tr>
                            </thead>
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

                            $cycle_competencies = $ratingModel->where('cycle_id', $activeCycle['id'])->findAll();
                            foreach ($cycle_competencies as $cycle_competency):
                                $competency = $competencyModel->find($cycle_competency['competency_id']);
                                $employee = $employeeModel->getEmployeeDetailsWithUser($cycle_competency['employee_id']);
                                if ($employee['line_manager_id'] == $loggedInLineMngId):
                                    ?>
                                    <tr>
                                        <td><?= $activeCycle['cycle_year'] ?></td>
                                        <td><?= $employee['first_name'] . " " . $employee['last_name'] ?></td>
                                        <td><?= $competency['competency_name'] ?></td>
                                        <td><?= $cycle_competency['self_rating'] ?></td>
                                        <td>
                                            <select name="line_manager_ratings[]">
                                                <?php for ($i = 1; $i <= 10; $i++) { ?>
                                                    <?php if ($i == $cycle_competency['line_manager_rating']): ?>
                                                        <option value="<?= $i ?>" selected><?= $i ?></option>
                                                    <?php else: ?>
                                                        <option value="<?= $i ?>"><?= $i ?></option>
                                                    <?php endif; ?>
                                                <?php } ?>
                                            </select>
                                            <input type="hidden" name="competency_ids[]"
                                                   value="<?= $competency['id'] ?>">
                                            <input type="hidden" name="employee_ids[]"
                                                   value="<?= $cycle_competency['employee_id'] ?>">
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <?= form_close() ?>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>
