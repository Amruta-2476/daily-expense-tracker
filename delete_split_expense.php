<?php
include("session.php");

if(isset($_GET['split_id']) && !empty($_GET['split_id'])) {
    $split_id = $_GET['split_id'];
    
    // Delete the split expense from the database
    $delete_query = "DELETE FROM expense_splits WHERE split_id = '$split_id'";
    $delete_result = mysqli_query($con, $delete_query);

    if($delete_result) {
        // Redirect back to split_expense.php after deletion
        header("Location: split_expense.php");
        exit();
    } else {
        echo "Error deleting split expense: " . mysqli_error($con);
    }
} else {
    echo "Split ID not provided.";
}
?>
