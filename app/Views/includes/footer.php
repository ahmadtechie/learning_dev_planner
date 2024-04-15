</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
    <strong>Copyright &copy; <?= date('Y'); ?></strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Developed By</b> Ahmad Sharafudeen
    </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- jQuery -->
<!-- jQuery UI 1.11.4 -->
<!--<script  src="https://code.jquery.com/jquery-3.5.1.min.js"></script>-->
<script type="text/javascript" src="<?php echo base_url("plugins/jquery/jquery.min.js") ?>"></script>
<script src="<?php echo base_url("plugins/jquery-ui/jquery-ui.min.js") ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url("plugins/bootstrap/js/bootstrap.bundle.min.js") ?>">
</script>
<!-- ChartJS -->
<script src="<?php echo base_url("plugins/chart.js/Chart.min.js"); ?>"></script>
<!-- Sparkline -->
<script src="<?php echo base_url("plugins/sparklines/sparkline.js"); ?>"></script>
<!-- JQVMap -->
<script src="<?php echo base_url("plugins/jqvmap/jquery.vmap.min.js"); ?>"></script>
<script src="<?php echo base_url("plugins/jqvmap/maps/jquery.vmap.usa.js"); ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url("plugins/jquery-knob/jquery.knob.min.js"); ?>"></script>
<!-- Select2 -->
<script src="<?php echo base_url("plugins/select2/js/select2.full.min.js"); ?>"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="<?php echo base_url("plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"); ?>"></script>
<!-- InputMask -->
<script src="<?php echo base_url("plugins/moment/moment.min.js"); ?>"></script>
<script src="<?php echo base_url("plugins/inputmask/jquery.inputmask.min.js"); ?>"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url("plugins/moment/moment.min.js"); ?>"></script>
<script src="<?php echo base_url("plugins/daterangepicker/daterangepicker.js"); ?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url("plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"); ?>"></script>
<!-- Summernote -->
<script src="<?php echo base_url("plugins/summernote/summernote-bs4.min.js"); ?>"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url("plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url("dist/js/adminlte.js"); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url("dist/js/demo.js"); ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url("dist/js/pages/dashboard.js"); ?>"></script>

<!-- DataTables  & Plugins -->
<script src="<?php echo base_url("plugins/datatables/jquery.dataTables.min.js") ?>"></script>
<script src="<?php echo base_url("plugins/datatables-bs4/js/dataTables.bootstrap4.min.js") ?>"></script>
<script src="<?php echo base_url("plugins/datatables-responsive/js/dataTables.responsive.min.js") ?>"></script>
<script src="<?php echo base_url("plugins/datatables-responsive/js/responsive.bootstrap4.min.js") ?>"></script>
<script src="<?php echo base_url("plugins/datatables-buttons/js/dataTables.buttons.min.js") ?>"></script>
<script src="<?php echo base_url("plugins/datatables-buttons/js/buttons.bootstrap4.min.js") ?>"></script>
<script src="<?php echo base_url("plugins/jszip/jszip.min.js") ?>"></script>
<script src="<?php echo base_url("plugins/pdfmake/pdfmake.min.js") ?>"></script>
<script src="<?php echo base_url("plugins/pdfmake/vfs_fonts.js") ?>"></script>
<script src="<?php echo base_url("plugins/datatables-buttons/js/buttons.html5.min.js") ?>"></script>
<script src="<?php echo base_url("plugins/datatables-buttons/js/buttons.print.min.js") ?>"></script>
<script src="<?php echo base_url("plugins/datatables-buttons/js/buttons.colVis.min.js") ?>"></script>

<!-- Bootstrap Switch -->
<script src="<?php echo base_url("plugins/bootstrap-switch/js/bootstrap-switch.min.js") ?>"></script>
<!-- BS-Stepper -->
<script src="<?php echo base_url("plugins/bs-stepper/js/bs-stepper.min.js") ?>"></script>
<!-- dropzonejs -->
<script src="<?php echo base_url("plugins/dropzone/min/dropzone.min.js") ?>"></script>

<!-- AdminLTE App -->
<script src="<?php echo base_url("dist/js/adminlte.min.js") ?>"></script>
<!-- Page specific script -->

<script>
    // Event listener for Preview button
    document.getElementById("previewBtn").addEventListener("click", function () {
        // Clear existing previews
        document.getElementById("previewTableBody").innerHTML = "";

        // Send AJAX request to fetch preview data
        fetch('http://localhost:8080/ldm/employee/upload/preview', {
            method: 'POST',
            body: myDropzone.files[0]
        })
            .then(response => response.json())
            .then(data => {
                // Populate table with preview data
                data.forEach(rowData => {
                    const newRow = document.createElement("tr");
                    rowData.forEach(cellData => {
                        const newCell = document.createElement("td");
                        newCell.textContent = cellData;
                        newRow.appendChild(newCell);
                    });
                    document.getElementById("previewTableBody").appendChild(newRow);
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });

</script>

<script>
    $(document).ready(function() {
        $('#unitTable').DataTable({
            "order": [[ 2, "desc" ]]
        });
    });

    $(document).ready(function() {
        $('#jobCompetencyTable').DataTable({
            "order": [[ 2, "desc" ]]
        });
    });

    $(document).ready(function() {
        $('#jobTable').DataTable({
            "order": [[ 3, "desc" ]]
        });
    });

    $(document).ready(function() {
        $('#employeeTable').DataTable({
            "order": [[ 5, "desc" ]]
        });
    });

    $(document).ready(function() {
        $('#lineManagerAssignTable').DataTable({
            "order": [[ 2, "desc" ]]
        });
    });

    $(document).ready(function() {
        $('#DepartmentTable').DataTable({
            "order": [[ 3, "desc" ]]
        });
    });

    $(document).ready(function() {
        $('#DivisionTable').DataTable({
            "order": [[ 2, "desc" ]]
        });
    });

    $(document).ready(function() {
        $('#EmployeeDeptTable').DataTable({
            "order": [[ 3, "desc" ]]
        });
    });

    $(document).ready(function() {
        $('#EmployeeRatingsTable').DataTable({
            "order": [[ 4, "desc" ]]
        });
    });

    $(document).ready(function() {
        $('#GroupTable').DataTable({
            "order": [[ 3, "desc" ]]
        });
    });

    $(document).ready(function() {
        $('#GroupTable').DataTable({
            "order": [[ 3, "desc" ]]
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.competency-select').change(function() {
            var selectedCompetency = $(this).val();

            $('.competency-select').each(function() {
                    if (this !== event.target) {
                    $(this).find('option[value="' + selectedCompetency + '"]').remove();
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#department_map').on('change', function () {
            var selectedDepartmentId = $(this).val();
            console.log(selectedDepartmentId)

            $.ajax({
                url: 'http://localhost:8080/ldm/structure/units/all',
                type: 'POST',
                data: {department_id: selectedDepartmentId},
                dataType: 'json',
                success: function (response) {
                    units = response
                    // Clear existing options and add new options for fetched units
                    $('#unit').empty().append('<option>Choose Unit</option>');
                    $.each(units, function (index, unit) {
                        $('#unit').append('<option value="' + unit.id + '">' + unit.unit_name + '</option>');
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching units data:', error);
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function () {
        let initialEmployeeOptions = $('#employee_ids').html();

        function filterEmployeeOptions(lineManagerId) {
            $('#employee_ids').html(initialEmployeeOptions);
            $('#employee_ids option[value="' + lineManagerId + '"]').remove();
        }

        $('#line_manager').on('change', function () {
            let selectedLineManagerId = $(this).val();
            if (selectedLineManagerId) {
                filterEmployeeOptions(selectedLineManagerId);
                // Send AJAX request to fetch subordinate line manager
                $.ajax({
                    url: 'http://localhost:8080/ldm/employee/line-manager',
                    type: 'POST',
                    dataType: 'json',
                    data: {line_manager_id: selectedLineManagerId},
                    success: function (response) {
                        let subordinateLineManagerId = response.subordinate_line_manager_id;
                        $('#employee_ids option[value="' + subordinateLineManagerId + '"]').remove();
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                        console.error('Error fetching line manager id.');
                    }
                });
            } else {
                // If no line manager is selected, reset the employee options
                $('#employee_ids').html(initialEmployeeOptions);
            }
        });
    });

</script>

<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>

<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy'})
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', {'placeholder': 'mm/dd/yyyy'})
        //Money Euro
        $('[data-mask]').inputmask()

        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'L'
        });

        //Date and time picker
        $('#reservationdatetime').datetimepicker({icons: {time: 'far fa-clock'}});

        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
                format: 'MM/DD/YYYY hh:mm A'
            }
        })
        //Date range as a button
        $('#daterange-btn').daterangepicker(
            {
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function (start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
        )

        //Timepicker
        $('#timepicker').datetimepicker({
            format: 'LT'
        })

        //Bootstrap Duallistbox
        $('.duallistbox').bootstrapDualListbox()

        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()

        $('.my-colorpicker2').on('colorpickerChange', function (event) {
            $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
        })

        $("input[data-bootstrap-switch]").each(function () {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })

    })
    // BS-Stepper Init
    document.addEventListener('DOMContentLoaded', function () {
        window.stepper = new Stepper(document.querySelector('.bs-stepper'))
    })

    // DropzoneJS Demo Code Start
    Dropzone.autoDiscover = false

    // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
    var previewNode = document.querySelector("#template")
    previewNode.id = ""
    var previewTemplate = previewNode.parentNode.innerHTML
    previewNode.parentNode.removeChild(previewNode)

    var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
        url: "/target-url", // Set the url
        thumbnailWidth: 80,
        thumbnailHeight: 80,
        parallelUploads: 20,
        previewTemplate: previewTemplate,
        autoQueue: false, // Make sure the files aren't queued until manually added
        previewsContainer: "#previews", // Define the container to display the previews
        clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
    })

    myDropzone.on("addedfile", function (file) {
        // Hookup the start button
        file.previewElement.querySelector(".start").onclick = function () {
            myDropzone.enqueueFile(file)
        }
    })

    // Update the total progress bar
    myDropzone.on("totaluploadprogress", function (progress) {
        document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
    })

    myDropzone.on("sending", function (file) {
        // Show the total progress bar when upload starts
        document.querySelector("#total-progress").style.opacity = "1"
        // And disable the start button
        file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
    })

    // Hide the total progress bar when nothing's uploading anymore
    myDropzone.on("queuecomplete", function (progress) {
        document.querySelector("#total-progress").style.opacity = "0"
    })

    // Setup the buttons for all transfers
    // The "add files" button doesn't need to be setup because the config
    // `clickable` has already been specified.
    document.querySelector("#actions .start").onclick = function () {
        myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
    }
    document.querySelector("#actions .cancel").onclick = function () {
        myDropzone.removeAllFiles(true)
    }
    // DropzoneJS Demo Code End
</script>


</body>
</html>