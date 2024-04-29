<?php
  include("session.php");
  $budget_query = mysqli_query($con, "SELECT budget FROM users WHERE user_id = '$userid'");
  $user_budget = mysqli_fetch_assoc($budget_query)['budget'];

  function getDashboardExpense($type) {
    global $con, $userid;
    $today = date('Y-m-d');
    $sub_sql = "";
    if ($type == 'today') {
        $sub_sql = " and expensedate='$today'";
        $from = $today;
        $to = $today;
    } elseif ($type == 'yesterday') {
        $yesterday = date('Y-m-d', strtotime('yesterday'));
        $sub_sql = " and expensedate='$yesterday'";
        $from = $yesterday;
        $to = $yesterday;
    } elseif ($type == 'week' || $type == 'month' || $type == 'year') {
        $from = date('Y-m-d', strtotime("-1 $type"));
        $sub_sql = " and expensedate between '$from' and '$today'";
        $to = $today;
    }
     else {
        $sub_sql = "";
        $from = '';
        $to = '';
    }
    $res = mysqli_query($con, "select sum(expense) as expense from expenses where user_id='$userid' $sub_sql");
    $row = mysqli_fetch_assoc($res);
    $p = 0;
    $link = "";
    if ($row['expense'] > 0) {
        $p = $row['expense'];
        if($type != 'total'){
          $link = "&nbsp;<a style='font-size: 17px; color: #f5f2f0; text-decoration:underline; font-weight:bold' href='dashboard_report.php?from=".$from."&to=".$to."' target='_blank'>Details</a>";
        }
    }
    return $p . $link;	
  }

  $exp_category_dc = mysqli_query($con, "SELECT expensecategory FROM expenses WHERE user_id = '$userid' GROUP BY expensecategory");
  $exp_amt_dc = mysqli_query($con, "SELECT SUM(expense) FROM expenses WHERE user_id = '$userid' GROUP BY expensecategory");

  $exp_date_line = mysqli_query($con, "SELECT expensedate FROM expenses WHERE user_id = '$userid' GROUP BY expensedate");
  $exp_amt_line = mysqli_query($con, "SELECT SUM(expense) FROM expenses WHERE user_id = '$userid' GROUP BY expensedate");
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
  <style>
    .card a {
      color: #000;
      font-weight: 500;
    }

    .card a:hover {
      color: #28a745;
      text-decoration: dotted;
    }
  </style>
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
        <h3 class="mt-4">Dashboard</h3>
        <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row m-t-25 justify-content-center">
                            <div class="report-card">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="text">
                                                <h2><?php echo getDashboardExpense('today')?></h2>
                                                <span>Today's Expense</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="report-card">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="text">
                                                <h2><?php echo getDashboardExpense('yesterday')?></h2>
                                                <span>Yesterday's Expense</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="report-card">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="text">
                                                <h2><?php echo getDashboardExpense('week')?></h2>
                                                <span>This Week Expense</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="report-card">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="text">
                                                <h2><?php echo getDashboardExpense('month')?></h2>
                                                <span>This Month Expense</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="report-card">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="text">
                                                <h2><?php echo getDashboardExpense('year')?></h2>
                                                <span>This Year Expense</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="report-card">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="text">
                                                <h2><?php echo getDashboardExpense('total')?></h2>
                                                <span>Total Expense</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div> <!-- Closing tag for "report-card" div -->
                            </div> 
                        </div> 
                    </div>
        </div> 

        <br>
        <div style="display: flex; justify-content: center;">
           <div style="display:inline-block; border:1px solid black; padding-left:13px; padding-right:13px; padding-top:13px; border-radius:10px; box-shadow: 0px 0px 10px rgba(0,0,0,0.5);">
              <p style="font-size:18px; font-weight:bold;">If you haven't set your monthly budget yet, <a href="profile.php">click here</a>.</p>
            </div>
        </div>
        <br>
        <div class="container-fluid">
        <div class="row justify-content-center">
            <!-- Expense by Month graph -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                    <h5 class="card-title" style="display: inline;">Expense by Month | </h5>
                <!-- Display user's budget -->
                <span style="display: inline; font-size:19px; color:red; font-weight:600">Monthly Budget: <?php echo $user_budget; ?></span>
                    </div>
                    <div class="card-body">
                        <canvas id="expense_line" height="130"></canvas>
                    </div>
                </div>
        </div>

            <!-- Expense Category graph -->
        <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-center">Expense Category</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="expense_category_pie" height="130"></canvas>
                    </div>
                </div>
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

<input type="hidden" id="user-budget" value="<?php echo $user_budget; ?>">
  <script>
     // Get the user's budget from the hidden input field
     var userBudget = parseFloat(document.getElementById('user-budget').value);

    var ctx = document.getElementById('expense_category_pie').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: [<?php while ($a = mysqli_fetch_array($exp_category_dc)) {
                    echo '"' . $a['expensecategory'] . '",';
                  } ?>],
        datasets: [{
          label: 'Expense by Category',
          data: [<?php while ($b = mysqli_fetch_array($exp_amt_dc)) {
                    echo '"' . $b['SUM(expense)'] . '",';
                  } ?>],
          backgroundColor: [
            '#6f42c1',
            '#fce053',
            '#eb2d8f',
            '#38d655',
            '#fc9453', 
            '#5399fc',
            'grey',
            '#fcc5fb',
            '#851919',
          ],
          borderWidth: 1
        }]
      }
    });

    var line = document.getElementById('expense_line').getContext('2d');
    var myChart = new Chart(line, {
      type: 'line',
      data: {
        labels: [<?php while ($c = mysqli_fetch_array($exp_date_line)) {
                    echo '"' . $c['expensedate'] . '",';
                  } ?>],
        datasets: [{
          label: 'Expense by Month (Whole Year)',
          data: [<?php while ($d = mysqli_fetch_array($exp_amt_line)) {
                    echo '"' . $d['SUM(expense)'] . '",';
                  } ?>],
          borderColor: [
            '#adb5bd'
          ],
          backgroundColor: [
            '#6f42c1',
            '#dc3545',
            '#28a745',
            '#007bff',
            '#ffc107',
            '#20c997',
            '#17a2b8',
            '#fd7e14',
            '#e83e8c',
            '#6610f2'
          ],
          fill: false,
          borderWidth: 2,
          pointRadius: 6
        }]
      },
      options: {
        plugins: {
          annotation: {
            annotations: [{
              type: 'line',
              mode: 'horizontal',
              scaleID: 'y-axis-0',
              value: userBudget,
              borderColor: 'red',
              borderWidth: 2,
              label: {
                enabled: true,
                content: 'User Budget',
                position: 'right'
              }
            }]
          }
        }
      }
    });
  </script>
</body>

</html>