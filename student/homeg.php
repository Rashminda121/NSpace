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
        /* Style for hostel details card */
        .hostel-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hostel-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 6px rgba(50, 50, 93, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
        }
        /* Style for popup card */
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

        // Display hostel details
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="card border border-gray-400 p-4 mb-4 w-full transition-transform transform hover:translate-y-1 hover:shadow-md hostel-card cursor-pointer rounded-lg" 
                     data-lat="<?php echo $row["Latitude"]; ?>" 
                     data-lng="<?php echo $row["Longitude"]; ?>" 
                     onclick="highlightMarker(this)"> <!-- Adjusted width to match the panel -->
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
    <div id="popup-card"></div>
</div>

<script>
    let map;
    let markers = [];

    function myMap() {
        var mapProp = {
            center: new google.maps.LatLng(6.8222, 80.04085), // NSBM Green University coordinates (latitude, longitude)
            zoom: 15,
        };
        map = new google.maps.Map(
            document.getElementById("googleMap"),
            mapProp
        );

        // Add markers for hostels
        <?php
        // Database connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch hostel details
        $sql = "SELECT * FROM Hostel_Details";
        $result = $conn->query($sql);

        // Display hostel details
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                ?>
                // Add marker
                var hostelMarker = new google.maps.Marker({
                    position: new google.maps.LatLng(<?php echo $row["Latitude"]; ?>, <?php echo $row["Longitude"]; ?>),
                    map: map,
                    title: "<?php echo $row["Hostel_Name"]; ?>",
                    animation: google.maps.Animation.DROP,
                });

                // Store marker in array
                markers.push(hostelMarker
            );

// Add click event listener to marker
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
// Get latitude and longitude from data attributes
var lat = parseFloat(element.getAttribute('data-lat'));
var lng = parseFloat(element.getAttribute('data-lng'));

// Loop through markers to find the one to highlight
for (var i = 0; i < markers.length; i++) {
if (markers[i].getPosition().lat() === lat && markers[i].getPosition().lng() === lng) {
// Highlight marker
markers[i].setAnimation(google.maps.Animation.BOUNCE);
setTimeout(function() {
    markers[i].setAnimation(null);
}, 3000); // Bounce animation duration (ms)
break;
}
}
}

function openPopupCard(marker) {
// Construct content for the popup card
var content = `
<div class="bg-white p-4 shadow-md">
<p><strong>Hostel Name:</strong> ${marker.getTitle()}</p>
<p><strong>Latitude:</strong> ${marker.getPosition().lat()}</p>
<p><strong>Longitude:</strong> ${marker.getPosition().lng()}</p>
</div>
`;

// Set content in the popup card
document.getElementById('popup-card').innerHTML = content;

// Show the popup card
document.getElementById('popup-card').style.display = 'block';
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=myMap"></script>
</body>
</html>
