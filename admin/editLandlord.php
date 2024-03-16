<?php
require_once('dbConfig.php');

// Check if a landlord ID is provided via GET parameter
if (!isset($_GET['id'])) {
    // Handle the case where no ID is provided (e.g., redirect to an error page)
    header("Location: error.php");
    exit();
}

// Retrieve the landlord ID from the GET parameter
$landlord_id = $_GET['id'];

// Fetch existing landlord information from the database based on the ID
$conn = OpenCon();
$sql = "SELECT * FROM landlord WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $landlord_id);
$stmt->execute();
$result = $stmt->get_result();
$landlord = $result->fetch_assoc();

// Close the prepared statement and the database connection
$stmt->close();
CloseCon($conn);

// Check if the landlord exists
if (!$landlord) {
    // Handle the case where the landlord does not exist (e.g., redirect to an error page)
    header("Location: error.php");
    exit();
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input and retrieve form data
    // Update the landlord information in the database
    // Display success or error message
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Landlord</title>
</head>
<body>

<!-- HTML Form for Editing Landlord Information -->
<form action="editLandlord.php?id=<?php echo $landlord_id; ?>" method="post">
    <!-- Populate form fields with existing landlord information -->
    <input type="text" name="lname" value="<?php echo $landlord['lname']; ?>">
    <input type="text" name="lmobile" value="<?php echo $landlord['lmobile']; ?>">
    <input type="text" name="laddress" value="<?php echo $landlord['laddress']; ?>">
    <input type="text" name="lemail" value="<?php echo $landlord['lemail']; ?>">
    <input type="password" name="lpassword" value="<?php echo $landlord['lpassword']; ?>">
    <button type="submit">Update Landlord</button>
</form>

</body>
</html>
