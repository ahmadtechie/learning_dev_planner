<?php if (empty($data)): ?>
<?php include(APPPATH . 'Views/tables/attendance_table.php'); ?>
<?php else: ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Attendance Data Preview</h3>
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
                            <?= form_open_multipart(url_to('ldm.intervention.attendance.create')) ?>
                            <input type="hidden" name="encoded_data" value="<?= $uploadedFile ?>">
                            <table id="" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Employee Username</th>
                                    <th>Intervention ID</th>
                                    <th>Attendance Date</th>
                                    <th>Attendance Status</th>
                                    <th>Remarks</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($data as $row) : ?>
                                    <tr>
                                        <td><?= esc($row['employee_username']) ?? '' ?></td>
                                        <td><?= esc($row['intervention_class_id']) ?? '' ?></td>
                                        <td><?= esc($row['attendance_date']) ?? '' ?></td>
                                        <td><?= esc($row['attendance_status']) ?? ''  ?></td>
                                        <td><?= esc($row['remarks']) ?? ''  ?></td>
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
<?php endif; ?>


