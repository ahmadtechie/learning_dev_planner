<?php //echo "<pre>" .  print_r($uniqueJobIDs, true) . "</pre>" ?><!--;-->
<?php //echo $uniqueJobIDs; ?>
<section class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Filter below to collate employee learning information based on need:</h3>
            </div>
            <!-- /.card-header -->
            <?= form_open(url_to('ldm.dashboard.adp'), ['method' => 'get']) ?>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="competency_id">Per Competency:</label>
                            <select id="competency_id" class="form-control select2" name="competency"
                                    style="width: 100%;">
                                <option value="">Select Competency</option>
                                <?php if (!empty($all_competencies)): ?>
                                    <?php foreach ($all_competencies as $competency): ?>
                                        <option value="<?= $competency['id'] ?>"><?= $competency['competency_name'] ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group">
                            <label for="line_manager">Per Line Manager</label>
                            <select id="line_manager" class="form-control select2" name="line_manager"
                                    style="width: 100%;">
                                <option value="">Select Line Manager</option>
                                <?php if (!empty($line_managers)): ?>
                                    <?php foreach ($line_managers as $line_manager): ?>
                                        <option value="<?= $line_manager['employee_id'] ?>"><?= $line_manager['first_name'] . ' ' . $line_manager['last_name'] . ' [' . $line_manager['username'] . ']' ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <!-- /.form-group -->
                        <div class="form-group">
                            <label for="division">Per Division</label>
                            <select id="division" class="form-control select2" name="division" style="width: 100%;">
                                <option value="">Select Division</option>
                                <?php if (!empty($divisions)): ?>
                                    <?php foreach ($divisions as $division): ?>
                                        <option value="<?= $division['id'] ?>"><?= $division['division_name'] ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="group">Per Group</label>
                            <select id="group" class="form-control select2" name="group"
                                    style="width: 100%;">
                                <option value="">Select Group</option>
                                <?php if (!empty($groups)): ?>
                                    <?php foreach ($groups as $group): ?>
                                        <option value="<?= $group['id'] ?>"><?= $group['group_name'] ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="employee">Per Employee</label>
                            <select id="employee" class="form-control select2" name="employee"
                                    style="width: 100%;">
                                <option value="">Select Employee</option>
                                <?php if (!empty($employees)): ?>
                                    <?php foreach ($employees as $employee): ?>
                                        <option value="<?= $employee['employee_id'] ?>"><?= $employee['first_name'] . ' ' . $employee['last_name'] . '[' . $employee['username'] . ']' ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="department">Per Department</label>
                            <select id="department" class="form-control select2" name="department"
                                    style="width: 100%;">
                                <option value="">Select Department</option>
                                <?php if (!empty($departments)): ?>
                                    <?php foreach ($departments as $department): ?>
                                        <option value="<?= $department['id'] ?>"><?= $department['department_name'] ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="unit">Per Unit</label>
                            <select id="unit" class="form-control select2" name="unit"
                                    style="width: 100%;>
                                <option value=">
                                <option value="">Select Unit</option>
                                <?php if (!empty($units)): ?>
                                    <?php foreach ($units as $unit): ?>
                                        <option value="<?= $unit['id'] ?>"><?= $unit['unit_name'] ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.card-body -->
            <div class="row card-footer justify-content-center">
                <button type="submit" class="btn btn-primary col-md-3">Submit Query</button>
            </div>
            <?= form_close() ?>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.container-fluid -->
</section>
<?php include(APPPATH . 'Views/tables/adp_table.php'); ?>

<script>
    $(document).ready(function () {
        $('select').change(function() {
            let selectedValue = $(this).val();

            $('select').not(this).prop('disabled', !!selectedValue);
        });
    });
</script>



