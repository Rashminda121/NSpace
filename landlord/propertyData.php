<?php
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

    // Image upload
    $images = $_FILES['image'];

    //num of images
    $num_of_images = count($images['name']);

    $uploaded_image_names = array(); // Array to store uploaded image names

    for ($i = 0; $i < $num_of_images; $i++) {
        $image_name = $images['name'][$i];
        $tmp_name = $images['tmp_name'][$i];
        $error = $images['error'][$i];

        if ($error === 0) {
            $img_ex = pathinfo($image_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            $allowed_exs = array('jpg', 'jpeg', 'png');

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_image_name = uniqid('IMG-', true) . '.' . $img_ex_lc;
                //upload path
                $image_upload_path = 'uploads/' . $new_image_name;
                move_uploaded_file($tmp_name, $image_upload_path);

                $uploaded_image_names[] = $new_image_name; // Store image name

            } else {
                echo "This file type can't upload, try jpg, jpeg or png !";
            }
        } else {
            echo "Unknown error occurred while uploading !";
        }
    }

    // Serialize the array of image names
    $serialized_images = serialize($uploaded_image_names);

    // Database connection
    require_once('dbConfig.php');
    $conn = dbCon();

    // Check if the connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // SQL statement
    $sql = "INSERT INTO landlord (title, bedrooms, bathrooms, landsize, unit, city, state, zipcode, address, description, price, negotiable, image, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        die("Error preparing the statement: " . mysqli_error($conn));
    }

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssssssssssdsss", $title, $bedroom, $bathroom, $land, $unit, $city, $state, $zipcode, $address, $desc, $price, $negotiable, $serialized_images, $status);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        // Success
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("Location: propertyAdd.php?success=true");
        exit();
    } else {
        echo "Error executing the query: " . mysqli_error($conn);
    }

} else {
    header("Location: propertyAdd.php");
    exit();
}
?>