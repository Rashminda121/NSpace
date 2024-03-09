<?php
// Include database configuration
require_once('dbConfig.php');
$conn = dbCon();

// Check if ID parameter is set in URL
if (isset($_GET['id'])) {
    $property_id = $_GET['id'];

    // Fetch property details
    $sql = "SELECT * FROM landlord WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $property_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        $property = mysqli_fetch_assoc($result);
    } else {
        echo "Property not found!";
        exit();
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Property ID not provided!";
    exit();
}

// Check if form submitted for update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    // Get updated form values
    $title = $_POST["title"];
    $bedroom = $_POST["bedroom"];
    $bathroom = $_POST["bathroom"];
    $land = $_POST["land"];
    $unit = $_POST["unit"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $zipcode = $_POST["zip"];
    $address = $_POST["address"];
    $desc = $_POST["description"];
    $price = $_POST["price"];
    $negotiable = $_POST["negotiable"];
    $status = $_POST["status"];

    // Update property in database
    $sql = "UPDATE landlord SET title=?, bedrooms=?, bathrooms=?, landsize=?, unit=?, city=?, state=?, zipcode=?, address=?, description=?, price=?, negotiable=?, status=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssssssdssi", $title, $bedroom, $bathroom, $land, $unit, $city, $state, $zipcode, $address, $desc, $price, $negotiable, $status, $property_id);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("Location: viewProperties.php");
        exit();
    } else {
        echo "Error updating property: " . mysqli_error($conn);
    }
}

// Check if delete button clicked
if (isset($_POST['delete'])) {
    // Delete property from database
    $sql = "DELETE FROM landlord WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $property_id);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("Location: viewProperties.php");
        exit();
    } else {
        echo "Error deleting property: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Property</title>
</head>

<body>
    <h2>Edit Property</h2>
    <form method="post">
        <input type="text" name="title" value="<?php echo $property['title']; ?>" placeholder="Title"><br>
        <input type="text" name="bedroom" value="<?php echo $property['bedrooms']; ?>" placeholder="Bedrooms"><br>
        <input type="text" name="bathroom" value="<?php echo $property['bathrooms']; ?>" placeholder="Bathrooms"><br>
        <input type="text" name="land" value="<?php echo $property['landsize']; ?>" placeholder="Landsize"><br>
        <input type="text" name="unit" value="<?php echo $property['unit']; ?>" placeholder="Unit"><br>
        <input type="text" name="city" value="<?php echo $property['city']; ?>" placeholder="City"><br>
        <input type="text" name="state" value="<?php echo $property['state']; ?>" placeholder="State"><br>
        <input type="text" name="zip" value="<?php echo $property['zipcode']; ?>" placeholder="Zipcode"><br>
        <input type="text" name="address" value="<?php echo $property['address']; ?>" placeholder="Address"><br>
        <textarea name="description" placeholder="Description"><?php echo $property['description']; ?></textarea><br>
        <input type="text" name="price" value="<?php echo $property['price']; ?>" placeholder="Price"><br>
        <input type="text" name="negotiable" value="<?php echo $property['negotiable']; ?>"
            placeholder="Negotiable"><br>
        <input type="text" name="status" value="<?php echo $property['status']; ?>" placeholder="Status"><br>
        <button type="submit" name="update">Update</button>
        <button type="submit" name="delete"
            onclick="return confirm('Are you sure you want to delete this property?')">Delete</button>
    </form>
</body>

</html>