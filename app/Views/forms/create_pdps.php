<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Set Personal Development Plans</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?= form_open(url_to('ldm.rating.pdp.create'), array('id' => 'competencyForm')) ?>
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
                        <div class="row mt-3">
                            <div class="col-md-8 mx-auto">
                                <div class="alert alert-info" role="alert">
                                    <strong>Hint:</strong> Please select the top '<?= isset($active_cycle) ? $active_cycle['max_competencies'] : '' ?>'  competencies agreed with each of your direct reports for the <?= $active_cycle['cycle_year'] ?> development cycle.
                                </div>
                            </div>
                        </div>
                        <div class="p-0">
                            <table id="example1" class="table table-hover">
                                <tbody>
                                <?php

                                use App\Models\CompetencyModel;
                                use App\Models\DevelopmentContractingModel;
                                use App\Models\EmployeeModel;

                                $employeeModel = new EmployeeModel();
                                $ratingModel = new DevelopmentContractingModel();
                                $loggedInLineMngId = session()->get('loggedInEmployee');

                                $lineManagerEmployees = $employeeModel->getEmployeesUnderLineManager($loggedInLineMngId);
                                foreach ($lineManagerEmployees as $lineManagerEmployee):
                                    $employeeRatings = $ratingModel
                                        ->where('employee_id', $lineManagerEmployee['employee_id'])
                                        ->where('cycle_id', $active_cycle['id'])
                                        ->orderBy('updated_at', 'ASC')
                                        ->findAll();
                                    if (empty($employee_ratings)) continue;
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
                                                        <th>Select Top <?= $active_cycle['max_competencies'] ?>
                                                            Competencies
                                                        </th>
                                                        <th>Average Rating</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php $competencyModel = model(CompetencyModel::class); ?>
                                                    <?php $ratingCount = 0; ?>
                                                    <?php foreach ($employeeRatings as $rating): ?>
                                                        <?php $competency = $competencyModel->find($rating['competency_id']); ?>
                                                        <tr>
                                                            <td>
                                                                <input type="checkbox"
                                                                       class="form-check-input competency-checkbox ml-2"
                                                                       id="competency<?= $ratingCount ?>"
                                                                       name="competency<?= $ratingCount ?>"
                                                                       value="<?= $competency['id'] ?>" <?= (in_array($competency['id'], array_column($activeCycleSelectedCompetencies, 'competency_id'))) ? 'checked' : '' ?>>
                                                                <span class="ml-5"><?= $competency['competency_name'] ?></span>
                                                            </td>
                                                            <td>
                                                                <?php $avg_rating = ($rating['self_rating'] + $rating['line_manager_rating']) / 2; ?>
                                                                <span class="ml-5"><?= $avg_rating ?></span>
                                                                <input type="hidden"
                                                                       name="average_rating<?= $ratingCount ?>"
                                                                       value="<?= $avg_rating ?>">
                                                            </td>
                                                        </tr>
                                                        <?php $ratingCount++; ?>
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
                        <div class="row card-footer justify-content-center">
                            <button type="submit" class="btn btn-primary col-md-3">Submit</button>
                        </div>
                        <?= form_close() ?>
                    </div>
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

<script>
    function limitCheckboxSelection(formId, maxSelection) {
        var checkboxes = document.querySelectorAll('#' + formId + ' input[type="checkbox"]');
        var checkedCount = 0;

        checkboxes.forEach(function (checkbox) {
            if (checkbox.checked) {
                checkedCount++;
            }
        });

        checkboxes.forEach(function (checkbox) {
            checkbox.disabled = false;
        });

        if (checkedCount >= maxSelection) {
            checkboxes.forEach(function (checkbox) {
                if (!checkbox.checked) {
                    checkbox.disabled = true;
                }
            });
        }
    }

    // Function to disable all checkboxes
    function disableAllCompetencies(formId) {
        var checkboxes = document.querySelectorAll('#' + formId + ' input[type="checkbox"]');

        checkboxes.forEach(function (checkbox) {
            checkbox.disabled = true;
        });
    }

    window.addEventListener('load', function () {
        var forms = document.querySelectorAll('.competencyForm'); // Select all forms with class competencyForm
        forms.forEach(function (form) {
            var formId = form.id;
            var maxSelection = <?= $active_cycle['max_competencies'] ?>; // Retrieve max competencies for each form
            limitCheckboxSelection(formId, maxSelection); // Initially limit selections for each form

            form.querySelectorAll('input[type="checkbox"]').forEach(function (checkbox) {
                checkbox.addEventListener('change', function () {
                    limitCheckboxSelection(formId, maxSelection); // Update the limit whenever a checkbox is clicked for each form
                });
            });

            let selectedCompetencies = <?= json_encode(array_column($activeCycleSelectedCompetencies, 'competency_id')) ?>;
            if (selectedCompetencies.length > 0) {
                disableAllCompetencies(formId); // Disable all checkboxes if there are selected competencies for each form
            }
        });
    });
</script>



