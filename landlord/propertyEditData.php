<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
require_once('dbConfig.php');
$conn = dbCon();

$email = $_GET['email'];
$currentId = $_GET['currentid'];

// Edit Action
if (isset($_POST['edit'])) {
    $newTitle = $_POST['title'];
    $newBedroom = $_POST['bedrooms'];
    $newBathroom = $_POST['bathroom'];
    $newLand = $_POST['land'];
    $newUnit = $_POST['unit'];
    $newCity = $_POST['city'];
    $newState = $_POST['state'];
    $newZipcode = $_POST['zip'];
    $newAddress = $_POST['address'];
    $newDesc = $_POST['description'];
    $newPrice = $_POST['price'];
    $newNegotiable = $_POST['negotiable'];

    // Image upload
    $filename = $_FILES['image']['name'];
    $tmpName = $_FILES['image']['tmp_name'];
    $error = $_FILES['image']['error'];

    if ($filename != "") {
        if ($error === 0) {
            $img_ex = pathinfo($filename, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            $allowed_exs = array('jpg', 'jpeg', 'png');
            if (in_array($img_ex_lc, $allowed_exs)) {
                $newfilename = uniqid() . "." . $filename;
                move_uploaded_file($tmpName, 'uploads/' . $newfilename);

                $sql = "UPDATE landlorddata SET title=?, bedrooms=?, bathrooms=?, landsize=?, unit=?, city=?, state=?, zipcode=?, address=?, description=?, price=?, negotiable=?, image=?, status='false'  WHERE id=? AND lemail=?";
                $stmt = mysqli_prepare($conn, $sql);
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "sssssssssssssds", $newTitle, $newBedroom, $newBathroom, $newLand, $newUnit, $newCity, $newState, $newZipcode, $newAddress, $newDesc, $newPrice, $newNegotiable, $newfilename, $currentId, $email);
                    mysqli_stmt_execute($stmt);

                    // Check if any rows were affected
                    if (mysqli_stmt_affected_rows($stmt) > 0) {
                        header("Location: propertyEdit.php?email=$email&update=1");
                        exit();
                    } else {
                        // Handle no rows affected error
                        header("Location: propertyEdit.php?email=$email&error=No changes were made");
                        exit();
                    }
                } else {
                    // Handle SQL error
                    header("Location: propertyEdit.php?email=$email&error=" . mysqli_error($conn));
                    exit();
                }
            } else {
                // Handle invalid image format error
                header("Location: propertyEdit.php?email=$email&error=Invalid image format");
                exit();
            }
        } else {
            // Handle file upload error
            header("Location: propertyEdit.php?email=$email&error=File upload error");
            exit();
        }
    } else {
        $sql = "UPDATE landlorddata SET title=?, bedrooms=?, bathrooms=?, landsize=?, unit=?, city=?, state=?, zipcode=?, address=?, description=?, price=?, negotiable=?, status='false' WHERE id=? AND lemail=?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssssssssssssds", $newTitle, $newBedroom, $newBathroom, $newLand, $newUnit, $newCity, $newState, $newZipcode, $newAddress, $newDesc, $newPrice, $newNegotiable, $currentId, $email);

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                // Success
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                header("Location: propertyEdit.php?update=true&email=$email");
                exit();
            } else {
                $error = "Error executing the query: " . mysqli_error($conn);
                header("Location: propertyEdit.php?error=$error&email=$email");
            }
        } else {
            // Handle SQL error
            header("Location: propertyEdit.php?email=$email&error=" . mysqli_error($conn));
            exit();
        }
    }


}
// Delete Action
if (isset($_POST['delete'])) {
    $sql = "DELETE FROM landlorddata WHERE id=? AND lemail=?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ds", $currentId, $email);
        mysqli_stmt_execute($stmt);

        // Check if any rows were affected
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            header("Location: propertyEdit.php?email=$email&delete=1");
            exit();
        } else {
            // Handle no rows affected error
            header("Location: propertyEdit.php?email=$email&error=No properties found to delete");
            exit();
        }
    } else {
        // Handle SQL error
        header("Location: propertyEdit.php?email=$email&error=" . mysqli_error($conn));
        exit();
    }
}

mysqli_close($conn);
?>