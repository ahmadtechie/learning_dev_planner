<section class="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Setup Development Cycle</h3>
                    </div>

                    <?php if (\Config\Services::validation()->getErrors()): ?>
                        <div id="errorAlert" class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <?php foreach (\Config\Services::validation()->getErrors() as $error): ?>
                                <p><?= esc($error) ?></p>
                            <?php endforeach; ?>
                        </div>

                        <script>
                            // Hide the error alert after 3 seconds
                            setTimeout(function () {
                                $("#errorAlert").fadeOut("slow");
                            }, 3000);
                        </script>
                    <?php endif; ?>

                    <form id="quickForm">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="MaxCompetencies">Max Competencies</label>
                                <input type="number" name="max_competencies" class="form-control" id="MaxCompetencies" placeholder="Enter max competencies">
                            </div>
                            <div class="form-group">
                                <label for="cycle_year">Cycle Year</label>
                                <select class="form-control" id="cycle_year" name="cycle_year">
                                    <option>Select Cycle Year</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="month-picker">Start Month</label>
                                <select class="form-control" id="month-picker" name="start_month">
                                    <option>Select Start Month</option>
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="EndMonth">End Month</label>
                                <select class="form-control" id="month-picker" name="end_month">
                                    <option>Select End Month</option>
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="descriptor_text">Descriptor Text:</label>
                                <textarea class="form-control" id="descriptor_text" name="descriptor_text" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include(APPPATH . 'Views/tables/cycle_table.php'); ?>
<script>
    const currentYear = new Date().getFullYear();
    const cycleYearDropdown = document.getElementById('cycle_year');
    for (let i = 0; i < 3; i++) {
        let option = document.createElement('option');
        option.value = String(currentYear + i);
        option.textContent = String(currentYear + i);
        cycleYearDropdown.appendChild(option);
        cycleYearDropdown.appendChild(option);
    }
</script>

