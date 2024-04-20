<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">My Competency Ratings</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped employeeRatingsTable">
                            <thead>
                            <tr>
                                <th>Dev Cycle Year</th>
                                <th>Competency</th>
                                <th>Self-Ratings</th>
                                <th>Line Manager Ratings</th>
                                <th>Created At</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            use App\Models\CompetencyModel;
                            use App\Models\DevelopmentContractingModel;
                            use App\Models\DevelopmentCycleModel;

                            $competencyModel = new CompetencyModel();
                            $cycles = new DevelopmentCycleModel();

                            $ratingModel = new DevelopmentContractingModel();
                            $employee_id = session()->get('loggedInEmployee');

                            foreach ($cycles->findAll() as $cycle):
                                $cycle_competencies = $ratingModel->where('cycle_id', $cycle['id'])
                                    ->where('employee_id', $employee_id)
                                    ->findAll();

                                if (!empty($cycle_competencies)):
                                    foreach ($cycle_competencies as $cycle_competency):
                                        $competency = $competencyModel->find($cycle_competency['competency_id']);
                                        ?>
                                        <tr>
                                            <td><?= $cycle['cycle_year'] ?></td>
                                            <td>
                                                <?= $competency['competency_name']; ?>
                                            </td>
                                            <td>
                                                <?= $cycle_competency['self_rating']; ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($cycle_competency['line_manager_rating'] == '0'):
                                                    echo "-" . "<br>";
                                                else:
                                                    echo $cycle_competency['line_manager_rating'];
                                                endif;
                                                ?>
                                            </td>
                                            <td><?= $cycle_competency['created_at'] ?></td>
                                        </tr>
                                    <?php
                                    endforeach;
                                endif;
                            endforeach;
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- /.card-body -->
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
            "order": [[4, "desc"]],

        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>

