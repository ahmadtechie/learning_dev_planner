<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Email Invite Logs</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Created At</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($email_logs) && is_array($email_logs)): ?>
                                <?php foreach ($email_logs as $email_log): ?>
                                    <tr>
                                        <td><?= $email_log['email']; ?></td>
                                        <td><?= $email_log['status']; ?></td>
                                        <td><?= $email_log['created_at']; ?></td>
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