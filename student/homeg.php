<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Map</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Style adjustments for map container */
        #googleMap {
            margin-left: 360px; /* Adjusted margin to make space for the larger panel */
            width: calc(100% - 360px); /* Adjusted width to accommodate the larger panel */
            height: 100vh;
        }
    </style>
</head>
<body class="bg-gray-100">
<div class="flex">
    <div id="panel" class="h-full w-96 bg-gray-200 p-4 fixed left-0 top-0 overflow-y-auto"> <!-- Adjusted width to make the panel even larger -->
        <h2 class="text-lg font-bold mb-4">Hostel Details</h2>
        <?php
        // Database connection
        $servername = "localhost:3308";
        $username = "root";
        $password = "";
        $dbname = "nspacedb";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch hostel details
        $sql = "SELECT * FROM Hostel_Details";
        $result = $conn->query($sql);

 

        $conn->close();
        ?>
    </div>
    <div id="googleMap"></div>
</div>

<script>
    function myMap() {
        var mapProp = {
            center: new google.maps.LatLng(6.8222, 80.04085), // NSBM Green University coordinates (latitude, longitude)
            zoom: 15,
        };
        var map = new google.maps.Map(
            document.getElementById("googleMap"),
            mapProp
        );

        // Add marker
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(6.8222, 80.04085), // NSBM Green University coordinates (latitude, longitude)
            map: map,
            title: "NSBM Green University, Sri Lanka",
            animation: google.maps.Animation.BOUNCE,
        });
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7ngQlbbaL_qjsvJQp02PFTXc_gO916s8&callback=myMap"></script>
</body>
</html>
