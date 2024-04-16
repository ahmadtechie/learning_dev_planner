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
                            <?= form_open_multipart(url_to('ldm.employee.upload.create')) ?>
                            <input type="hidden" name="encoded_data" value="<?= $uploadedFile ?>">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Employee ID</th>
                                    <th>Intervention ID</th>
                                    <th>Attendance Date</th>
                                    <th>Attendance Status</th>
                                    <th>Session Duration</th>
                                    <th>Remarks</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($data as $row) : ?>
                                    <tr>
                                        <td><?= esc($row['employee_id']) ?? '' ?></td>
                                        <td><?= esc($row['intervention_id']) ?? '' ?></td>
                                        <td><?= esc($row['attendance_date']) ?? '' ?></td>
                                        <td><?= esc($row['attendance_status']) ?? ''  ?></td>
                                        <td><?= esc($row['session_duration']) ?? ''  ?></td>
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

<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print"],
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
