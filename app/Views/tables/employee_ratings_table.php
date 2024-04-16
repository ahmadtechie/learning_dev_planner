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

                            use App\Models\DevelopmentContractingModel;

                            $competencyModel = new \App\Models\CompetencyModel();
                            $cycles = new \App\Models\DevelopmentCycleModel();

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
            "order": [[ 4, "desc" ]]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
