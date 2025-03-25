<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Enrolled</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('Style/dash.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

    <!-- jQuery & DataTables Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

</head>
<body>

    <!-- Sidebar -->
    <div class="student-sidebar" id="studentSidebar">
        <div class="menu">
            <button onclick="window.location.href='{{ route('admin.student_info') }}'">
                <img src="{{ asset('icons/student-info.png') }}" alt="Student Information"> Student Information
            </button>
            <button onclick="window.location.href='{{ route('admin.student_enrolled') }}'" class="active">
                <img src="{{ asset('icons/enrolled.png') }}" alt="Student Enrolled"> Student Enrolled
            </button>
        </div>
    </div>

    <!-- Toggle Sidebar Button -->
    <button class="toggle-btn" id="toggle-btn" onclick="toggleSidebar()"><</button>

    <!-- Header -->
    <div class="top-header">Southern Baptist College Library</div>

    <!-- Dark Mode Toggle -->
    <button class="toggle-dark-mode" onclick="toggleDarkMode()">
        <img id="darkModeIcon" src="{{ asset('/icons/dark_mode_2.png') }}" alt="Toggle Mode">
    </button>

    <!-- Main Sidebar -->
    <div class="sidebar">
        <img src="{{ asset('images/sbclogo.jpg') }}" alt="Logo" class="logo">
        <button onclick="window.location.href='{{ route('admin.dashboard') }}'" class="active">
            <img src="{{ asset('icons/dashboard.png') }}" alt="Dashboard">Dashboard
        </button>
        <button onclick="window.location.href='{{ route('admin.student_info') }}'">
            <img src="{{ asset('icons/students.png') }}" alt="Students">Student Info
        </button>
        <button onclick="window.location.href='{{ route('admin.student_report') }}'">
            <img src="{{ asset('icons/reports.png') }}" alt="Reports">Student Report
        </button> 
        <button onclick="window.location.href='{{ route('admin.users') }}'">
            <img src="{{ asset('icons/user.png') }}" alt="Users">Users Account
        </button>
        
        <!-- Logout Form -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <button class="logout" onclick="document.getElementById('logout-form').submit();">
            <img src="{{ asset('icons/logout.png') }}" alt="Logout">Logout
        </button>
    </div>

    <!-- Student Information Section -->
    <div class="student-info" id="mainContent">
        <h2>Student Enrolled</h2>
        <div class="btn">
            <div class="buttons">
                <button>Generate Report</button>
                <button>Export</button>
                <button>Import</button>
            </div>
            <div class="buttons filter">
                <button>Filter</button>
                <input type="date">
                <p> to </p>
                <input type="date">
            </div>
        </div>


        <!-- Student Enrolled DataTable -->
        <table id="usersTable" class="display" style="width:100%">
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

    <!-- DataTable Script -->
    <script>
       $(document).ready(function() {
            $('#usersTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.student_report.list') }}",
                columns: [
                    // { data: 'BarcodeNo', name: 'BarcodeNo' },
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
                                <button class="action-btn add" onclick="addUser(${row.IDno})">Add</button>
                                <button class="action-btn update" onclick="updateUser(${row.IDno})">Update</button>
                                <button class="action-btn delete" onclick="deleteUser(${row.IDno})">Delete</button>
                            `;
                        }
                    }
                ]
            });
        });


        function createUser() {
            alert("Open create user modal or form");
        }

        function editUser(id) {
            alert("Edit User ID: " + id);
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

    <!-- Sidebar & Dark Mode Scripts -->
    <script>
        function toggleDarkMode() {
            const body = document.body;
            const icon = document.getElementById('darkModeIcon');
            body.classList.toggle('dark-mode');
            icon.src = body.classList.contains('dark-mode') 
                ? "{{ asset('icons/light_mode.png') }}" 
                : "{{ asset('icons/dark_mode_2.png') }}";
        }

        function toggleSidebar() {
            const sidebar = document.getElementById("studentSidebar");
            const toggleBtn = document.getElementById("toggle-btn");
            const mainContent = document.getElementById("mainContent");
            sidebar.classList.toggle("collapsed");
            mainContent.classList.toggle("shifted");
            toggleBtn.textContent = sidebar.classList.contains("collapsed") ? ">" : "<";
        }
    </script>

</body>
</html>
