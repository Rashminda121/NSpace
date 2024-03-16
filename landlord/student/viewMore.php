<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset ($_GET['email'])) {
    $email = $_GET['email'];
}
if (isset ($_GET['id'])) {
    $id = $_GET['id'];
}

// Database connection
require_once ('../dbConfig.php');
$conn = dbCon();

// Retrieve data from the database
$sql = "SELECT * FROM landlorddata WHERE lemail=? and id=?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sd", $email, $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management System</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/0.7.5/flowbite.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .bottom-space {
            height: 100px;
        }
    </style>
</head>

<body>
    <?php include ("navbar.php"); ?>

    <?php
    session_start();
    //get email
    
    //other
    if (isset ($_GET['error'])) {
        // $_SESSION['error'] = $_GET['error'];
        $error = $_GET['error'];
    }
    if (isset ($_GET['update'])) {
        // $_SESSION['error'] = $_GET['error'];
        $error = $_GET['update'];
        $bgcolour = "bg-green-100 border-green-400 text-green-700";
        $text = "Success : ";
        $tcol = "text-green-500";
    }
    if (isset ($_GET['delete'])) {
        // $_SESSION['error'] = $_GET['error'];
        $error = "Successfully Deleted!";
        $bgcolour = "bg-orange-100 border-orange-400 text-orange-700";
        $text = "Success : ";
        $tcol = "text-orange-500";
    }

    if (isset ($_GET['success'])) {
        $error = $_GET['success'];
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
            window.location.href = 'viewMore.php?&email=<?php echo $email ?>&id=<?php echo $id ?>';
        });
    </script>






    <!-- content -->

    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="flex flex-wrap justify-center place-content-center">
            <h1 class="text-center mt-10 text-3xl font-bold text-blue-800 mb-10">
                Welcome to,
                <span class="text-green-700 uppercase">
                    <?php echo $row['proname']; ?>
                </span>
            </h1>
            <!-- //space -->
            <div class="w-full px-3 mb-10 mt-3">
                <hr>
                <hr>
            </div>
            <div class="flex flex-wrap justify-center mb-10">

                <div class="w-full sm:w-2/5 px-2 mb-4 shadow-2xl">
                    <img src="../uploads/<?php echo $row['image']; ?>" alt="Property Image" name="image"
                        class="mx-auto w-full h-auto">
                </div>
            </div>
            <div class="flex flex-wrap  mb-6 text-center">
                <div class="w-full px-3 mb-7">
                    <h2 class="block tracking-wide text-blue-700 text-2xl font-bold mb-2" for="name">

                        <span class="text-green-700 uppercase">
                            Details
                        </span>
                    </h2>
                </div>
                <div class="w-full px-3 mb-7">
                    <hr>
                </div>


                <div class="w-full md:w-1/4 px-3 mb-4 md:mb-0">
                    <div class="w-full px-3">
                        <h2 class="block uppercase tracking-wide text-blue-700 text-xs font-bold mb-2" for="name">
                            Bedrooms
                        </h2>
                    </div>
                    <div class="w-full px-3 block">
                        <p
                            class="appearance-none block w-full text-lg text-gray-700 bg-gray-100 py-3 px-4 focus:bg-white mb-5">
                            <?php echo $row['bedrooms']; ?>
                        </p>
                    </div>
                </div>
                <div class="w-full md:w-1/4 px-3 mb-4 md:mb-0">
                    <div class="w-full px-3">
                        <h2 class="block uppercase tracking-wide text-blue-700 text-xs font-bold mb-2" for="name">
                            Bathrooms
                        </h2>
                    </div>
                    <div class="w-full px-3 block">
                        <p
                            class="appearance-none block w-full text-lg text-gray-700 py-3 px-4 bg-gray-100 focus:bg-white mb-5">
                            <?php echo $row['bathrooms']; ?>
                        </p>
                    </div>
                </div>
                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                    <div class="w-full px-3">
                        <h2 class="block uppercase tracking-wide text-blue-700 text-xs font-bold mb-2" for="name">
                            Land Size
                        </h2>
                    </div>
                    <div class="w-full px-3 block">
                        <p
                            class="appearance-none block w-full text-lg text-gray-700 py-3 px-4 bg-gray-100 focus:bg-white mb-5">
                            <?php echo $row['landsize']; ?>
                        </p>
                    </div>
                </div>
                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                    <div class="w-full px-3">
                        <h2 class="block uppercase tracking-wide text-blue-700 text-xs font-bold mb-2" for="name">
                            Unit
                        </h2>
                    </div>
                    <div class="w-full px-3 block">
                        <p
                            class="appearance-none block w-full text-lg text-gray-700 py-3 px-4 bg-gray-100 focus:bg-white mb-5 capitalize">
                            <?php echo $row['unit']; ?>
                        </p>
                    </div>
                </div>

                <!-- City Fields -->
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <div class="w-full px-3">
                        <h2 class="block uppercase tracking-wide text-blue-700 text-xs font-bold mb-2" for="name">
                            City
                        </h2>
                    </div>
                    <div class="w-full px-3 block">
                        <p
                            class="appearance-none block w-full text-lg text-gray-700 py-3 px-4 bg-gray-100 focus:bg-white mb-5 capitalize">
                            <?php echo $row['city']; ?>
                        </p>
                    </div>
                </div>
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <div class="w-full px-3">
                        <h2 class="block uppercase tracking-wide text-blue-700 text-xs font-bold mb-2 capitalize"
                            for="name">
                            State/ Province
                        </h2>
                    </div>
                    <div class="w-full px-3 block">
                        <p
                            class="appearance-none block w-full text-lg text-gray-700 py-3 px-4 bg-gray-100 focus:bg-white mb-5">
                            <?php echo $row['state']; ?>
                        </p>
                    </div>
                </div>
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <div class="w-full px-3">
                        <h2 class="block uppercase tracking-wide text-blue-700 text-xs font-bold mb-2" for="name">
                            Zip Code
                        </h2>
                    </div>
                    <div class="w-full px-3 block">
                        <p
                            class="appearance-none block w-full text-lg text-gray-700 py-3 px-4 bg-gray-100 focus:bg-white mb-5">
                            <?php echo $row['zipcode']; ?>
                        </p>
                    </div>
                </div>
                <div class="w-full px-3 mb-6 md:mb-0">
                    <div class="w-full px-3">
                        <h2 class="block uppercase tracking-wide text-blue-700 text-xs font-bold mb-2" for="name">
                            Address
                        </h2>
                    </div>
                    <div class="w-full px-3 block">
                        <p
                            class="appearance-none block w-full text-lg text-gray-700 py-3 px-4 bg-gray-100 focus:bg-white mb-5 capitalize">
                            <?php echo $row['address']; ?>
                        </p>
                    </div>
                </div>
                <!-- //space -->
                <div class="w-full px-3 mb-7 mt-3">
                    <hr>
                </div>

                <div class="w-full px-3 mb-6 md:mb-0">
                    <div class="w-full px-3">
                        <h2 class="block uppercase tracking-wide text-blue-700 text-xs font-bold mb-2" for="name">
                            Description
                        </h2>
                    </div>
                    <div class="w-full px-3 block">
                        <textarea rows="4" cols="50" disabled
                            class="appearance-none block w-full text-lg text-gray-700 py-3 px-4 bg-gray-100 focus:bg-white mb-5 text-center capitalize"><?php echo $row['description']; ?></textarea>
                    </div>
                </div>
                <div class="w-full px-3 mb-7 mt-3">
                    <hr>
                </div>
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <div class="w-full px-3">
                        <h2 class="block uppercase tracking-wide text-blue-700 text-xs font-bold mb-2" for="name">
                            Price (Rs)
                        </h2>
                    </div>
                    <div class="w-full px-3 block">
                        <p
                            class="appearance-none block w-full text-lg text-gray-700 py-3 px-4 bg-gray-100 focus:bg-white mb-5 font-bold">
                            <?php echo $row['price']; ?>
                        </p>
                    </div>
                </div>
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <div class="w-full px-3">
                        <h2 class="block uppercase tracking-wide text-blue-700 text-xs font-bold mb-2" for="name">
                            Negotiable
                        </h2>
                    </div>
                    <div class="w-full px-3 block">
                        <p
                            class="appearance-none block w-full text-lg text-gray-700 py-3 px-4 bg-gray-100 focus:bg-white mb-5 font-bold capitalize">
                            <?php echo $row['negotiable']; ?>
                        </p>
                    </div>
                </div>
                <!-- //space -->
                <div class="w-full px-3 mb-7 mt-3">
                    <hr>
                </div>

                <?php $lat = $row['latitude'];
                $lon = $row['longitude']; ?>
                <?php $proname = $row['proname']; ?>

                <!-- map -->
                <div class="w-full px-3 mb-7 mt-3">
                    <div id="map" style="width: 100%; height: 500px;"></div>
                </div>

                <?php
                echo '
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1UfAW-b-f-swGAISQfcMjrNMARAd3Rx4&libraries=geometry"></script>
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    var map = new google.maps.Map(document.getElementById(\'map\'), {
                        center: new google.maps.LatLng(6.82163802690581, 80.04154070852864),
                        zoom: 8,
                    });

                    // NSBM marker
                    var NSBMmarker = new google.maps.Marker({
                        position: { lat: 6.820996372680341, lng: 80.03984441709781 },
                        title: "NSBM Green University",
                        map: map,
                        //animation: google.maps.Animation.BOUNCE,
                        draggable: true,
                        icon: "../map/nsbmMarker.png"
                    });

                    let popupContent = new google.maps.InfoWindow();

                    google.maps.event.addListener(NSBMmarker, "click", (function (NSBMmarker) {
                        return function () {
                            popupContent.setContent("NSBM Green University")
                            popupContent.open(map, NSBMmarker)
                        }
                    })(NSBMmarker));

                    // NSBM zoom in marker
                    google.maps.event.addListener(NSBMmarker, \'click\', function () {
                        var pos = map.getZoom();
                        map.setZoom(17);
                        map.setCenter(NSBMmarker.getPosition());
                        window.setTimeout(function () { map.setZoom(pos); }, 20000);
                    });


                    // NSBM circle
                   map.data.loadGeoJson(\'../map/data/data.json\')
                    map.data.setStyle({
                        fillColor: \'#35d016\',
                        strokeColor: \'#0b751c\',
                        fillOpacity: 0.1
                    });

                    
                    // user marker
                    
                    var lat = ' . $lat . ';
                    var lon = ' . $lon . ';
                    var proname = "' . $proname . '";

                    var usermarker = new google.maps.Marker({
                        position: { lat: lat, lng: lon },
                        title: "User Marker",
                        map: map,
                        //animation: google.maps.Animation.BOUNCE,
                        //draggable: true,
                        icon: "../map/pin.png"
                    });

                    let popupContent2 = new google.maps.InfoWindow();

                    google.maps.event.addListener(usermarker, "click", (function (usermarker) {
                        return function () {
                            popupContent2.setContent(proname)
                            popupContent2.open(map, usermarker)
                        }
                    })(usermarker));

                    //  zoom in marker
                    google.maps.event.addListener(usermarker, \'click\', function () {
                        var pos = map.getZoom();
                        map.setZoom(17);
                        map.setCenter(usermarker.getPosition());
                        window.setTimeout(function () { map.setZoom(pos); }, 20000);
                    });


                });
            </script>';
                ?>
                <!-- //space -->
                <div class="w-full px-3 mb-7 mt-3">
                    <hr>
                </div>
                <div class="w-full px-3 mb-7 text-left ml-5">
                    <h2 class="block tracking-wide text-blue-700 text-2xl font-bold mb-2" for="name">

                        <span class="text-green-700 uppercase">
                            Ask Questions
                        </span>
                    </h2>
                </div>
                <form action="viewmoreData.php?lemail=<?php echo $email ?>&pid=<?php echo $id ?>" method="post">
                    <div class="flex flex-wrap -mx-3 mb-6 ml-5">

                        <div class="w-full px-3 mb-4 pr-2">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 text-left"
                                for="email">
                                Email
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="name" name="email" type="email" placeholder="Email" required>
                        </div>
                        <div class="w-full px-3 mb-5 pr-2">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 text-left"
                                for="question">
                                Question
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="name" name="question" type="text" placeholder="Question" required>
                        </div>
                        <div class="w-full px-3 justify-left text-left" style="width:30px;">
                            <button type="submit" name="submit"
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-5 rounded">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>

                <!-- //space -->
                <div class="w-full px-3 mb-7 mt-3 ">
                    <hr>
                    <hr>
                </div>

                <div class="w-full px-3 mb-3 text-center ml-5 bg-green-50 p-3 mr-4">
                    <h2 class="block tracking-wide text-blue-700 text-xl font-bold " for="name">

                        <span class="text-green-700 uppercase">
                            Questions
                        </span>
                    </h2>
                </div>

                <!-- //space -->
                <div class="w-full px-3 mb-7 mt-3">
                    <hr>
                    <hr>
                </div>


                <?php
                error_reporting(E_ALL);
                ini_set('display_errors', 1);

                // Database connection
                require_once ('../dbConfig.php');
                $conn = dbCon();

                // Retrieve data from the database
                $sql = "SELECT * FROM landlordview WHERE lemail=? and pid=?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "sd", $email, $id);
                mysqli_stmt_execute($stmt);
                $result2 = mysqli_stmt_get_result($stmt);
                ?>


                <?php
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    ?>
                    <?php $viewid = $row2['id']; ?>


                    <div class="w-full px-3 mb-5 shadow-xl mr-4 ml-4 mb-3" style="width:100%;">

                        <form
                            action="viewMoreEdit.php?&lemail=<?php echo $email ?>&pid=<?php echo $id ?>&viewid=<?php echo $viewid ?>"
                            method="post">

                            <div class="flex flex-wrap -mx-3 mb-6 ml-5 mt-2">
                                <div class="w-full px-3 mb-4" style="width:100%;max-width:30rem;">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 text-left"
                                        for="email">
                                        email
                                    </label>
                                    <input
                                        class="appearance-none block w-full bg-gray-50 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        id="email" name="email" type="email" placeholder="Email"
                                        value="<?php echo $row2['uemail']; ?>" required>
                                </div>
                                <div class="w-full px-3 mb-5">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 text-left"
                                        for="question">
                                        Question
                                    </label>
                                    <input
                                        class="appearance-none block w-full bg-gray-50 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        id="question" name="question" type="text" placeholder="Question"
                                        style="width:100%;max-width:70rem;" value="<?php echo $row2['question']; ?>" required>
                                </div>
                                <div class="w-full justify-left text-left" style="width:100%;max-width:50px;">
                                    <div class="w-full px-3 justify-left text-left">
                                        <button type="submit" name="edit"
                                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-5 rounded">
                                            Edit
                                        </button>
                                    </div>

                                </div>
                                <div class="w-full justify-left text-left ml-7" style="width:100%;max-width:50px;">
                                    <div class="w-full px-3 justify-left text-left">
                                        <button type="submit" name="delete"
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-5 rounded">
                                            Delete
                                        </button>
                                    </div>

                                </div>

                            </div>
                        </form>
                    </div>
                    <?php
                }
                ?>
            </div>



            <!-- Space below -->
            <div class="bottom-space"></div>
            <!-- footer -->
            <footer class="bg-gray-200 w-full">
                <div class="mx-auto max-w-5xl px-4 py-10 sm:px-6 lg:px-8">
                    <div class="flex justify-center text-teal-600">
                        <img src="https://images.g2crowd.com/uploads/product/image/large_detail/large_detail_d5f4bf67004e05149f3eac303f46819e/nspace.png"
                            class="h-20" alt="Nspace Logo" />
                    </div>

                    <p class="mx-auto mt-6 max-w-md text-center leading-relaxed text-gray-900 text-xl">
                        Welcome to NSpace, a platform for Hostel Management.
                    </p>

                    <ul class="mt-12 flex flex-wrap justify-center gap-6 md:gap-8 lg:gap-12">
                        <li>
                            <a class="text-gray-700 transition hover:text-gray-700/75" href="#"> About </a>
                        </li>

                        <li>
                            <a class="text-gray-700 transition hover:text-gray-700/75" href="#"> Articles </a>
                        </li>

                        <li>
                            <a class="text-gray-700 transition hover:text-gray-700/75" href="#"> Feedbacks</a>
                        </li>

                        <li>
                            <a class="text-gray-700 transition hover:text-gray-700/75" href="#"> Properties </a>
                        </li>

                        <li>
                            <a class="text-gray-700 transition hover:text-gray-700/75" href="#"> Contact </a>
                        </li>

                    </ul>

                    <ul class="mt-12 flex justify-center gap-6 md:gap-8">
                        <li>
                            <a href="#" rel="noreferrer" target="_blank"
                                class="text-gray-700 transition hover:text-gray-700/75">
                                <span class="sr-only">Facebook</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>

                        <li>
                            <a href="#" rel="noreferrer" target="_blank"
                                class="text-gray-700 transition hover:text-gray-700/75">
                                <span class="sr-only">Instagram</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>

                        <li>
                            <a href="#" rel="noreferrer" target="_blank"
                                class="text-gray-700 transition hover:text-gray-700/75">
                                <span class="sr-only">Twitter</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path
                                        d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                                </svg>
                            </a>
                        </li>


                    </ul>
                </div>
            </footer>

            <?php
    }
    ?>



</body>

</html>