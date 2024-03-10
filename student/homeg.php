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
    
        #hostelDetailsCard {
            position: fixed;
            bottom: 5%;
            right: 5%;
            background-color: white;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            display: none;
        }
    </style>
</head>
<body class="bg-gray-100">
<div class="flex">
    <div id="panel" class="h-full w-96 bg-gray-200 p-4 fixed left-0 top-0 overflow-y-auto"> 
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
                <div class="card border border-gray-400 p-4 mb-4 w-full transition-transform transform hover:translate-y-1 hover:shadow-md"> <!-- Adjusted width to match the panel -->
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

<div id="hostelDetailsCard" class="bg-white p-4 rounded shadow-lg fixed bottom-5 right-5 hidden">
    <h3 id="hostelName" class="font-bold text-lg mb-2"></h3>
    <p id="noOfBeds"></p>
    <p id="far"></p>
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

   
        <?php
    
        $conn = new mysqli($servername, $username, $password, $dbname);

     
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

   
        $sql = "SELECT * FROM Hostel_Details";
        $result = $conn->query($sql);


        if ($result->num_rows > 0) {
   
            while ($row = $result->fetch_assoc()) {
                ?>
      
                var hostelMarker = new google.maps.Marker({
                    position: new google.maps.LatLng(<?php echo $row["Latitude"]; ?>, <?php echo $row["Longitude"]; ?>),
                    map: map,
                    title: "<?php echo $row["Hostel_Name"]; ?>",
                    animation: google.maps.Animation.DROP,
                });

        
                google.maps.event.addListener(hostelMarker, 'click', function() {
        
                    document.getElementById("hostelName").innerHTML = "<?php echo $row["Hostel_Name"]; ?>";
                    document.getElementById("noOfBeds").innerHTML = "No of Beds: <?php echo $row["No_Of_Beds"]; ?>";
                    document.getElementById("far").innerHTML = "Far: <?php echo $row["Far"]; ?>";
                    document.getElementById("hostelDetailsCard").style.display = "block";
                });
                <?php
            }
        }

        $conn->close();
        ?>
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7ngQlbbaL_qjsvJQp02PFTXc_gO916s8&callback=myMap"></script>
</body>
</html>
