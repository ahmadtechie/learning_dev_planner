<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Intervention Vendors</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped interventionVendorTable">
                            <thead>
                            <tr>
                                <th>Vendor Name</th>
                                <th>Contact Person</th>
                                <th>Contact Email</th>
                                <th>Contact Phone</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($interventionVendors) && is_array($interventionVendors)): ?>
                                <?php foreach ($interventionVendors as $vendor): ?>
                                    <tr>
                                        <td><?= $vendor['vendor_name']; ?></td>
                                        <td><?= $vendor['contact_person']; ?></td>
                                        <td><?= $vendor['contact_email']; ?></td>
                                        <td><?= $vendor['contact_phone']; ?></td>
                                        <td><?= $vendor['updated_at']; ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-secondary dropdown-toggle"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                       href="<?= url_to('ldm.vendor.edit', $vendor['id']) ?>">Edit</a>
                                                    <a class="dropdown-item"
                                                       href="<?= url_to('ldm.vendor.delete', $vendor['id']) ?>">Delete</a>
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
