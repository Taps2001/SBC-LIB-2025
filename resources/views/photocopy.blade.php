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
      <a href=""><img src="images/LogoSbc.png" alt="SBC LOGO"></a>
      <h3>Southern Baptist College Library</h3>
      <ul>
          <li><a href="login">LOG IN</a></li>
      </ul>
    </nav>
  </header>
  <div class="container">
    <div class="overlay purpose">
      <header class="subtitle-purpose">Photo Copy</header>
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
  $(document).ready(function () {
      $(".swipe-input").on("keypress", function (event) {
          if (event.which === 13) { // Enter key
              const barcodeNo = $(this).val().trim();
              const purpose = $(".subtitle-purpose").text().trim();

              if (barcodeNo !== "") {
                  $.ajax({
                      url: "{{ route('search.id') }}",
                      method: "GET",
                      data: {
                          BarcodeNo: barcodeNo,
                          purpose: purpose
                      },
                      success: function (response) {
                          if (response.success) {
                              const params = new URLSearchParams({
                                  BarcodeNo: response.data.BarcodeNo || '',
                                  lname: response.data.lname || '',
                                  fname: response.data.fname || '',
                                  mi: response.data.mi || '',
                                  vCourse: response.data.vCourse || '',
                                  purpose: response.data.purpose || ''
                              }).toString();

                              window.location.href = "{{ url('/last-login') }}?" + params;
                          } else {
                              alert("ID Not Found. Please try again.");
                          }
                      },
                      error: function (xhr) {
                          console.error(xhr.responseText);
                          alert("Server error. Please try again.");
                      }
                  });
              }
          }
      });
  });
</script>


