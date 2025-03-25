<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Report</title>
    <link rel="stylesheet" href="{{ asset('Style/dash.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
</head>
<body>
    <div class="top-header">Southern Baptist College Library</div>
    <button class="toggle-dark-mode" onclick="toggleDarkMode()">
        <img id="darkModeIcon" src="icons/dark_mode_2.png" alt="Toggle Mode">
    </button>
    
        @include('sidebar.sidebar')

    <div class="main-content">
        <h2>Student Report</h2>
        <div class="btn">
            <div class="buttons">
                <button id="openModalBtn">Generate Report</button>
                <button>Export</button>
                <button>Import</button>
            </div>
            <!-- <div class="buttons filter">
                <button>Filter</button>
                <input type="date">
                <p> to </p>
                <input type="date">
            </div> -->
        </div>
        <table id="usersTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>StudNumber</th>
                    <th>BarcodeNumber</th>
                    <th>SYSemCode</th>
                    <th>IDNUmber</th>
                    <th>Course</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>      
    </div>
     <!-- The Modal -->
     <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Select Type of Reports</h2>
             <!-- Date inputs -->
             <div class="date-container">
                <label for="startDate">Start Date:</label>
                <input type="date" id="startDate">
                <label for="endDate">End Date:</label>
                <input type="date" id="endDate">
            </div>

            <!-- Buttons -->
            <div class="btn-container">
                <button id="top10Highest" onclick="goToPage('top10_highest.html')">Top 10 Highest Logged In</button>
                <button id="top10Department" onclick="goToPage('top10_department.html')">Top 10 Logged In by Department</button>
                <button id="top10Department">Top 10 Logged In by Department</button>
                <button id="top10Department">Top 10 Logged In by Department</button>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
</body>
</html>


<script>
    $(document).ready(function() {
        $('#usersTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.student_report.list') }}",
            columns: [
                { data: 'Studno', name: 'Studno' },
                { data: 'BarcodeNo', name: 'BarcodeNo' },
                { data: 'SYSemCode', name: 'SYSemCode' },
                { data: 'IDno', name: 'IDno' },
                { data: 'Course', name: 'Course' },
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
        if (confirm("Are you sure you want to delete this user?")) {
            $.ajax({
                url: `/admin/student_report/${id}`,
                type: "DELETE",
                data: { _token: "{{ csrf_token() }}" },
                success: function(response) {
                    $('#usersTable').DataTable().ajax.reload();
                    alert("User deleted successfully.");
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    }
</script>




<script>
    function toggleDarkMode() {
    const body = document.body;
    const icon = document.getElementById('darkModeIcon');
    body.classList.toggle('dark-mode');
    if (body.classList.contains('dark-mode')) {
        icon.src = "icons/light_mode.png";
    } else {
        icon.src = "icons/dark_mode_2.png";
    }
    }
    function toggleSidebar() {
        const sidebar = document.getElementById("studentSidebar");
        const toggleBtn = document.getElementById("toggle-btn");
        const mainContent = document.getElementById("mainContent");
        document.getElementById("toggle-btn").classList.toggle("collapsed");
        sidebar.classList.toggle("collapsed");
        mainContent.classList.toggle("shifted");
        toggleBtn.textContent = sidebar.classList.contains("collapsed") ? ">" : "<";
    }
    // Get modal, button, and close elements
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("openModalBtn");
    var closeBtn = document.querySelector(".close");

    // Open modal when button is clicked
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // Close modal when close button is clicked
    closeBtn.onclick = function() {
        modal.style.display = "none";
    }

    // Close modal when clicking outside the modal content
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    // Function to navigate to another page
    function goToPage(page) {
        var startDate = document.getElementById("startDate").value;
        var endDate = document.getElementById("endDate").value;

        if (!startDate || !endDate) {
            alert("Please select both start and end dates.");
            return;
        }

        var url = page + `?start=${startDate}&end=${endDate}`;
            window.open(url, "_blank"); // Opens in a new tab
    }
</script>