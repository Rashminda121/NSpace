<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Map</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/0.7.5/flowbite.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        #googleMap {
            margin-left: 320px;
            margin-right:0px;
            width: calc(100% - 500px);
            height: 100vh;
        }
        .hostel-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hostel-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 6px rgba(50, 50, 93, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
        }
        #popup-card {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: none;
            border-radius: 10px;
        }
    </style>
</head>
<body class="bg-gray-100">
<div class="flex">
    <div id="panel" class="h-full w-80 bg-white p-4 fixed left-0 top-0 overflow-y-auto">
        <h2 class="text-lg font-bold mb-4">Hostel Details</h2>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "avi";
        $dbname = "nspacedb";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM landlorddata";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="card border border-gray-400 p-4 mb-4 w-full transition-transform transform hover:translate-y-1 hover:shadow-md hostel-card cursor-pointer rounded-lg" 
                     data-lat="<?php echo $row["latitude"]; ?>" 
                     data-lng="<?php echo $row["longitude"]; ?>" 
                     onclick="highlightMarker(this)">
                     <img src="../landlord/images/<?php echo $row["image"]; ?>" alt="<?php echo $row["title"]; ?>" class="w-80 rounded-lg mb-2">


                     <p class="text-center">ID: <?= $row["id"] ?></p>
<p class="text-center font-medium"><?= $row["title"] ?></p>
<p class="flex items-center justify-center text-center">
    <img src="image/bed.png" class="h-5 mr-1">
    <?= $row["bedrooms"] ?>
    <img src="image/bed.png" class="h-5 ml-4 mr-1">
    <?= $row["bathrooms"] ?>
</p>

                </div>
                <?php
            }
        } else {
            echo "0 results";
        }

        $conn->close();
        ?>
    </div>
    <div id="googleMap"></div>
    <div id="popup-card"></div>
</div>

<script>
    let map;
    let markers = [];

    function myMap() {
        var mapProp = {
            center: new google.maps.LatLng(6.8222, 80.04085),
            zoom: 15,
        };
        map = new google.maps.Map(
            document.getElementById("googleMap"),
            mapProp
        );

        <?php
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM landlorddata";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                var hostelMarker = new google.maps.Marker({
                    position: new google.maps.LatLng(<?php echo $row["latitude"]; ?>, <?php echo $row["longitude"]; ?>),
                    map: map,
                    title: "<?php echo $row["title"]; ?>",
                    
                    animation: google.maps.Animation.DROP,
                    image: "<?php echo $row["image"]; ?>",
                    
                });

                markers.push(hostelMarker);

                google.maps.event.addListener(hostelMarker, 'click', function() {
                    openPopupCard(this);
                });
                <?php
            }
        }

        $conn->close();
        ?>
    }

    function highlightMarker(element) {
        var lat = parseFloat(element.getAttribute('data-lat'));
        var lng = parseFloat(element.getAttribute('data-lng'));

        for (var i = 0; i < markers.length; i++) {
            if (markers[i].getPosition().lat() === lat && markers[i].getPosition().lng() === lng) {
                markers[i].setAnimation(google.maps.Animation.BOUNCE);
                setTimeout(function() {
                    markers[i].setAnimation(null);
                }, 3000);
                break;
            }
        }
    }

    function openPopupCard(marker) {
        var content = `
        <div class="bg-white p-4 shadow-md">
            <img src="../landlord/images/${marker.image}" alt="${marker.getTitle()}" class="w-72 mx-auto rounded-lg mb-2">
            <p class="text-center"><strong>${marker.getTitle()}</strong></p>
            <p>${marker.description}</p>
            <p class="text-center"><strong>Price:</strong> ${marker.price}</p>
            <p class="text-center"><strong>Negotiable:</strong> ${marker.negotiable}</p>
        </div>
        `;
        document.getElementById('popup-card').innerHTML = content;
        document.getElementById('popup-card').style.display = 'block';
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1UfAW-b-f-swGAISQfcMjrNMARAd3Rx4&callback=myMap"></script>
</body>
</html>
