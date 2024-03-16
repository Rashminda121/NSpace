<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Map</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/0.7.5/flowbite.min.css" rel="stylesheet">
    <!-- Remove duplicate Tailwind CSS link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Literata:ital,opsz,wght@0,7..72,300;0,7..72,400;1,7..72,300;1,7..72,400&display=swap"
        rel="stylesheet">

    <style>
        #map {
            margin-left: 320px;
            margin-right: 0px;
            width: calc(100% - 100px);
            height: 90vh;
        }

        body {
            font-family: 'Literata', serif;
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

    <?php include ("navbar.php"); ?>

    <div class="flex">
        <div id="panel" class="h-full w-80 bg-white p-4 fixed left-0 top-0 overflow-y-auto mt-14 mb-20 pb-20"
            style="overflow:scroll-y;">
            <h2 class="text-lg font-bold mb-4 text-center ">Hostel Details</h2>
            <div class="mb-5">
                <hr>
                <hr>
            </div>
            <?php
            error_reporting(E_ALL);
            ini_set('display_errors', 1);

            // Database connection
            require_once ('../dbConfig.php');
            $conn = dbCon();

            if ($conn->connect_error) {
                die ("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM landlorddata where status='accept' ";
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                ?>
                <div class=" card border border-blue-700 p-4 mb-4 w-full transition-transform transform
                    hover:translate-y-1 hover:shadow-md hostel-card cursor-pointer rounded-lg"
                    data-lat="<?php echo $row["latitude"]; ?>" data-lng="<?php echo $row["longitude"]; ?>"
                    onclick="highlightMarker(this)" style="justify-content:center;align-items:center;">



                    <img src="../uploads/<?php echo $row['image']; ?>" alt="<?php echo $row["title"]; ?>"
                        class="w-full rounded-lg mb-2 " style="width:100%;height:100%;max-height:200px; margin: auto;">

                    <input class="text-center" type="text" value=" <?php echo $row['id'] ?>" hidden />

                    <p class="text-center text-blue-900 font-bold mt-3 bg-blue-50 rounded p-2 mb-2 ">
                        <?= ucwords($row["title"]) ?>
                    </p>
                    <p class="mb-2 mt-2">
                        <hr>
                        <hr>
                    </p>
                    <p class="flex text-sm text-left bg-gray-50 mt-2">
                        <span class="font-bold mr-2 text-blue-900">Beds: </span>
                        <?= $row["bedrooms"] ?><br>
                    </p>
                    <p class="flex text-sm text-left bg-gray-50 mt-2">
                        <span class="font-bold mr-2 text-blue-900">Bathrooms: </span>
                        <?= $row["bathrooms"] ?>
                    </p>
                    <p class=" text-sm  mt-3 bg-gray-50 rounded mb-2 ">
                        <span class="font-bold text-blue-900">Price(Rs):</span>
                        <?= $row['price'] ?>.00
                    </p>
                    <p class="mb-3 mt-2">
                        <hr>
                        <hr>
                    </p>
                    <form action="" method="post" class="text-center mt-2">
                        <button type="submit" class="p-2 bg-blue-800 w-full text-white rounded">
                            Reserve
                        </button>
                    </form>

                </div>
                <?php
            }
            // $conn->close();
            ?>
            <div class="mt-5">
                <hr>
                <hr>
            </div>
        </div>
        <div id="map"></div>
        <div id="popup-card" class="shadow-md"></div>

    </div>

    <script>
        var markers = [];

        function initMap() {
            var map = new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat: 6.82163802690581,
                    lng: 80.04154070852864
                },
                zoom: 8,
            });

            // NSBM marker
            var NSBMmarker = new google.maps.Marker({
                position: {
                    lat: 6.820996372680341,
                    lng: 80.03984441709781
                },
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
            google.maps.event.addListener(NSBMmarker, 'click', function () {
                var pos = map.getZoom();
                map.setZoom(17);
                map.setCenter(NSBMmarker.getPosition());
                window.setTimeout(function () {
                    map.setZoom(pos);
                }, 20000);
            });

            // NSBM circle
            map.data.loadGeoJson('../map/data/data.json')
            map.data.setStyle({
                fillColor: '#35d016',
                strokeColor: '#0b751c',
                fillOpacity: 0.1
            });

            <?php
            // Database connection
            require_once ('../dbConfig.php');
            $conn = dbCon();

            if ($conn->connect_error) {
                die ("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM landlorddata where status='accept'";
            $result = $conn->query($sql);

            $markers = array(); // Array to store marker information
            
            while ($row = $result->fetch_assoc()) {
                $markers[] = array(
                    'latitude' => $row["latitude"],
                    'longitude' => $row["longitude"],
                    'proname' => $row["proname"],
                    'image' => $row["image"],
                    'description' => $row["description"],
                    'price' => $row["price"],
                    'negotiable' => $row['negotiable']
                );
            }
            $conn->close();
            ?>
            <?php foreach ($markers as $marker): ?>
                var usermarker = new google.maps.Marker({
                    position: {
                        lat: <?php echo $marker['latitude']; ?>,
                        lng: <?php echo $marker['longitude']; ?>
                    },
                    title: '<?php echo $marker['proname']; ?>',
                    map: map,
                    icon: "../map/pin.png",
                });


                usermarker.image = "<?php echo $marker['image']; ?>";
                usermarker.description = "<?php echo $marker['description']; ?>";
                usermarker.price = "<?php echo $marker['price']; ?>";
                usermarker.negotiable = "<?php echo $marker['negotiable']; ?>";
                // Push each usermarker into the markers array             
                markers.push(usermarker);

                google.maps.event.addListener(usermarker, 'click', function () {
                    openPopupCard(this);
                });

                //Add click event listener for each usermarker            
                google.maps.event.addListener(usermarker, 'click', function () {
                    var pos = map.getZoom();
                    map.setZoom(17);
                    map.setCenter(usermarker.getPosition());
                    window.setTimeout(function () { map.setZoom(pos); }, 20000);
                });

            <?php endforeach; ?>


        }

        function highlightMarker(element) {
            var lat = parseFloat(element.getAttribute('data-lat'));
            var lng = parseFloat(element.getAttribute('data-lng'));

            for (var i = 0; i < markers.length; i++) {
                console.log("Marker Lat: " + markers[i].getPosition().lat() + ", Lng: " + markers[i].getPosition().lng());
                if (markers[i].getPosition().lat() === lat && markers[i].getPosition().lng() === lng) {
                    if (markers[i].getAnimation() !== null) {
                        markers[i].setAnimation(null);
                    } else {
                        markers[i].setAnimation(google.maps.Animation.BOUNCE);
                        setTimeout(function () {
                            markers[i].setAnimation(null);
                        }, 3000);
                    }
                    break;
                }
            }
        }

        function openPopupCard(marker) {
            var content = `
        <div class="bg-white">
            <button class="close-btn absolute top-2 right-2 bg-blue-900 px-3 py-1 rounded-full text-sm text-white">&times;</button>
            <img src="../uploads/${marker.image}" alt="${marker.getTitle()}" class="w-72 mx-auto rounded-lg mb-2">
            <p class="text-center text-blue-900 bg-blue-50 p-2 mb-2 capitalize font-bold"><strong>${marker.getTitle()}</strong></p>
            
            <textarea rows="2" cols="20" disabled class="appearance-none block w-full text-base text-gray-700 py-3 px-4 bg-gray-50 focus:bg-white mb-5 text-center capitalize" disabled>${marker.description}</textarea>
            <p class="text-center mb-2"><strong class="mr-2 text-blue-900">Price(Rs): </strong> ${marker.price}.00</p>
            <p class="text-center"><strong class="mr-2 text-blue-900">Negotiable:</strong> ${marker.negotiable}</p>
            <p class="mt-2 mb-2"><hr><hr></p>
        </div>
    `;

            document.getElementById('popup-card').innerHTML = content;
            document.getElementById('popup-card').style.display = 'block';

            // Add event listener to the close button
            document.querySelector('.close-btn').addEventListener('click', function () {
                document.getElementById('popup-card').style.display = 'none';
            });
        }




    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1UfAW-b-f-swGAISQfcMjrNMARAd3Rx4&callback=initMap"
        async defer></script>

</body>

</html>