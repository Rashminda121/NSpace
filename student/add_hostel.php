<?php
$servername = "localhost:3308";
$username = "root";
$password = ""; // Enter your MySQL password here
$dbname = "nspacedb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch hostel details from the form
$hostelID = $_POST['hostelID'];
$hostelName = $_POST['hostelName'];
$noOfBeds = $_POST['noOfBeds'];
$far = $_POST['far'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

// Insert data into the database
$sql = "INSERT INTO Hostel_Details (Hostel_ID, Hostel_Name, No_Of_Beds, Far, Latitude, Longitude) VALUES ('$hostelID', '$hostelName', '$noOfBeds', '$far', '$latitude', '$longitude')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
