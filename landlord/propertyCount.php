<?php

$email = $_GET['email'];


$total = total();
$accepted = accepted();
$rejected = rejected();
$pending = pending();

if ($total != 0) {
    $accPercent = round(($accepted / $total) * 100, 1);
    $rejPercent = round(($rejected / $total) * 100, 1);
    $pendPercent = round(($pending / $total) * 100, 1);

} else {
    $accPercent = 0;
    $rejPercent = 0;
    $pendPercent = 0;
}

function total()
{
    if (isset($_GET['email'])) {
        $email = $_GET['email'];
        // Validate and sanitize $email here
    } else {
        // Handle case where email is not provided
        return null;
    }

    require_once('dbConfig.php');
    $conn = dbCon();

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare and bind SQL statement
    $sql = "SELECT count(*) AS total FROM landlorddata WHERE lemail=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);

    // Execute query
    mysqli_stmt_execute($stmt);

    // Get result
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['total']; // Return the count
    } else {
        return null; // Return null if no result
    }
}


function accepted()
{
    if (isset($_GET['email'])) {
        $email = $_GET['email'];
        // Validate and sanitize $email here
    } else {
        // Handle case where email is not provided
        return null;
    }

    require_once('dbConfig.php');
    $conn = dbCon();

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare and bind SQL statement
    $sql = "SELECT count(*) AS accepted FROM landlorddata WHERE lemail=?  AND status='accept'";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);

    // Execute query
    mysqli_stmt_execute($stmt);

    // Get result
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['accepted']; // Return the count
    } else {
        return null; // Return null if no result
    }

}

function rejected()
{
    if (isset($_GET['email'])) {
        $email = $_GET['email'];
        // Validate and sanitize $email here
    } else {
        // Handle case where email is not provided
        return null;
    }

    require_once('dbConfig.php');
    $conn = dbCon();

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare and bind SQL statement
    $sql = "SELECT count(*) AS rejected FROM landlorddata WHERE lemail=?  AND status='reject'";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);

    // Execute query
    mysqli_stmt_execute($stmt);

    // Get result
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['rejected']; // Return the count
    } else {
        return null; // Return null if no result
    }

}
function pending()
{
    if (isset($_GET['email'])) {
        $email = $_GET['email'];
        // Validate and sanitize $email here
    } else {
        // Handle case where email is not provided
        return null;
    }

    require_once('dbConfig.php');
    $conn = dbCon();

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare and bind SQL statement
    $sql = "SELECT count(*) AS pending FROM landlorddata WHERE lemail=?  AND status='false'";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);

    // Execute query
    mysqli_stmt_execute($stmt);

    // Get result
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['pending']; // Return the count
    } else {
        return null; // Return null if no result
    }

}

?>