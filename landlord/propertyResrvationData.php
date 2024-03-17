<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
require_once ('dbConfig.php');
$conn = dbCon();

$email = $_GET['email'];
$rid = $_GET['rid'];

$accept = "accept";
$reject = "reject";

// Edit Action
if (isset ($_POST['accept'])) {

    $sql = "UPDATE reservation SET status=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sd", $accept, $rid);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Success
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: propertyReservation.php?success=true&email=$email");
            exit();
        } else {
            $error = "Error executing the query: " . mysqli_error($conn);
            header("Location: propertyReservation.php?error=$error&email=$email");
        }
    } else {
        // Handle SQL error
        header("Location: propertyReservationt.php?email=$email&error=" . mysqli_error($conn));
        exit();
    }


}
// Edit Action
if (isset ($_POST['reject'])) {

    $sql = "UPDATE reservation SET status=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sd", $reject, $rid);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Success
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: propertyReservation.php?success=true&email=$email");
            exit();
        } else {
            $error = "Error executing the query: " . mysqli_error($conn);
            header("Location: propertyReservation.php?error=$error&email=$email");
        }
    } else {
        // Handle SQL error
        header("Location: propertyReservationt.php?email=$email&error=" . mysqli_error($conn));
        exit();
    }


}

mysqli_close($conn);
?>