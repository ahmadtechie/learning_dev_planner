<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Intervention Types</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="interventionTypesTable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Type Name</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($interventionTypes) && is_array($interventionTypes)): ?>
                                <?php foreach ($interventionTypes as $interventionType): ?>
                                    <tr>
                                        <td><?= esc($interventionType['name']); ?></td>
                                        <td><?= esc($interventionType['created_at']); ?></td>
                                        <td><?= esc($interventionType['updated_at']); ?></td>
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
                                                       href="<?= url_to('ldm.intervention.type.edit', $interventionType['id']) ?>">Edit</a>
                                                    <a class="dropdown-item delete-btn"
                                                       href="<?= url_to('ldm.intervention.type.delete', $interventionType['id']) ?>">Delete</a>
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
