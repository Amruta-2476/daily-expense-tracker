<!-- home.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Expense Tracker</title>
   <style>
    * {
  margin: 0;
  padding: 0;
}
body {
  font-family: Arial, sans-serif;
  background-color: #f3f4f6;
  color: #333;
}
.navbar {
  background-color: linear-gradient(47deg, #3D3B3C -0.05%, #847E7E 72.63%, #857F7F 88.64%);ff;
  padding: 15px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
.navbar h1 {
  font-size: 30px;
  font-weight: bold;
  color: rgb(37, 196, 167);
}

.hero {
    position: relative;
    height: 330px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: #fff;
    overflow: hidden; 
  }
  .hero::before {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://theforage.wpengine.com/wp-content/uploads/2023/02/expenses-1.jpg');
    background-size: cover;
    background-position: center;
    filter: blur(2px); 
    z-index: -1; 
  }
.hero h2 {
  font-size: 45px;
  margin-bottom: 18px;
}
.hero p {
  font-size: 23px;
  margin-bottom: 13px;
}
.info {
  text-align: center;
  padding: 38px 18px;
}
.info h3 {
  font-size: 32px;
  margin-bottom: 15px;
}
.info p {
  font-size: 22px;
  margin-bottom: 21px;
}
.explore-btn {
  padding: 17px 18px;
  background-color: rgb(37, 196, 167);
  color: #fff;
  font-weight: bold;
  border: none;
  border-radius: 18px;
  font-size: 18px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}
.explore-btn:hover {
  background-color: #0056b3;
}

   </style>
</head>
<body>
  <div class="navbar">
    <h1>ExpenseWise</h1>
  </div>

  <div class="hero">
    <div>
      <h2>Track Your Expenses Effortlessly</h2>
      <p>Start managing your finances with ease</p>
    </div>
  </div>

  <div class="info">
    <h3>Why Choose ExpenseWise?</h3>
    <p>Expense Tracker helps you keep track of your spending, set budgets, and achieve financial goals.</p>
    <button class="explore-btn" onclick="window.location.href='login.php'">Explore Now</button>

  </div>
</body>
</html>
