<?php
include("session.php");
$exp_fetched = mysqli_query($con, "SELECT * FROM expenses WHERE user_id = '$userid'");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Expense Manager - Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Feather JS for Icons -->
    <script src="js/feather.min.js"></script>

</head>

<body>

    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="border-right" id="sidebar-wrapper">
        <div class="website-name">
            ExpenseWise
        </div>
        <hr >
            <div class="user">
                <img class="img img-fluid rounded-circle" src="<?php echo $userprofile ?>" width="120">
                <h5><?php echo $username ?></h5>
                <p><?php echo $useremail ?></p>
            </div>
            <div class="list-group list-group-flush">
                <a href="index.php" class="list-group-item list-group-item-action sidebar-active"><span data-feather="home"></span> Dashboard</a>
                <a href="add_expense.php" class="list-group-item list-group-item-action "><span data-feather="plus-square"></span> Add Expenses</a>
                <a href="manage_expense.php" class="list-group-item list-group-item-action "><span data-feather="dollar-sign"></span> Manage Expenses</a>
                <a href="split_expense.php" class="list-group-item list-group-item-action "><span data-feather="divide"></span> Split expense</a>
                <a href="profile.php" class="list-group-item list-group-item-action "><span data-feather="user"></span> Profile</a>
                <a href="logout.php" class="list-group-item list-group-item-action "><span data-feather="power"></span> Logout</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-light  border-bottom">


                <button class="toggler" type="button" id="menu-toggle" aria-expanded="false">
                    <span data-feather="menu"></span>
                </button>
            </nav>

            <div class="container-fluid">
                <h5>Hi <?php echo $firstname ?>! You can change your password here</h5>
                <div class="row mt-3">
                    <div class="col-md">
                        <form class="form" action="" method="post" id="registrationForm" autocomplete="off">
                            <div class="form-group">
                                <div class="col">
                                    <label for="password">
                                        Enter Current Password
                                    </label>
                                    <input type="password" class="form-control" name="curr_password" id="password" placeholder="New Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col">
                                    <label for="password">
                                        Enter New Password
                                    </label>
                                    <input type="password" class="form-control" name="new_password" id="password" placeholder="New Password">
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col">
                                    <label for="password2">
                                        Confirm New Password
                                    </label>
                                    <input type="password" class="form-control" name="confirm_new_password" id="confirm_password" placeholder="Confirm Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <br>
                                    <button class="btn btn-block btn-primary" name="updatepassword" type="submit">Update Password</button>
                                </div>
                            </div>
                        </form>
                        <!--/tab-content-->

                    </div>
                    <!--/col-9-->
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap core JavaScript -->
    <script src="js/jquery.slim.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
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

</body>

</html>