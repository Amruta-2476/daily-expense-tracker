<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Expense Tracker</title>
  <link rel="stylesheet" href="css/home.css">
</head>
<body>
  <section class="sec1">
    <div class="eli1"></div>
    <div class="eli2"></div>
    <div class="background-rec"></div>
    <div class="nav-rec"></div>
    <div class="exptracker-txt">Expense Tracker</div>
    <img src="uploads/coin.svg" alt="" class="coin">
    <div class="atm-icon">
      <div class="circle1"></div>
      <div class="circle2"></div>
      <img src="uploads/atm.svg" alt="" class="atm">
    </div>
    <div class="headertxt">TRACK YOUR FINANCES WHEREVER YOU GO</div>
    <div class="subhead">
      <div class="track">Track</div>
      <img class="star1" src="uploads/star.svg" alt="">
      <div class="analyse">Analyze</div>
      <img class="star2" src="uploads/star.svg" alt="">
      <div class="thrive">Thrive</div>
    </div>
    <div class="button">
      <div class="btnbox"></div>
      <div class="btntxt">Get Started</div>
    </div>

  </section>
  <script>
    const btn = document.querySelector('.button');
    btn.addEventListener('click', () => {
      window.location.href = 'login.php';
    });
  </script>
</body>
</html>
