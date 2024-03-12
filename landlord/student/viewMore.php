<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['email'])) {
    $email = $_GET['email'];
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

// Database connection
require_once('../dbConfig.php');
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
    <?php include("navbar.php"); ?>


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
                        <textarea rows="4" cols="50"
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
                <?php $proname = $row['proname']; ?><!-- AIzaSyC5Y2wjpvIxdIEZiaog97p2jj9p1o6hjv4&libraries -->

                <!-- map -->
                <div class="w-full px-3 mb-7 mt-3">
                    <div id="map" style="width: 100%; height: 500px;"></div>
                </div>

                <?php
                echo '
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5Y2wjpvIxdIEZiaog97p2jj9p1o6hjv4&libraries=geometry"></script>
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
                            Questions
                        </span>
                    </h2>
                </div>



            </div>
        </div>
        <?php
    }
    ?>


    <!-- Space below -->
    <div class="bottom-space"></div>

    <?php include("footer.php"); ?>




</body>

</html>