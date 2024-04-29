<?php
require('config.php');
if (isset($_REQUEST['firstname'])) {
  if ($_REQUEST['password'] == $_REQUEST['confirm_password']) {
    $firstname = stripslashes($_REQUEST['firstname']);
    $firstname = mysqli_real_escape_string($con, $firstname);
    $lastname = stripslashes($_REQUEST['lastname']);
    $lastname = mysqli_real_escape_string($con, $lastname);

    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($con, $email);

    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);

    $trn_date = date("Y-m-d H:i:s");

    $query = "INSERT into `users` (firstname, lastname, password, email, trn_date) VALUES ('$firstname','$lastname', '" . md5($password) . "', '$email', '$trn_date')";
    $result = mysqli_query($con, $query);
    if ($result) {
      header("Location: login.php");
    }
  } else {
    echo ("ERROR: Please Check Your Password & Confirmation password");
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Register</title>

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-image: url('uploads/bkg-3.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
    }

    .form-control {
      height: 45px;
      border-radius: 25px;
      color: #969fa4;
      border: 1px solid #ddd;
    }

    .form-control:focus {
      border-color: #5cb85c;
    }

    .signup-form {
      width: 500px;
      margin-left: 1000px;
      margin-top: 60px;
      padding: 30px;
      background: #f3f3f3;
      border-radius: 10px;
      box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.4);
    }

    .signup-form h2 {
      margin-bottom: 20px;
      font-size: 33px;
      text-align: center;
    }

    .signup-form .form-group {
      margin-bottom: 20px;
    }

    .signup-form .form-check-label input[type="checkbox"] {
      margin-top: 3px;
    }

    .signup-form .btn {
      font-size: 18px;
      font-weight: bold;
      min-width: 140px;
      border-radius: 25px;
      background-color: #25c4a7;
      border: none;
    }

    .signup-form .btn:hover {
      background-color: #1d9b7f;
    }

    .signup-form a {
      color: #5cb85c;
      text-decoration: none;
    }

    .signup-form a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <div class="signup-form">
    <form action="" method="POST" autocomplete="off">
    <h2 style="color: rgb(37, 196, 167); font-size:33px;">ExpenseWise</h2>
      <h2>Register</h2>
      <div class="form-group">
        <input type="text" class="form-control" name="firstname" placeholder="First Name" required="required">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" name="lastname" placeholder="Last Name" required="required">
      </div>
      <div class="form-group">
        <input type="email" class="form-control" name="email" placeholder="Email" required="required">
      </div>
      <div class="form-group">
        <input type="password" class="form-control" name="password" placeholder="Password" required="required">
      </div>
      <div class="form-group">
        <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required="required">
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-success btn-block">Register</button>
      </div>
      <div class="form-group">
      <p class="text-center">Already have an account? <a href="login.php" class="text-danger">Login Here</a></p>
      </div>
      </form>
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
