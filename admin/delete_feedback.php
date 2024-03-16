<?php
require_once("dbconfig.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $conn = OpenCon();
    
    $id = $_GET['id'];
    // Delete feedback from the database using its ID
    $sql = "DELETE FROM feedback WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Feedback deleted successfully.";
    } else {
        echo "Error deleting feedback: " . $conn->error;
    }

    CloseCon($conn);
}

