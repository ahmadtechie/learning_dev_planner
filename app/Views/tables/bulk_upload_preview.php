<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Employee Data Preview</h3>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($errors)) : ?>
                            <div class="alert alert-danger" role="alert">
                                <ul>
                                    <?php foreach ($errors as $error) : ?>
                                        <li><?= esc($error) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($data)) : ?>
                            <?= form_open_multipart(url_to('ldm.employee.upload.create')) ?>
                            <input type="hidden" name="encoded_data" value="<?= $uploadedFile ?>">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Email</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Job</th>
                                    <th>Employee Roles</th>
                                    <th>Department</th>
                                    <th>Unit</th>
                                    <th>Line Manager</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($data as $row) : ?>
                                    <tr>
                                        <td><?= esc($row['email']) ?? '' ?></td>
                                        <td><?= esc($row['first_name']) ?? '' ?></td>
                                        <td><?= esc($row['last_name']) ?? '' ?></td>
                                        <td><?= esc($row['job']) ?? ''  ?></td>
                                        <td><?= esc($row['employee_roles']) ?? ''  ?></td>
                                        <td><?= esc($row['department']) ?? ''  ?></td>
                                        <td><?= esc($row['unit']) ?? ''  ?></td>
                                        <td><?= esc($row['line_manager_username']) ?? ''  ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-success">Submit</button>
                            <?= form_close() ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
