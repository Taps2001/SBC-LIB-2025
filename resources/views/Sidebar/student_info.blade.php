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
                    <button type="button" class="btn btn-sm btn-success" id="addStudentButton">Add Student</button>  <!-- Green -->
                    <button type="button" class="btn btn-sm btn-warning" id="export">Export</button>  <!-- Yellow -->
                    <button type="button" class="btn btn-sm btn-danger" id="import">Import</button>  <!-- Red -->
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
    <script src="{{ asset('script.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Initialize Users DataTable
            $('#StudeInfo').DataTable({
                processing: true,
                serverSide: true,
                // scrollY: "300px", // Enable vertical scrolling
                // scrollCollapse: true,
                ajax: "{{ route('admin.student_info.list') }}",
                columns: [
                        { data: 'IDno', name: 'IDno' },
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
                                   
                                    <button class="action-btn update" onclick="updateUser(${row.id})">Update</button>
                                    <button class="action-btn delete" onclick="deleteUser(${row.id})">Delete</button>
                                `;
                            }
                        }
                ]
            });

            

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
                               
                        
                                <button class="action-btn delete" onclick="deleteUser(${row.id})">Delete</button>
                            `;
                        }
                    }
                ]
            });
            // Add Modal Btn
            $('#addStudentButton').on('click', function() {
            $('#addStudentModal').modal('show');
        })

            $('#import').on('click', function() {
                $('#importModal').modal('show');
        })
        });

     
    </script>
</body>
</html>
