<?php if (isset($table_type) and $table_type == 'competency_table'): ?>
    <?php include(APPPATH . 'Views/tables/adp_competency_table.php'); ?>
<?php elseif(isset($table_type) and $table_type == 'employee_table'): ?>
    <?php include(APPPATH . 'Views/tables/adp_employee_table.php'); ?>
<?php else: ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Query Results</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered competencyTable table-striped">

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<script>
    $(document).ready(function () {
        $('#department').on('change', function () {
            let selectedDepartmentId = $(this).val();
            console.log(selectedDepartmentId)

            $.ajax({
                url: '<?= base_url() ?>ldm/structure/units/all',
                type: 'GET',
                data: {department_id: selectedDepartmentId},
                dataType: 'json',
                success: function (response) {
                    units = response
                    // Clear existing options and add new options for fetched units
                    $('#unit').empty().append('<option>Select Unit</option>');
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