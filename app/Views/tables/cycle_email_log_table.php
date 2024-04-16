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
                        <table id="example1" class="table table-bordered table-striped cycleEmailLogTable">
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

<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print"],
            "order": [[ 2, "desc" ]]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>