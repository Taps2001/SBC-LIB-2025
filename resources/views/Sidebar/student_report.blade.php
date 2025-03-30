<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <h2>Students Reports</h2>
        <div class="d-flex buttons d-flex justify-content-end">
            <button type="button" class="btn btn-sm btn-danger" id="generate">Generate Report</button>  
            <button type="button" class="btn btn-sm btn-warning" id="export">Export</button> 
            <button type="button" class="btn btn-sm btn-danger" id="import">Import</button> 
        </div>

    <!-- Bootstrap Tabs -->
        <ul class="nav nav-tabs mt-3">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#adminsTableContainer">Student Enrolled</a> 
            </li>
        </ul>

        <div class="tab-content mt-3">
            <!-- Student Information -->
            <div id="usersTableContainer" class="tab-pane fade show"> 

                
            </div>

            <!-- Student Enrolled -->
            <div id="adminsTableContainer" class="tab-pane fade show active"> 
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

        <!-- Add Student Modal -->
        <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content shadow-lg rounded-4">
                    <div class="modal-header bg-primary text-white d-flex justify-content-center w-100">
                        <h5 class="modal-title" id="addStudentModalLabel">Add Student</h5>
                        <button type="button" class="btn-close btn-close-white position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form id="addStudentForm">
                            <div class="row g-3">
                                <!-- First Row -->
                                <div class="col-md-4">
                                    <label for="IDNo" class="form-label">ID Number</label>
                                    <input type="text" class="form-control" id="IDNo" name="IDNo" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="BarcodeNo" class="form-label">Barcode Number</label>
                                    <input type="text" class="form-control" id="BarcodeNo" name="BarcodeNo" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="Gender" class="form-label">Gender</label>
                                    <select class="form-select" id="Gender" name="Gender" required>
                                        <option value="" selected disabled>Choose...</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>

                                <!-- Second Row -->
                                <div class="col-md-6">
                                    <label for="lname" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="lname" name="lname" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="fname" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="fname" name="fname" required>
                                </div>

                                <!-- Third Row -->
                                <div class="col-md-4">
                                    <label for="vCourse" class="form-label">Course</label>
                                    <input type="text" class="form-control" id="vCourse" name="vCourse">
                                </div>
                                <div class="col-md-4">
                                    <label for="yearLevel" class="form-label">Year Level</label>
                                    <input type="text" class="form-control" id="yearLevel" name="yearLevel">
                                </div>
                                <div class="col-md-4">
                                    <label for="Bdate" class="form-label">Birthdate</label>
                                    <input type="date" class="form-control" id="Bdate" name="Bdate" required>
                                </div>

                                <!-- Fourth Row -->
                                <div class="col-md-6">
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

        <!-- Generate Report Modal -->
        <div class="modal fade" id="GenerateReport" tabindex="-1" aria-labelledby="importStudentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content shadow-lg rounded-4 bg-light">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white d-flex justify-content-center w-100">
                        <h5 class="modal-title" id="importStudentModalLabel">Generate Report</h5>
                        <button type="button" class="btn-close btn-close-white position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body with Scrollable Content -->
                    <div class="modal-body p-4" style="max-height: 500px; overflow-y: auto;">
                        <!-- Report Options -->
                        <h6 class="mb-3">Select a Report to View:</h6>
                        <div class="list-group">
                            <!-- Top 10 Reports Section -->
                            <a href="#" class="list-group-item list-group-item-action bg-light rounded-3 shadow-sm mb-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>Top 10 Highest Logins</span>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-primary me-2">View</button>
                                        <button class="btn btn-sm btn-success">Download</button>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action bg-light rounded-3 shadow-sm mb-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>Top 10 Studying Students</span>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-primary me-2">View</button>
                                        <button class="btn btn-sm btn-success">Download</button>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action bg-light rounded-3 shadow-sm mb-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>Top 10 Best Performing Students</span>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-primary me-2">View</button>
                                        <button class="btn btn-sm btn-success">Download</button>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action bg-light rounded-3 shadow-sm mb-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>Top 10 Students with Most Attendance</span>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-primary me-2">View</button>
                                        <button class="btn btn-sm btn-success">Download</button>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action bg-light rounded-3 shadow-sm mb-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>Top 10 Most Improved Students</span>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-primary me-2">View</button>
                                        <button class="btn btn-sm btn-success">Download</button>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Note or Description -->
                        <div class="mt-4">
                            <p class="text-muted">
                                Select a report to view detailed information about the top-performing students in each category. You can filter and sort reports based on different parameters.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Import Modal -->
        <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importStudentModalLabel" aria-hidden="true">



    <!-- JS Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('script.js') }}"></script>

<script>
    $(document).ready(function() { 
        // Initialize Admins DataTable
        $('#StudEnrolled').DataTable({
            processing: true,
            serverSide: true,
            // scrollY: "300px",
            // scrollCollapse: true,
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
                        return `
                            <button class="action-btn delete" onclick="deleteUser(${row.IDno})">Delete</button>
                        `;
                    }
                }
            ]
        });
    // Add Modal Btn
    $('#import').on('click', function() {
        $('#importModal').modal('show');
    })

    $('#generate').on('click', function() {
        $('#GenerateReport').modal('show');
    })

    
    
    });

    function deleteUser(IDno) {
        // Replace confirm with SweetAlert2 modal
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
                    url: '/admin/student_report/delete/' + IDno,  // Use Studno in the URL
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',  // CSRF token for security
                    },
                    success: function(response) {
                        // Success message using iziToast
                        iziToast.success({
                            title: 'Success',
                            message: 'Student deleted successfully!',
                            position: 'topRight',
                            timeout: 3000  // Show message for 3 seconds
                        });
                        $('#StudEnrolled').DataTable().ajax.reload();  // Refresh the DataTable
                    },
                    error: function(xhr, status, error) {
                        // Error message using iziToast
                        iziToast.error({
                            title: 'Error',
                            message: 'Error deleting student: ' + (xhr.responseJSON.error || error),
                            position: 'topRight',
                            timeout: 3000  // Show message for 3 seconds
                        });
                    }
                });
            }
        });
    }
</script>
</body>
</html>
