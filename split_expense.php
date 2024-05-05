<?php
include("session.php");

$users = []; // This will hold the list of user IDs
$num_users = ""; // Number of users
$split_amount = ""; // Total expense amount
$amount_per_user = ""; // Amount per user

if (isset($_POST['submit'])) {
    $num_users = $_POST['num_users'];
    $split_amount = $_POST['split_amount'];
    $amount_per_user = $_POST['amount_per_user'];
    $users = $_POST['users'];

    // Calculate amount per user
    if ($num_users > 0) {
        $amount_per_user = $split_amount / $num_users;

        $query = "INSERT INTO expense_splits (expense_id, user_id, split_amount, num_users, created_by, amount_per_user) VALUES ";
        foreach ($users as $user_id) {
            $query .= "('$expense_id', '$user_id', '$split_amount', '$num_users', '$userid', '$amount_per_user'),";
        }
        $query = rtrim($query, ","); 
        $result = mysqli_query($con, $query);

        if ($result) {
            header('location: split_expense.php');
            exit();
        } else {
            echo "Error: " . mysqli_error($con);
        }
    } else {
        echo "Number of users must be greater than 0.";
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

            <div class="container">
                <div class="row">
                    <!-- Left side: Create Split Expense -->
                    <div class="col-md-9">
                        <h4 class="mt-4 text-center">Create Split Expense</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <form action="" method="POST" id="expense_form">
                                    <div class="form-group">
                                        <label for="num_users">Enter Number of Users:</label>
                                        <input type="number" class="form-control" id="num_users" name="num_users" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="split_amount">Enter Total Amount($):</label>
                                        <input type="number" class="form-control" id="split_amount" name="split_amount" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="users">Select Users:</label>
                                        <select class="form-control" id="users" name="users[]" multiple required>
                                            <?php
                                            $query = "SELECT * FROM users";
                                            $result = mysqli_query($con, $query);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='" . $row['user_id'] . "'>" . $row['firstname'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="amount_per_user">Amount for Each:</label>
                                        <input type="text" class="form-control" id="amount_per_user" name="amount_per_user" value="<?php echo $amount_per_user; ?>" readonly>
                                    </div>
                                    <button type="button" class="btn btn-primary" onclick="calculateAmountPerUser()">Calculate</button>
                                    <br>
                                    <br>
                                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Right side: Split expense history -->
                    <div class="col-md-3">
                        <h4 class="mt-4 text-center">Split expense history</h4>
                        <hr>
                        <?php
                        // After the code where you insert expense splits into the database

                        // Query the database to get the splits for the current user
                        $query = "SELECT es.split_id, us.firstname, us.lastname, es.split_amount, es.amount_per_user FROM expense_splits es INNER JOIN users us ON es.user_id = us.user_id WHERE es.created_by = '$userid'";
                        $result = mysqli_query($con, $query);

                        if ($result && mysqli_num_rows($result) > 0) {
                            echo "<ul>";
                            while ($row = mysqli_fetch_assoc($result)) {
                                $oweAmount = $row['amount_per_user'];
                                ?>
                                <div class="split-entry">
                                    <p>User <?php echo $row['firstname'] . " " . $row['lastname'] ?> owes $<?php echo $oweAmount ?> to you. <a href='delete_split_expense.php?split_id=<?php echo $row['split_id'] ?>'>Delete</a></p>
                                </div>
                                <?php
                            }
                        } else {
                            echo "<p>No splits found.</p>";
                        }
                        ?>
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
        feather.replace();
    </script>
    <script>
        function calculateAmountPerUser() {
        var numUsers = parseInt(document.getElementById('num_users').value);
        var splitAmount = parseFloat(document.getElementById('split_amount').value);
        var amountPerUser = splitAmount / numUsers;
        document.getElementById('amount_per_user').value = amountPerUser.toFixed(2); 
    }
    document.getElementById('expense_form').addEventListener('submit', function(event) {
        calculateAmountPerUser(); 
    });
    </script>
</body>
</html>