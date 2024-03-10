<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Database connection
    require_once('../dbConfig.php');// database config file 
    $conn = dbCon();

    // Check if the connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // SQL statement
    $sql = "SELECT * FROM student WHERE semail='$email' AND spass='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Redirect to landlordHome.php with email parameter
        header("Location: ../landlordHome.php?email=$email");
    } else {
        // Show error alert
        echo '<script>alert("Invalid email or password");</script>';
    }
} else {
    header("Location: stSigning.php");
    exit();
}

?>