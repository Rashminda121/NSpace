<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
require_once('../dbConfig.php');
$conn = dbCon();

if (isset($_GET['lemail'])) {
    $email = $_GET['lemail'];
}
if (isset($_GET['pid'])) {
    $id = $_GET['pid'];
}

$added = "Successfully Question Added.";

// Edit Action
if (isset($_POST['submit'])) {
    $uemail = $_POST['email'];
    $question = $_POST['question'];

    $sql = "insert into landlordview ( pid, lemail, uemail, question) values(?,?,?,?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "dsss", $id, $email, $uemail, $question);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Success
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: viewMore.php?success=$added&email=$email&id=$id");

            exit();
        } else {
            $error = "Error executing the query: " . mysqli_error($conn);
            header("Location: viewMore.php?error=$error&email=$email&id=$id");
        }
    } else {
        // Handle SQL error
        header("Location: viewMore.php?&email=$email&id=$id&error=" . mysqli_error($conn));
        exit();
    }


}

mysqli_close($conn);




?>