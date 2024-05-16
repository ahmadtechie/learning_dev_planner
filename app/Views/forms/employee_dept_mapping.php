<div class="col-md-6 mx-auto">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Edit Employee Dept/Unit</h3>
        </div>

        <div class="card-body">
            <?php include(APPPATH . 'Views/includes/message.php'); ?>
            <?= form_open(url_to('ldm.map.org.create')) ?>
            <div class="form-group">
                <label for="employee_ids">Select Employees <span>*</span></label>
                <select id="employee_ids" class="select2" data-placeholder="Select employees" name="employee_ids[]" multiple="multiple"
                        required style="width: 100%; height: 150px">
                    <?php if (!empty($employees) && is_array($employees)): ?>
                        <?php foreach ($employees as $employee): ?>
                            <?php
                            $isSelected = false;
                            if (!empty($selected_employees) && is_array($selected_employees)) {
                                foreach ($selected_employees as $selected_employee) {
                                    if ($employee['id'] == $selected_employee['id']) {
                                        $isSelected = true;
                                        break;
                                    }
                                }
                            }
                            ?>
                            <option value="<?= $employee['employee_id'] ?>" <?= set_select('employee_ids[]', $employee['id'], $isSelected) ?>>
                                <?= "{$employee['first_name']} {$employee['last_name']} - {$employee['username']}" ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </select>
                <span class="text-danger"><?= isset($validation) && $validation->hasError('employee_ids[]') ? $validation->getError('employee_ids[]') : '' ?></span>
            </div>
            <div class="form-group">
                <label for="department_map">Department <span>*</span></label>
                <select id="department_map" class="form-control" name="department_id" required>
                    <option>Choose Department</option>
                    <?php $selected_department_id = isset($employee) ? $employee['department_id'] : set_value('department_id') ?>
                    <?php if (!empty($departments) && is_array($departments)): ?>
                        <?php foreach ($departments as $department): ?>
                            <?php if ($department['id'] === $selected_department_id): ?>
                                <option value="<?= $department['id'] ?>"
                                        selected><?= $department['department_name'] ?></option>
                            <?php else: ?>
                                <option value="<?= $department['id'] ?>"><?= $department['department_name'] ?></option>
                            <?php endif ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('department_id')) ? $validation->getError('department_id') : '' ?>
                </span>
            </div>
            <div class="form-group">
                <label for="unit">Unit</label>
                <select id="unit" class="form-control" name="unit_id">
                    <option>Choose Unit</option>
                    <!-- Units options will be dynamically added here -->
                </select>
                <span class="text-danger">
                    <?= (isset($validation) && $validation->hasError('unit_id')) ? $validation->getError('unit_id') : '' ?>
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
        <!-- /.card-body -->
    </div>
</div>


<?php include(APPPATH . 'Views/tables/employee_dept_table.php'); ?>

<script>
    $(document).ready(function () {
        $('#department_map').on('change', function () {
            var selectedDepartmentId = $(this).val();
            console.log(selectedDepartmentId)

            $.ajax({
                url: '<?= base_url() ?>ldm/structure/units/all',
                type: 'GET',
                data: {department_id: selectedDepartmentId},
                dataType: 'json',
                success: function (response) {
                    units = response
                    // Clear existing options and add new options for fetched units
                    $('#unit').empty().append('<option>Choose Unit</option>');
                    $.each(units, function (index, unit) {
                        $('#unit').append('<option value="' + unit.id + '">' + unit.unit_name + '</option>');
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching units data:', error);
                }
            });
        });
    });
</script>

