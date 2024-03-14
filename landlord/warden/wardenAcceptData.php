<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
require_once('dbConfig.php');
$conn = dbCon();

$email = $_GET['email'];
$currentId = $_GET['currentid'];

$accept = "accept";
$reject = "reject";

// Edit Action
if (isset($_POST['edit'])) {

    $sql = "UPDATE landlorddata SET status=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sd", $accept, $currentId);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Success
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: wardenAccept.php?update=true&email=$email");
            exit();
        } else {
            $error = "Error executing the query: " . mysqli_error($conn);
            header("Location: wardenAccept.php?error=$error&email=$email");
        }
    } else {
        // Handle SQL error
        header("Location: wardenAccept.php?email=$email&error=" . mysqli_error($conn));
        exit();
    }


}

if (isset($_POST['delete'])) {
    $sql = "UPDATE landlorddata SET status=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sd", $reject, $currentId);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Success
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: wardenAccept.php?update=true&email=$email");
            exit();
        } else {
            $error = "Error executing the query: " . mysqli_error($conn);
            header("Location: wardenAccept.php?error=$error&email=$email");
        }
    } else {
        // Handle SQL error
        header("Location: wardenAccept.php?email=$email&error=" . mysqli_error($conn));
        exit();
    }
}


mysqli_close($conn);
?>