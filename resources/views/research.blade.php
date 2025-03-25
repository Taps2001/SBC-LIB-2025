<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Library | Study</title>
  <link rel="stylesheet" href="{{ asset('Style/styles.css') }}">
</head>
<body>
  <header>
    <nav class="nav">
      <a href=""><img src="images/sbclogo.jpg" alt="SBC LOGO"></a>
      <h3>Southern Baptist College Library</h3>
      <ul>
          <li><a href="about.html">ABOUT</a></li>
      </ul>
    </nav>
  </header>
  <div class="container">
    <div class="overlay purpose">
      <header class="subtitle-purpose">Library Research</header>
      <div class="input-box">
        <input type="text" class="swipe-input" />
      </div>
      <p class="swipe-id">Swipe ID Number</p>
    </div>
  </div>
</body>
</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
      $(".swipe-input").on("keypress", function(event) {
          if (event.which == 13) { // Enter key pressed
              let barcodeNo = $(this).val().trim();
              let purpose = $(".subtitle-purpose").text().trim(); // Get selected purpose

              if (barcodeNo !== "") {
                  $.ajax({
                      url: "{{ route('search.id') }}",
                      type: "GET",
                      data: { 
                          BarcodeNo: barcodeNo, 
                          purpose: purpose // Send purpose along with request
                      }, 
                      success: function(response) {
                          if (response.success) {
                              // Redirect with all data including purpose
                              window.location.href = "{{ url('/last-login') }}?BarcodeNo=" + response.data.BarcodeNo +
                                                      "&lname=" + encodeURIComponent(response.data.lname) +
                                                      "&fname=" + encodeURIComponent(response.data.fname) +
                                                      "&mi=" + encodeURIComponent(response.data.mi) +
                                                      "&Course=" + encodeURIComponent(response.data.Course) +
                                                      "&purpose=" + encodeURIComponent(response.data.purpose);
                          } else {
                              alert("Invalid ID! Please try again.");
                          }
                      },
                      error: function(xhr) {
                          console.log(xhr.responseText);
                          alert("Error searching for ID. Please check the input.");
                      }
                  });
              }
          }
      });
  });
</script>
