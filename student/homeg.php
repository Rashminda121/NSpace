<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Map</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
    
        #googleMap {
            margin-left: 360px; 
            width: calc(100% - 360px);
            height: 100vh;
        }
    </style>
</head>
<body class="bg-gray-100">
<div class="flex">
    <div id="panel" class="h-full w-96 bg-gray-200 p-4 fixed left-0 top-0 overflow-y-auto"> <!-- Adjusted width to make the panel even larger -->
        <h2 class="text-lg font-bold mb-4">Hostel Details</h2>
        <?php
      
        $servername = "localhost:3308";
        $username = "root";
        $password = "";
        $dbname = "nspacedb";

        $conn = new mysqli($servername, $username, $password, $dbname);

      
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM Hostel_Details";
        $result = $conn->query($sql);

        
        if ($result->num_rows > 0) {
      
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="border border-gray-400 p-4 mb-4">
                    <p><strong>Hostel ID:</strong> <?= $row["Hostel_ID"] ?></p>
                    <p><strong>Hostel Name:</strong> <?= $row["Hostel_Name"] ?></p>
                    <p><strong>No of Beds:</strong> <?= $row["No_Of_Beds"] ?></p>
                    <p><strong>Far:</strong> <?= $row["Far"] ?></p>
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
