<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
require_once ('dbConfig.php');
$conn = dbCon();

if (!$conn) {
    die ("Connection failed: " . mysqli_connect_error());
}

$email = $_GET['email'];

// Retrieve data from the database
$sql = "SELECT * FROM reservation WHERE lemail=?";
$stmt = mysqli_prepare($conn, $sql);
if (!$stmt) {
    die ("Prepare failed: " . mysqli_error($conn));
}
mysqli_stmt_bind_param($stmt, "s", $email);
if (!mysqli_stmt_execute($stmt)) {
    die ("Execute failed: " . mysqli_error($conn));
}
$result = mysqli_stmt_get_result($stmt);
if (!$result) {
    die ("Get result failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="navbar.js"></script>
    <title>Property Edit</title>
    <style>
        .table-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        table {
            border-collapse: collapse;
            width: 80%;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
    </style>
</head>

<body>
    <?php include ("navbar.php"); ?>
    <?php
    session_start();
    $req = false;
    //get email
    if (isset ($_GET['email'])) {

        $email = $_GET['email'];
    }
    //other
    if (isset ($_GET['error'])) {
        // $_SESSION['error'] = $_GET['error'];
        $error = $_GET['error'];
    }



    if (isset ($_GET['success'])) {
        $error = "Successfully Status Updated! ";
        $bgcolour = "bg-green-100 border-green-400 text-green-700";
        $text = "Success : ";
        $tcol = "text-green-500";

    } else if (isset ($_GET["error"])) {
        $bgcolour = "bg-red-100 border-red-400 text-red-700";
        $text = "Error : ";
        $tcol = "text-red-500";
    } else {
        $bgcolour = "bg-blue-100 border-blue-400 text-blue-700";
        $text = "Message : ";
        $tcol = "text-blue-500";
    }


    if (!empty ($error)): ?>
        <div id="errorContainer" class="border <?php echo $bgcolour ?> px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">
                <?php echo $text ?>
            </strong>
            <span class="block sm:inline">
                <?php echo $error; ?>
            </span>
            <span id="closeButton" class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer">
                <svg class="fill-current h-6 w-6 <?php echo $tcol ?>" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <title>Close</title>
                    <path
                        d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                </svg>
            </span>
        </div>
    <?php endif; ?>

    <script>
        document.getElementById('closeButton').addEventListener('click', function () {
            document.getElementById('errorContainer').style.display = 'none';
            window.location.href = 'propertyReservation.php?email=<?php echo $email ?>';
        });
    </script>


    <h1 class="text-2xl text-center m-5 text-blue-800 font-bold">View Reservations</h1>
    <div class="flex flex-wrap justify-center place-content-center">

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>

            <?php $pid = $row['pid']; ?>
            <?php $rid = $row['id']; ?>
            <?php

            // Retrieve data from the database for each property
            $sql2 = "SELECT * FROM landlorddata WHERE lemail=? and id=?";
            $stmt2 = mysqli_prepare($conn, $sql2);
            if (!$stmt2) {
                die ("Prepare failed: " . mysqli_error($conn));
            }

            mysqli_stmt_bind_param($stmt2, "sd", $email, $pid);

            if (!mysqli_stmt_execute($stmt2)) {
                die ("Execute failed: " . mysqli_error($conn));
            }

            $result2 = mysqli_stmt_get_result($stmt2);

            if (!$result2) {
                die ("Get result failed: " . mysqli_error($conn));
            }

            ?>

            <?php while ($row2 = mysqli_fetch_assoc($result2)) { ?>

                <div class="max-w-sm bg-white border border-blue-200 rounded-lg shadow  dark:border-blue-700 m-2 shadow-lg">
                    <!-- /// -->
                    <div class="flex flex-wrap -mx-2 mb-6 text-center pt-5">
                        <div class="w-full px-3">
                            <h5 class="font-sans text-lg text-grey-900 font-bold">
                                <!-- <?php echo $row['id']; ?> -->

                            </h5>
                        </div>
                    </div>


                    <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-8 lg:px-12">
                        <div
                            class="flex flex-col mb-5 space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4 pr-5 pl-5">
                            <img src="uploads/<?php echo $row2['image']; ?>"
                                class=" mx-auto  w-auto h-40 shadow-md  transition duration-200 transform hover:scale-110"
                                style="height:100%;max-height: 200px;overflow: hidden;" alt="Nspace Logo" />
                        </div>
                    </div>
                    <div class="py-4 px-4 mx-auto max-w-screen-xl text-center lg:py-4 lg:px-14">
                        <hr>
                    </div>
                    <div class="flex flex-wrap -mx-4 mb-6 pl-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-xs font-bold mb-2 pl-4 text-blue-700"
                                for="bedroom">Property Name</label>
                            <p id="bedroom" name="bedroom"
                                class="appearance-none block w-full  text-gray-700  rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 capitalize">
                                <span class="">
                                    <?php echo $row2['proname']; ?>
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-4 mb-6 pl-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-blue-700 text-xs font-bold mb-2 pl-4"
                                for="bedroom">User Email</label>
                            <p id="bedroom" name="bedroom"
                                class="appearance-none block w-full  text-gray-700  rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                <span class="">
                                    <?php echo $row['semail']; ?>
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-4 mb-6 pl-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-blue-700 text-xs font-bold mb-2 pl-4"
                                for="status">Status</label>
                            <p id="bedroom" name="status"
                                class="appearance-none block w-full  text-gray-700  rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 ">
                                <span class="">
                                    <?php echo $row['status']; ?>
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="pl-5 pr-5 pb-5">
                        <form action="propertyResrvationData.php?email=<?php echo $email ?>&rid=<?php echo $rid ?>"
                            method="post">
                            <div class="flex flex-wrap -mx-4 mb-4 text-center">
                                <div class="w-1/2 px-3">
                                    <a href="#">
                                        <button type="submit" name="accept"
                                            class="bg-blue-700 hover:bg-blue-900 text-white font-bold py-2 w-full rounded">
                                            Accept
                                        </button>
                                    </a>
                                </div>
                                <div class="w-1/2 px-3">
                                    <a href="#">
                                        <button type="submit" name="reject"
                                            class="bg-red-700 hover:bg-red-900 text-white font-bold py-2 w-full rounded">
                                            Reject
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php } ?>


        <?php } ?>
        <?php
        if (mysqli_num_rows($result) == 0) {
            ?>
            <h1 class="text-2xl text-center m-10 text-gray-800 font-bold">No Reservations</h1>
            <?php
        }
        ?>



    </div>
    <div class="mb-20"></div>
    <?php include ("footer.php"); ?>

</body>

</html>

<?php
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>