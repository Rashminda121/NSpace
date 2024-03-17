<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
require_once ('../dbConfig.php');
$conn = dbCon();

if (isset ($_GET['lemail'])) {
    $lemail = $_GET['lemail'];
}
if (isset ($_GET['semail'])) {
    $semail = $_GET['semail'];
} else {
    $semail = "student@email.com";
}
if (isset ($_GET['pid'])) {
    $pid = $_GET['pid'];
}
if (isset ($_GET['proname'])) {
    $proname = $_GET['proname'];
}


$added = "Successfully Reservation Added.";
$status = "pending";

// Edit Action
if (isset ($_POST['submit'])) {
    $uemail = $_POST['email'];
    $question = $_POST['question'];

    $sql = "insert into reservation ( pid, proname, semail,lemail,status) values(?,?,?,?,?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "dssss", $pid, $proname, $semail, $lemail, $status);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Success
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: hostels.php?success=$added&email=$semail");

            exit();
        } else {
            $error = "Error executing the query: " . mysqli_error($conn);
            header("Location: hostels.php?error=$error&email=$semail");
        }
    } else {
        // Handle SQL error
        header("Location: hostels.php?&email=$semail&error=" . mysqli_error($conn));
        exit();
    }


}

mysqli_close($conn);




?>