<?php
include("session.php");

// Get 'from' and 'to' date parameters from URL
$from = isset($_GET['from']) ? $_GET['from'] : '';
$to = isset($_GET['to']) ? $_GET['to'] : '';

$fromDate = new DateTime($from);
$toDate = new DateTime($to);
$today = new DateTime();
$yesterday = new DateTime('yesterday');

if ($from == $to) {
    // Check if it's today's report
    if ($from == $today->format('Y-m-d')) {
        $title = "Report for " . $today->format('Y-m-d');
    } elseif ($from == $yesterday->format('Y-m-d')) { // Check if it's yesterday's report
        $title = "Report for " . $yesterday->format('Y-m-d');
    } else {
        $title = "Report for " . $fromDate->format('Y-m-d');
    }
} elseif ($fromDate->format('Y-m') == $toDate->format('Y-m')) {
    // Same month
    $title = "Monthly Report for " . $fromDate->format('F Y');
} else {
    // Different months or specific range
    $title = "Report for " . $fromDate->format('F Y') . " to " . $toDate->format('F Y');
}

// Fetch expenses data for the specified date range
$res = mysqli_query($con, "SELECT expensedate, expense, expensecategory FROM expenses WHERE user_id='$userid' AND expensedate BETWEEN '$from' AND '$to'");

// Check if there are any rows returned
if(mysqli_num_rows($res) > 0) {
    // Calculate total expense
    $totalExpense = 0;
    // HTML structure remains the same as provided
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Expense Manager - Monthly Report</title>
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="css/style.css" rel="stylesheet">
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
                <h1 class="mt-4"><?php echo $title ?></h1>
                <table class="table table-bordered mt-4">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Expense</th>
                            <th>Category</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($row = mysqli_fetch_array($res)) {
                            $totalExpense += $row['expense'];
                            ?>
                            <tr>
                                <td><?php echo $row['expensedate'] ?></td>
                                <td><?php echo $row['expense'] ?></td>
                                <td><?php echo $row['expensecategory'] ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <div class="alert alert-info">Total Expense: <?php echo $totalExpense ?></div>
            </div>
        </div>
    </div>

    </body>
    </html>

    <?php
} else {
    // No rows found
    echo "<div class='container mt-4'><h3>No expenses found for the specified date range.</h3></div>";
}
?>
