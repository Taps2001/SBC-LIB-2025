<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Student Information</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('Style/dash.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    
</head>
<body>
    <div class="top-header">Southern Baptist College Library</div>
    <button class="toggle-dark-mode" onclick="toggleDarkMode()">
        <img id="darkModeIcon" src="icons/dark_mode_2.png" alt="Toggle Mode">
    </button>
    

    @include('sidebar.sidebar')

    <!-- Main Content -->
    <div class="main-content">
        <h2>Student Data</h2>
        <!-- Bootstrap Tabs -->
        <ul class="nav nav-tabs mt-3">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#usersTableContainer">Student Information</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#adminsTableContainer">Student Enrolled</a>
            </li>
            
        </ul>

        <div class="tab-content mt-3">
            <!-- Student Information -->
                <div id="usersTableContainer" class="tab-pane fade show active">

                <div class="d-flex buttons d-flex justify-content-end">
                    <button type="button" class="btn btn-sm btn-success" id="addStudentButton">Add Student</button>
                    <button type="button" class="btn btn-sm btn-warning" id="export">Export</button>  
                    <button type="button" class="btn btn-sm btn-danger" id="import">Import</button> 
                </div>
                <div class="table-container">
                    <table id="StudeInfo" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID Number</th>
                                <th>Student Name</th>
                                <th>Gender</th>
                                <th>Course</th>
                                <th>HomeAddress</th>
                                <th>StudStatus</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <!-- Student Enrolled< -->
                <div id="adminsTableContainer" class="tab-pane fade active">
                    <div class="table-container">
                        <table id="StudEnrolled" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID Number</th>
                                    <th>Student Name</th>
                                    <th>Course</th>
                                    <th>Year Level</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <!-- Add Student Modal -->
        <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content shadow-lg rounded-4">
                    <div class="modal-header bg-primary text-white d-flex justify-content-center w-100">
                        <h5 class="modal-title" id="addStudentModalLabel">Add Student</h5>
                        <button type="button" class="btn-close btn-close-white position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form id="AddStudentForm" method="POST">
                            <!-- Populate with your fields, similar to the Add Student modal -->
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="IDNo" class="form-label">ID Number</label>
                                    <input type="text" class="form-control" id="IDNo" name="IDNo">
                                </div>
                                <div class="col-md-6">
                                    <label for="BarcodeNo" class="form-label">Barcode Number</label>
                                    <input type="text" class="form-control" id="BarcodeNo" name="BarcodeNo">
                                </div>

                                <!-- Second Row -->
                                <div class="col-md-5">
                                    <label for="lname" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="lname" name="lname">
                                </div>
                                <div class="col-md-5">
                                    <label for="fname" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="fname" name="fname">
                                </div>

                                <div class="col-md-2">
                                    <label for="mi" class="form-label">Middle Initial</label>
                                    <input type="text" class="form-control" id="mi" name="mi">
                                </div>

                                <!-- Third Row -->
                                <div class="col-md-2">
                                    <label for="Gender" class="form-label">Gender</label>
                                    <select class="form-select" id="Gender" name="Gender">
                                        <option value="" selected disabled>Choose...</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>

                                <!-- <div class="col-md-3">
                                    <label for="isActive" class="form-label">Status</label>
                                    <select class="form-select" id="isActive" name="isActive">
                                        <option value="" selected disabled>Choose...</option>
                                        <option value="0">Inactive</option>
                                        <option value="1">Active</option>
                                    </select>
                                </div> -->

                                <div class="col-md-7">
                                    <label for="vCourse" class="form-label">Course</label>
                                    <input type="text" class="form-control" id="vCourse" name="vCourse">
                                </div>
                                <div class="col-md-3">
                                    <label for="yearLevel" class="form-label">Year Level</label>
                                    <input type="text" class="form-control" id="yearLevel" name="yearLevel">
                                </div>
                                <div class="col-md-4">
                                    <label for="Bdate" class="form-label">Birthdate</label>
                                    <input type="date" class="form-control" id="Bdate" name="Bdate">
                                </div>

                                <div class="col-md-4">
                                    <label for="PBirth" class="form-label">Birth Place</label>
                                    <input type="text" class="form-control" id="PBirth" name="PBirth">
                                </div>

                                <!-- Fourth Row -->
                                <div class="col-md-4">
                                    <label for="HomeAddress" class="form-label">Home Address</label>
                                    <input type="text" class="form-control" id="HomeAddress" name="HomeAddress">
                                </div>
                                <div class="col-md-6">
                                    <label for="Gurdian" class="form-label">Guardian</label>
                                    <input type="text" class="form-control" id="Gurdian" name="Gurdian">
                                </div>

                                <!-- Fifth Row -->
                                <div class="col-md-6">
                                    <label for="Guardian_Address" class="form-label">Guardian Address</label>
                                    <input type="text" class="form-control" id="Guardian_Address" name="Guardian_Address">
                                </div>

                                <div class="col-md-3">
                                    <label for="idstatus" class="form-label">ID Status</label>
                                    <select class="form-select" id="idstatus" name="idstatus">
                                        <option value="" selected disabled>Choose...</option>
                                        <option value="New">New</option>
                                        <option value="Renew">Renew</option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label for="isenrolled" class="form-label">Is Enrolled?</label>
                                    <select class="form-select" id="isenrolled" name="isenrolled">
                                        <option value="" selected disabled>Choose...</option>
                                        <option value="Processing">Processing</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Enrolled">Enrolled</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="Remarks" class="form-label">Remarks</label>
                                    <input type="text" class="form-control" id="Remarks" name="Remarks">
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="modal-footer mt-4">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Student</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

       <!-- Update Student Modal -->
        <div class="modal fade" id="updateStudentModal" tabindex="-1" aria-labelledby="updateStudentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content shadow-lg rounded-4">
                    <div class="modal-header bg-primary text-white d-flex justify-content-center w-100">
                        <h5 class="modal-title" id="updateStudentModalLabel">Update Student</h5>
                        <button type="button" class="btn-close btn-close-white position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form id="updateStudentForm">
                        <input type="hidden" id="update_id">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="Barcode" class="form-label fw-bold text-center">Barcode Number</label>
                                    <input type="text" class="form-control" id="Bar" name="Barcode">
                                </div>
                                <div class="col-md-6">
                                    <label for="ID" class="form-label fw-bold text-center">ID Number</label>
                                    <input type="text" class="form-control" id="ID" name="ID">
                                </div>

                                <!-- Second Row -->
                                <div class="col-md-4">
                                    <label for="lname" class="form-label fw-bold text-center">Last Name</label>
                                    <input type="text" class="form-control" id="l" name="lname">
                                </div>
                                <div class="col-md-4">
                                    <label for="fname" class="form-label fw-bold text-center">First Name</label>
                                    <input type="text" class="form-control" id="f" name="fname">
                                </div>

                                <div class="col-md-2">
                                    <label for="mi" class="form-label fw-bold text-center">Middle Name</label>
                                    <input type="text" class="form-control" id="m" name="mi">
                                </div>

                                <!-- Third Row -->
                                <div class="col-md-2">
                                    <label for="Gender" class="form-label fw-bold text-center">Gender</label>
                                    <select class="form-select" id="gen" name="Gender">
                                        <option value="" selected disabled>Choose...</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>


                                <div class="col-md-3">
                                    <label for="isActive" class="form-label fw-bold text-center">Status</label>
                                    <input type="text" class="form-control" id="status" name="isActive">
                                </div>

                                <div class="col-md-6">
                                    <label for="vCourse" class="form-label fw-bold text-center">Course</label>
                                    <input type="text" class="form-control" id="course" name="vCourse">
                                </div>
                                <div class="col-md-3">
                                    <label for="yearLevel" class="form-label fw-bold text-center">Year Level</label>
                                    <input type="text" class="form-control" id="year" name="yearLevel">
                                </div>
                                <div class="col-md-4">
                                    <label for="Bdate" class="form-label fw-bold text-center">Birthdate</label>
                                    <input type="date" class="form-control" id="birt" name="Bdate">
                                </div>

                                <div class="col-md-4">
                                    <label for="PBirth" class="form-label fw-bold text-center">Birth Place</label>
                                    <input type="text" class="form-control" id="placeb" name="PBirth">
                                </div>

                                <!-- Fourth Row -->
                                <div class="col-md-4">
                                    <label for="HomeAddress" class="form-label fw-bold text-center">Home Address</label>
                                    <input type="text" class="form-control" id="homed" name="HomeAddress">
                                </div>
                                <div class="col-md-6">
                                    <label for="Gurdian" class="form-label fw-bold text-center">Guardian</label>
                                    <input type="text" class="form-control" id="guard" name="Gurdian">
                                </div>

                                <!-- Fifth Row -->
                                <div class="col-md-6">
                                    <label for="Guardian_Address" class="form-label fw-bold text-center">Guardian Address</label>
                                    <input type="text" class="form-control" id="guard_Address" name="Guardian_Address">
                                </div>

                                <div class="col-md-3">
                                    <label for="idstatus" class="form-label fw-bold text-center">ID STATUS</label>
                                    <select class="form-select" id="id" name="idstatus">
                                        <option value="" selected disabled>Choose...</option>
                                        <option value="New">New</option>
                                        <option value="Renew">Renew</option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label for="isenrolled" class="form-label fw-bold text-center">Is Enrolled?</label>
                                    <select class="form-select" id="enrolled" name="isenrolled">
                                        <option value="" >Choose...</option>
                                        <option value="Processing">Processing</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Enrolled">Enrolled</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="Remarks" class="form-label fw-bold text-center">Remarks</label>
                                    <input type="text" class="form-control" id="marks" name="Remarks">
                                </div>
                            </div>

                            </div>
                            <div class="modal-footer mt-4">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

      <!-- Import Modal -->
      <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importStudentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content shadow-lg rounded-4 bg-light">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white d-flex justify-content-center w-100">
                        <h5 class="modal-title" id="importStudentModalLabel">Upload Student Data File</h5>
                        <button type="button" class="btn-close btn-close-white position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body p-4">
                        <form id="importStudentForm">
                            <div class="row g-3">
                                <!-- File Upload Section -->
                                <div class="col-md-12">
                                    <label for="fileUpload" class="form-label fs-5 fw-semibold text-dark">Select File to Upload</label>
                                    <input type="file" class="form-control form-control-lg" id="fileUpload" name="fileUpload" required>
                                    <small class="text-muted mt-2 d-block">Please select a valid data file (CSV, XLSX, etc.) for uploading.</small>
                                </div>
                            </div>

                            <!-- Modal Footer -->
                            <div class="modal-footer d-flex justify-content-between align-items-center">
                                <button type="button" class="btn btn-outline-secondary btn-lg" data-bs-dismiss="modal">
                                    <i class="bi bi-x-circle"></i> Close
                                </button>
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="bi bi-upload"></i> Upload File
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>




    <!-- JS Libraries -->
   
   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('script.js') }}"></script>


    <script>
    $(document).ready(function() {
        // STUDENT INFO TABLE
        $('#StudeInfo').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.student_info.list') }}",
            columns: [
                { data: 'IDNo', name: 'IDNo' },
                { data: 'FullName', name: 'FullName' },
                { data: 'Gender', name: 'Gender' },
                { data: 'vCourse', name: 'vCourse' },
                { data: 'HomeAddress', name: 'HomeAddress' },
                { data: 'isActive', name: 'isActive' },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                            <button class="action-btn update" onclick="openUpdateModal('${row.IDNo}')">Update</button>
                            <button class="action-btn delete" data-id="${row.IDNo}">Delete</button>
                        `;
                    }
                }
            ]
        });


        

    // STUDENT ENROLLED TABLE
    $('#StudEnrolled').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.student_report.list') }}",
        columns: [
            { data: 'IDno', name: 'IDno' },
            { data: 'FullName', name: 'FullName' },
            { data: 'Course', name: 'Course' },
            { data: 'yearLevel', name: 'yearLevel' },
            { 
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `<button class="action-btn delete" onclick="deleteUser(${row.IDno})">Delete</button>`;
                }
            }
        ]
    });

    // DELETE STUDENT
    $(document).on('click', '.delete', function() {
        const IDNo = $(this).data('id');
        deleteUser(IDNo);
    });

    function deleteUser(IDNo) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/student_info/delete/' + IDNo,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        iziToast.success({
                            title: 'Success',
                            message: 'Student deleted successfully!',
                            position: 'topRight',
                            timeout: 3000
                        });
                        $('#StudeInfo').DataTable().ajax.reload();
                    },
                    error: function(xhr) {
                        iziToast.error({
                            title: 'Error',
                            message: xhr.responseJSON?.error || 'Failed to delete student.',
                            position: 'topRight'
                        });
                    }
                });
            }
        });
    }

    // ADD STUDENT
    $('#addStudentButton').on('click', function() {
        $('#addStudentModal').modal('show');
    });

    $('#AddStudentForm').on('submit', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: '/admin/student_info/add',
            method: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.message === 'Student added successfully.') {
                    iziToast.success({
                        title: 'Success',
                        message: response.message,
                        position: 'topRight'
                    });
                    $('#StudeInfo').DataTable().ajax.reload();
                    $('#addStudentModal').modal('hide');
                    $('#AddStudentForm')[0].reset();
                } else {
                    iziToast.error({
                        title: 'Error',
                        message: response.message,
                        position: 'topRight'
                    });
                }
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;
                if (errors) {
                    iziToast.error({
                        title: 'Error',
                        message: Object.values(errors).join(', '),
                        position: 'topRight'
                    });
                } else {
                    iziToast.error({
                        title: 'Error',
                        message: 'An error occurred. Please try again.',
                        position: 'topRight'
                    });
                }
            }
        });
    });

    // IMPORT BUTTON
    $('#import').on('click', function() {
            $('#importModal').modal('show');
        });
    });

// UPDATE AND EDIT STUDENT FUNCTION OUTSIDE READY
    function openUpdateModal(IDNo) {
        $.ajax({
            url: `/admin/student_info/${IDNo}/edit`,
            type: 'GET',
            success: function(response) {
                $('#update_id').val(response.IDNo);
                $('#Bar').val(response.BarcodeNo);
                $('#ID').val(response.IDNo);
                $('#l').val(response.lname);
                $('#f').val(response.fname);
                $('#m').val(response.mi);
                $('#gen').val(response.Gender);
                $('#status').val(response.isActive);
                $('#course').val(response.vCourse);
                $('#year').val(response.yearLevel);
                $('#birt').val(response.Bdate);
                $('#placeb').val(response.PBirth);
                $('#homed').val(response.HomeAddress);
                $('#guard').val(response.Gurdian);
                $('#guard_Address').val(response.Guardian_Address);
                $('#id').val(response.idstatus);
                $('#marks').val(response.Remarks);
                $('#enrolled').val(response.isenrolled);

                $('#updateStudentModal').modal('show');
            },
            error: function(xhr) {
                console.error("Failed to fetch data for update", xhr);
            }
        });
    }

    // Submit update form
    $('#updateStudentForm').on('submit', function (e) {
        e.preventDefault();

        const IDNo = $('#update_id').val(); // Hidden input holding the ID

        const data = {
            BarcodeNo: $('#Bar').val(),
            IDNo: $('#ID').val(),
            lname: $('#l').val(),
            fname: $('#f').val(),
            mi: $('#m').val(),
            Gender: $('#gen').val(),
            isActive: $('#status').val(),
            vCourse: $('#course').val(),
            yearLevel: $('#year').val(),
            Bdate: $('#birt').val(),
            PBirth: $('#placeb').val(),
            HomeAddress: $('#homed').val(),
            Gurdian: $('#guard').val(),
            Guardian_Address: $('#guard_Address').val(),
            idstatus: $('#id').val(),
            Remarks: $('#marks').val(),
            isenrolled: $('#isenrolled').val(),
            _token: $('meta[name="csrf-token"]').attr('content') // CSRF token for Laravel
        };

        $.ajax({
            url: `/admin/student_info/${IDNo}/update`, // Backend endpoint
            type: 'PUT',
            data: data,
            success: function (response) {
                $('#updateStudentModal').modal('hide');
                $('#StudeInfo').DataTable().ajax.reload(null, false); // Reload the table

                iziToast.success({
                    title: 'Success',
                    message: 'Student updated successfully!',
                    position: 'topRight'
                });
            },
            error: function (xhr) {
                iziToast.error({
                    title: 'Error',
                    message: 'Update failed. Please check your inputs.',
                    position: 'topRight'
                });
            }
        });
    });


    


</script>

</body>
</html>
