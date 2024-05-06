<?php
require('config.php');
session_start();
$errormsg = "";
if (isset($_POST['email'])) {

  $email = stripslashes($_REQUEST['email']);
  $email = mysqli_real_escape_string($con, $email);
  $password = stripslashes($_REQUEST['password']);
  $password = mysqli_real_escape_string($con, $password);
  $query = "SELECT * FROM `users` WHERE email='$email'and password='" . md5($password) . "'";
  $result = mysqli_query($con, $query) or die(mysqli_error($con));
  $rows = mysqli_num_rows($result);
  if ($rows == 1) {
    $_SESSION['email'] = $email;
    header("Location: index.php");
  } else {
    $errormsg  = "Wrong";
  }
} else {
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>
     body {
      background-image: url('uploads/bkg-2.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
    }
    .login-form {
      width: 500px;
      margin: 120px;
      font-size: 20px;
    }

    .login-form form {
      margin-bottom: 15px;
      background: #f3f3f3;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 4px 4px 4px rgba(0, 0.4, 0.4, 0.4);
    }

    .login-form h2 {
      color: #333;
      margin: 0 0 20px;
      text-align: center;
    }

    .login-form .hint-text {
      color: black;
      margin-bottom: 30px;
      font-size: 25px;
      text-align: center;
    }

    .login-form a:hover {
      text-decoration: none;
    }

    .form-control {
      min-height: 45px;
      border-radius: 25px;
    }

    .btn {
      min-height: 45px;
      border-radius: 25px;
      font-size: 18px;
      font-weight: bold;
      background-color: #25c4a7;
      border: none;
    }

    .btn:hover {
      background-color: #1d9b7f;
    }
  </style>
</head>

<body>
  <div class="login-form">
    <form action="" method="POST">
      <h2 style="color: rgb(37, 196, 167); font-size:33px;">ExpenseWise</h2>
      <p class="hint-text">Login</p>
      <div class="form-group">
        <input type="text" name="email" class="form-control" placeholder="Email" required="required">
      </div>
      <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="Password" required="required">
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-success btn-block">Login</button>
      </div>
      <div class="clearfix">
        <label class="float-left form-check-label"><input type="checkbox"> Remember me</label>
      </div>
      <br>
      <div class="form-group">
      <p class="text-center">Don't have an account? <a href="register.php" class="text-danger">Register Here</a></p>
      </div>
    </form>
    <?php if($errormsg != "") { echo "<p class='text-center text-danger'>$errormsg</p>"; } ?>
  </div>
</body>

<!-- Bootstrap core JavaScript -->
<script src="js/jquery.slim.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- Menu Toggle Script -->
<script>
  $("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
  });
</script>
<script>
  feather.replace()
</script>

</html>
