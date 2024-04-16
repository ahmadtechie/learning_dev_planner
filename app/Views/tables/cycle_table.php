<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Development Cycles</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped devCycleTable">
                            <thead>
                            <tr>
                                <th>Cycle Year</th>
                                <th>Start Month</th>
                                <th>End Month</th>
                                <th>Max Competencies</th>
                                <th>Descriptor Text</th>
                                <th>Is Active?</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($cycles) && is_array($cycles)): ?>
                                <?php
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
                                ]
                                ?>
                                <?php foreach ($cycles as $cycle): ?>
                                    <tr>
                                        <td><?= $cycle['cycle_year']; ?></td>
                                        <td><?= $months[$cycle['start_month']]; ?></td>
                                        <td><?= $months[$cycle['end_month']]; ?></td>
                                        <td><?= $cycle['max_competencies']; ?></td>
                                        <td><?= $cycle['descriptor_text']; ?></td>
                                        <?php
                                        if ($cycle['is_active'] == 1):
                                            ?>
                                            <td>Yes</td>
                                        <?php else: ?>
                                            <td>No</td>
                                        <?php endif; ?>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button"
                                                        class="btn btn-secondary dropdown-toggle"
                                                        data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item edit-btn"
                                                       href="<?= url_to('ldm.cycle.edit', $cycle['id']) ?>">Edit</a>
                                                    <a class="dropdown-item delete-btn"
                                                       href="<?= url_to('ldm.cycle.delete', $cycle['id']) ?>">Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print"],
            "order": [[ 0, "desc" ]]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>