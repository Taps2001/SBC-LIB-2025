<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('Style/dash.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
</head>
<body>
    <div class="top-header">Southern Baptist College Library</div>
    <button class="toggle-dark-mode" onclick="toggleDarkMode()">
        <img id="darkModeIcon" src="{{ asset('icons/dark_mode_2.png') }}" alt="Toggle Mode">
    </button>
    
    @include('sidebar.sidebar')

    <div class="main-content">

        <h2>Admin Dashboard</h2>
        <div class="d-flex  justify-content-end align-items-center">
            <div class="buttons">
            <div class="buttons d-flex justify-content-end">
                    <!-- <button type="button" class="btn btn-sm btn-success" id="addStudentButton">Add Student</button>   -->
                    <button type="button" class="btn btn-sm btn-danger" id="export">Export</button> 
                    <!-- <button type="button" class="btn btn-sm btn-warning" id="import">Import</button>  -->
                </div>
            </div>
            <div class="buttons filter me-2">
                <button>Filter</button>
                <input type="date">
                <p> to </p>
                <input type="date">
            </div>
        </div>
        <div class="stats">
            <div class="stat-box">20 Total Students Enrolled</div>
            <div class="stat-box">20 Total Students Enrolled</div>
            <div class="stat-box">20 Total Students Enrolled</div>
        </div>
        <div class="table-container">
            <h3>Log History</h3>
            <table id="usersTable" class="display" style="width:100%">
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


<script src="{{ asset('script.js') }}" ></script>
<script>
    $(document).ready(function() {
        $('#usersTable').DataTable({
            processing: true,
            serverSide: true,
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
                           
                            <button class="action-btn update" onclick="updateUser(${row.IDno})">Update</button>
                            <button class="action-btn delete" onclick="deleteUser(${row.IDno})">Delete</button>
                        `;
                    }
                }
            ]
        });
    });

    function addUser(id) {
        alert("Add function for ID: " + id);
        // Implement add functionality here
    }

    function updateUser(id) {
        alert("Update function for ID: " + id);
        // Implement update functionality here
    }

    function deleteUser(id) {
        if (confirm("Are you sure you want to delete this student?")) {
            $.ajax({
                url: `/admin/student_report/${id}`,
                type: "DELETE",
                data: { _token: "{{ csrf_token() }}" },
                success: function(response) {
                    $('#usersTable').DataTable().ajax.reload();
                    alert("Student deleted successfully.");
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    }
</script>

<style>
    .action-btn {
        padding: 5px 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin: 2px;
    }
    .add { background-color: #4CAF50; color: white; }  /* Green */
    .update { background-color: #2196F3; color: white; } /* Blue */
    .delete { background-color: #f44336; color: white; } /* Red */
</style>

</body>
</html>