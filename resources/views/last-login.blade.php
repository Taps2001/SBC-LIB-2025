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
      <a href=""><img src="images/LogoSbc.png" alt="SBC LOGO"></a>
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
        <button onclick="window.location.href='{{ url('/borrow_book') }}'" class="purpose-btn">Borrow Book</button>
        <button onclick="window.location.href='{{ url('/study') }}'" class="purpose-btn">Study</button>
        <button onclick="window.location.href='{{ url('/research') }}'" class="purpose-btn">Library Research</button>
        <button onclick="window.location.href='{{ url('/photocopy') }}'" class="purpose-btn">Photocopy</button>
      </div>
      <div class="input-box">
      <div class="swipe-input last-login">
          @if (request('lname'))
              <p class="blink-text">{{ request('lname') }}, {{ request('fname') }} {{ request('mi') }}</p>
          @else
              <p style="color: red; font-weight: bold;">Invalid ID</p>
          @endif
      </div>


      <p class="swipe-id">Thank you!</p>
    </div>
  </div>
</body>
</html>
