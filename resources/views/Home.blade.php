<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Library Purpose Selector</title>
  <link rel="stylesheet" href="{{ asset('Style/styles.css') }}">
</head>
<body>
  <header>
    <nav class="nav">
      <img src="{{ asset('images/sbclogo.jpg') }}" alt="SBC Logo">
      <h3>Southern Baptist College Library</h3>
      <ul>
          <li><a href="login">LOG IN</a></li>
      </ul>
    </nav>
  </header>
  <div class="container">
    <div class="overlay">
      <p class="subtitle">Select Purpose</p>
      <div class="purpose-box">
        <button onclick="window.location.href='{{ url('/borrow_book') }}'"class="purpose-btn">Borrow Book</button>
        <button onclick="window.location.href='{{ url('/study') }}'" class="purpose-btn">Study</button>
        <button onclick="window.location.href='{{ url('/research') }}'" class="purpose-btn">Library Research</button>
        <button onclick="window.location.href='{{ url('/photocopy') }}'" class="purpose-btn">Photocopy</button>
      </div>
      </div>

    </div>
  </div>
</body>
</html>
