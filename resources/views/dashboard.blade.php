<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
   
    <link rel="stylesheet" href="{{ asset('Style/dash.css') }}">
</head>
<body>
    <div class="top-header">Southern Baptist College Library</div>
    <button class="toggle-dark-mode" onclick="toggleDarkMode()">
        <img id="darkModeIcon" src="{{ asset('icons/dark_mode_2.png') }}" alt="Toggle Mode">
    </button>
    <div class="sidebar">
        <img src="{{ asset('images/sbclogo.jpg') }}" alt="Logo" class="logo">

        <button onclick="window.location.href='dashboard.html'" class="active"><img src="{{ asset('icons/dashboard.png') }}" alt="Dashboard">Dashboard</button>
        <button onclick="window.location.href='{{ route('admin.student_info') }}'"><img  src="{{ asset('icons/students.png') }}" alt="Students">Student Info</button>
        <button onclick="window.location.href='student_report.html'"><img src="{{ asset('icons/reports.png') }}" alt="Reports">Student Report</button> 
        <button onclick="window.location.href='users.html'"><img src="{{ asset('icons/user.png') }}" alt="Users">Users Account</button>
        <button class="logout"><img src="{{ asset('icons/logout.png') }}" alt="Dashboard">Logout</button>
    </div>

    <div class="main-content">

        <h2>Admin Dashboard</h2>
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
        <div class="stats">
            <div class="stat-box">20 Total Students Enrolled</div>
            <div class="stat-box">20 Total Students Enrolled</div>
            <div class="stat-box">20 Total Students Enrolled</div>
        </div>
        <div class="table-container">
            <h3>Log History</h3>
            <div class="table">

            </div>
        </div>
    </div>
    <script src="{{ asset('script.js') }}" ></script>
    
</body>
</html>


