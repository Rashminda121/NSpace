<?php
$servername = "localhost:3308";
$username = "root";
$password = "";
$dbname = "nspacedb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$hostelID = $_POST['hostelID'];
$hostelName = $_POST['hostelName'];
$noOfBeds = $_POST['noOfBeds'];
$far = $_POST['far'];

$sql = "INSERT INTO Hostel_Details (Hostel_ID, Hostel_Name, No_Of_Beds, Far) VALUES ('$hostelID', '$hostelName', '$noOfBeds', '$far')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
