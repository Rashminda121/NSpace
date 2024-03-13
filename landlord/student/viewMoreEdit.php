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
if (isset($_GET['viewid'])) {
    $viewid = $_GET['viewid'];
}

$update = "Updated Successfully!";

// Edit Action
if (isset($_POST['edit'])) {
    $uemail = $_POST['email'];
    $question = $_POST['question'];

    $sql = "UPDATE landlordview SET uemail=?, question=? WHERE id=? AND pid=? AND lemail=?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssdds", $uemail, $question, $viewid, $id, $email);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Success
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: viewMore.php?update=$update&email=$email&id=$id");

            exit();
        } else {
            $error = "Error executing the query: " . mysqli_error($conn);
            header("Location: viewMore.php?error=$error&email=$email&id=$id");
        }
    } else {
        // Handle SQL error
        $error = "Error preparing statement: " . mysqli_error($conn);
        header("Location: viewMore.php?error=$error&email=$email&id=$id");
        exit();
    }
}

// Delete Action
if (isset($_POST['delete'])) {
    $sql = "DELETE FROM landlordview WHERE id=? AND pid=? AND lemail=?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "dds", $viewid, $id, $email);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Success
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: viewMore.php?delete=true&email=$email&id=$id");
            exit();
        } else {
            $error = "Error executing the query: " . mysqli_error($conn);
            header("Location: viewMore.php?error=$error&email=$email&id=$id");
        }
    } else {
        // Handle SQL error
        $error = "Error preparing statement: " . mysqli_error($conn);
        header("Location: viewMore.php?error=$error&email=$email&id=$id");
        exit();
    }
}

mysqli_close($conn);
?>