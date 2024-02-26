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
                        <table id="jobCompetencyTable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Job Title</th>
                                <th>Competencies</th>
                                <th>Updated At</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($jobCompetencies) && is_array($jobCompetencies)): ?>
                                <?php foreach ($jobCompetencies as $job): ?>
                                    <tr>
                                        <td><?= $job['job_title'] ?></td>
                                        <td><?= $job['competencies'] ?></td>
                                        <td><?= $job['updated_at']; ?></td>
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
                                                       href="<?= url_to('ldm.competencies.mapping.edit', $job['job_id']) ?>">Edit</a>
                                                    <a class="dropdown-item delete-btn"
                                                       href="<?= url_to('ldm.competencies.mapping.delete', $job['job_id']) ?>">Delete</a>
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
