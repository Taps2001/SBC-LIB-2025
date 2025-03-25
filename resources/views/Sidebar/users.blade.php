<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Account</title>
    
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
        <h2>Users Account</h2>
        <!-- <div class="btn">
            <div class="buttons">
                <button onclick="openModal()">Add User</button>
                <button>Export</button>
                <button>Import</button>
            </div>
        </div> -->

        <!-- Bootstrap Tabs -->
        <ul class="nav nav-tabs mt-3">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#usersTableContainer">Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#adminsTableContainer">Admins</a>
            </li>
            
        </ul>

        <div class="tab-content mt-3">
            <!-- Users Table -->
                <div id="usersTableContainer" class="tab-pane fade show active">

                    <div class="buttons d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" id="addStudentButton">Add Student</button>
                        <!-- <button>Export</button>
                        <button>Import</button> -->
                    </div>

                    <div class="table-container">
                        <table id="usersTable" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User Type</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

            <!-- Admins Table -->
                <div id="adminsTableContainer" class="tab-pane fade active">

                    <div class="buttons d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" id="addStudentButton">Add Student</button>
                        <!-- <button>Export</button>
                        <button>Import</button> -->
                    </div>

                    <div class="table-container">
                        <table id="adminsTable" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User Type</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
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
            $('#usersTable').DataTable({
                processing: true,
                serverSide: true,
                scrollY: "300px", // Enable vertical scrolling
                scrollCollapse: true,
                ajax: "{{ route('admin.users.list', ['role' => 'user']) }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'usertype', name: 'usertype' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
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
            $('#adminsTable').DataTable({
                processing: true,
                serverSide: true,
                scrollY: "300px",
                scrollCollapse: true,
                ajax: "{{ route('admin.users.list', ['role' => 'admin']) }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'usertype', name: 'usertype' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { 
                        data: 'action', 
                        name: 'action', 
                        orderable: false, 
                        searchable: false, 
                        render: function(data, type, row) {
                            return `
                                <button class="action-btn add" onclick="addUser(${row.id})">Add</button>
                                <button class="action-btn update" onclick="updateUser(${row.id})">Update</button>
                                <button class="action-btn delete" onclick="deleteUser(${row.id})">Delete</button>
                            `;
                        }
                    }
                ]
            });
        });

        // Delete User Function
        function deleteUser(id) {
            if (confirm("Are you sure you want to delete this user?")) {
                $.ajax({
                    url: `/admin/users/${id}`,
                    type: "DELETE",
                    data: { _token: "{{ csrf_token() }}" },
                    success: function(response) {
                        $('#usersTable').DataTable().ajax.reload();
                        $('#adminsTable').DataTable().ajax.reload();
                        alert("User deleted successfully.");
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }
        }
    </script>
</body>
</html>
