<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Feedback Data</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped interventionClassTable">
                            <thead>
                            <tr>
                                <th>Intervention </th>
                                <th>Cycle Year</th>
                                <th>Message</th>
                                <th>Created At</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php use App\Models\DevelopmentCycleModel;
                            use App\Models\LearningInterventionModel;

                            if (!empty($feedbacks) && is_array($feedbacks)):
                                foreach ($feedbacks as $feedback): ?>
                                    <?php
                                    $interventionModel = new LearningInterventionModel();
                                    $intervention = $interventionModel->find($feedback['intervention_id']);
                                    $cycleModel = new DevelopmentCycleModel();
                                    $cycle = $cycleModel->find($feedback['cycle_id']);
                                    ?>
                                    <tr>
                                        <td><?= $intervention['intervention_name'] ?></td>
                                        <td><?= $cycle['cycle_year']; ?></td>
                                        <td><?= $feedback['feedback_text']; ?></td>
                                        <td><?= $feedback['updated_at']; ?></td>
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
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": [
                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible'
                    }
                }
                , "colvis",
            ],
            "order": [[3, "desc"]],

        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
