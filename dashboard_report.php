<?php
include("session.php");

// Get 'from' and 'to' date parameters from URL
$from = isset($_GET['from']) ? $_GET['from'] : '';
$to = isset($_GET['to']) ? $_GET['to'] : '';

$fromDate = new DateTime($from);
$toDate = new DateTime($to);

if ($fromDate->format('Y-m') == $toDate->format('Y-m')) {
    // Same month
    $title = "Monthly Report for " . $fromDate->format('F Y');
} else {
    // Different months
    $title = "Report for " . $fromDate->format('F Y') . " to " . $toDate->format('F Y');
}

// Fetch expenses data for the specified date range
$res = mysqli_query($con, "SELECT expensedate, expense, expensecategory FROM expenses WHERE user_id='$userid' AND expensedate BETWEEN '$from' AND '$to'");

// Check if there are any rows returned
if(mysqli_num_rows($res) > 0) {
    // Calculate total expense
    $totalExpense = 0;
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
        <div class="container mt-4">
            <div class="mt-4 text-center" >
            <?php
        echo "<h1 style='color: blue; font-size: 30px; margin:7px'>" . $title . "</h1>";
        ?>
            </div>
            <div class="row justify-content-center">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Expense Category</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($row = mysqli_fetch_assoc($res)) {
                            echo "<tr>";
                            echo "<td>" . $row['expensedate'] . "</td>";
                            echo "<td>$" . $row['expense'] . "</td>";
                            echo "<td>" . $row['expensecategory'] . "</td>";
                            echo "</tr>";
                            $totalExpense += $row['expense'];
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="text-right" style="font-size: 30px;"><strong>Total Expense:</strong> $<?php echo $totalExpense; ?></div>
        </div>
    </body>
    </html>

    <?php
} else {
    // No rows found
    echo "<div class='container mt-4'><h3>No expenses found for the specified date range.</h3></div>";
}
?>
