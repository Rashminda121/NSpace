<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form values
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
    $status = "false";
    $email = "";

    // Get email
    if (isset($_GET['email'])) {
        $email = $_GET['email'];
    }

    // Image upload
    $filename = $_FILES['image']['name'];
    $tmpName = $_FILES['image']['tmp_name'];
    $error = $_FILES['image']['error'];

    if ($error === 0) {
        $img_ex = pathinfo($filename, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        $allowed_exs = array('jpg', 'jpeg', 'png');

        if (in_array($img_ex_lc, $allowed_exs)) {
            $newfilename = uniqid() . "." . $filename;
            move_uploaded_file($tmpName, 'uploads/' . $newfilename);

            // Database connection
            require_once('dbConfig.php');
            $conn = dbCon();

            // Prepared statement to prevent SQL injection
            $sql = "INSERT INTO landlorddata (title, bedrooms, bathrooms, landsize, unit, city, state, zipcode, address, description, price, negotiable, image, status, lemail) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            if (!$stmt) {
                die("Error preparing the statement: " . mysqli_error($conn));
            }

            // Bind parameters
            mysqli_stmt_bind_param($stmt, "ssssssssssdssss", $title, $bedroom, $bathroom, $land, $unit, $city, $state, $zipcode, $address, $desc, $price, $negotiable, $newfilename, $status, $email);

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                // Success
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                header("Location: propertyAdd.php?success=true&email=$email");
                exit();
            } else {
                $error = "Error executing the query: " . mysqli_error($conn);
                header("Location: propertyAdd.php?error=$error&email=$email");
            }

        } else {
            $error = "This file type can't upload, try jpg, jpeg or png !";
            header("Location: propertyAdd.php?error=$error&email=$email");
        }
    } else {
        $error = "Unknown error occurred while uploading !";
        header("Location: propertyAdd.php?error=$error&email=$email");

    }
} else {
    header("Location: propertyAdd.php?email=$email");
    exit();
}
?>