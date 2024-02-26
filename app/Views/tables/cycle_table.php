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
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Cycle Year</th>
                                <th>Start Month</th>
                                <th>End Month</th>
                                <th>Max Competencies</th>
                                <th>Descriptor Text</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($cycles) && is_array($cycles)): ?>
                                <?php foreach ($cycles as $cycle): ?>
                                    <tr>
                                        <td><?= $cycle['cycle_year']; ?></td>
                                        <td><?= $cycle['start_month'] ?></td>
                                        <td><?= $cycle['end_month']; ?></td>
                                        <td><?= $cycle['max_competencies']; ?></td>
                                        <td><?= $cycle['descriptor_text']; ?></td>
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
                                                       href="">Edit</a>
                                                    <a class="dropdown-item delete-btn"
                                                       href="">Delete</a>
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