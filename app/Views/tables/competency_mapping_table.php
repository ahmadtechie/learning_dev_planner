<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Job Competency Mappings</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped jobCompetencyTable">
                            <thead>
                            <tr>
                                <th>Job Title</th>
                                <th>Competencies</th>
                                <th>Updated At</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($jobCompetencies) && is_array($jobCompetencies)): ?>
                                <?php foreach ($jobCompetencies as $jobCompetency): ?>
                                    <tr>
                                        <td><?= $jobCompetency['job_title'] ?></td>
                                        <td><?= $jobCompetency['competencies'] ?></td>
                                        <td><?= $jobCompetency['updated_at']; ?></td>
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
                                                       href="<?= url_to('ldm.competencies.mapping.edit', $jobCompetency['job_id']) ?>">Edit</a>
                                                    <a class="dropdown-item delete-btn"
                                                       href="#" onclick="confirmDelete(<?= $jobCompetency['job_id'] ?>)">Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="2">No job competencies found</td>
                                </tr>
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
    function confirmDelete(jobId) {
        if (confirm("Are you sure you want to delete this job-competencies?")) {
            window.location.href = "<?= url_to('ldm.competencies.mapping.delete') ?>?job_id=" + jobId;
        }
    }
</script>

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
            "order": [[2, "desc"]],

        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
