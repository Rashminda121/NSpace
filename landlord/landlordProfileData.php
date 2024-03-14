<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
require_once('dbConfig.php');
$conn = conn();

$email = $_GET['email'];
$currentId = $_GET['id'];

// Edit Action
if (isset($_POST['edit'])) {
    $newpassword = $_POST['password'];

    $sql = "UPDATE landlord SET lpassword=? WHERE id=? AND lemail=?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sds", $newpassword, $currentId, $email);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Success
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: landlordProfile.php?update=true&email=$email");
            exit();
        } else {
            $error = "Error executing the query: " . mysqli_error($conn);
            header("Location: landlordProfile.php?error=$error&email=$email");
        }
    } else {
        // Handle SQL error
        header("Location: landlordProfile.php?email=$email&error=" . mysqli_error($conn));
        exit();
    }
}

mysqli_close($conn);
?>