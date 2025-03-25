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