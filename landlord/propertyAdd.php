<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="navbar.js"></script>
    <title>Land_lord</title>
</head>

<body>
    <?php include("navbar.php"); ?>
    <?php
    session_start();
    //get email
    if (isset($_GET['email'])) {

        $email = $_GET['email'];
    }
    //other
    if (isset($_GET['error'])) {
        // $_SESSION['error'] = $_GET['error'];
        $error = $_GET['error'];
    }
    if (isset($_GET['success'])) {
        $error = "Successfully Property Added! ";
        $bgcolour = "bg-green-100 border-green-400 text-green-700";
        $text = "Success : ";
        $tcol = "text-green-500";

    } else if (isset($_GET["error"])) {
        $bgcolour = "bg-red-100 border-red-400 text-red-700";
        $text = "Error : ";
        $tcol = "text-red-500";
    } else {
        $bgcolour = "bg-blue-100 border-blue-400 text-blue-700";
        $text = "Message : ";
        $tcol = "text-blue-500";
    }

    // if (isset($_SESSION['error'])) {
//     $error = $_SESSION['error'];
// } else {
//     $error = '';
// }
    
    if (!empty($error)): ?>
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
            window.location.href = 'propertyAdd.php?email=<?php echo $email ?>';
            <?php //unset($_SESSION['error']);                                                                                                                                                     ?>
        });
    </script>




    <h1 class=" text-2xl text-center m-5 text-blue-800 font-bold">Add Property</h1>


    <div class="flex justify-center p-10 place-content-center mb-10">

        <form action="propertyData.php?email=<?php echo $email ?>" method="post" enctype="multipart/form-data"
            class="w-full max-w-lg">
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="title">
                        Title
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="title" name="title" type="text" placeholder="Title" required>
                </div>

            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                        Property Name
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="name" name="name" type="text" placeholder="Name" required>
                </div>

            </div>
            <div class="flex flex-wrap -mx-3 mb-6">

                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="bedroom">
                        Bedrooms
                    </label>
                    <div class="relative">
                        <select
                            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="bedroom" name="bedroom" required>
                            <option selected value=""
                                class="text-gray-700 bg-gray-200 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                Bedrooms</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="3+">3+</option>
                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="bathroom">
                        Bathrooms
                    </label>
                    <div class="relative">
                        <select
                            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="bathroom" name="bathroom" required>
                            <option selected value=""
                                class="text-gray-700 bg-gray-200 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                Bathrooms</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="3+">3+</option>
                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                </div>

            </div>

            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="land">
                        Land Size
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="land" type="text" placeholder="Size" name="land" required>
                </div>
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="unit">
                        Unit
                    </label>
                    <div class="relative">
                        <select
                            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="unit" name="unit" required>
                            <option value="">Unit</option>
                            <option value="perches">Perches</option>
                            <option value="acres">Acres</option>
                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                </div>

            </div>

            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city">
                        City
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="city" type="text" placeholder="City" name="city" required>
                </div>
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="state">
                        State/ Province
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="state" type="text" placeholder="State" name="state" required>
                </div>

                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="zip">
                        Zip
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="zip" type="text" placeholder="Code" name="zip" required>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="address">
                        Address
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="address" type="text" placeholder="Address" name="address" required>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        for="description">Description:</label>
                    <textarea id="description" name="description" rows="4" cols="50"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        placeholder="Description" name="description" required></textarea>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-3/5 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="price">
                        Price
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="price" type="text" placeholder="price" name="price" required>
                </div>
                <div class="w-full md:w-2/5 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="negotiable">
                        Negotiable
                    </label>
                    <div class="relative">
                        <select
                            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="negotiable" name="negotiable" required>
                            <option>Negotiable</option>
                            <option>Not Negotiable</option>


                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <hr><br>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        for="image">Image</label>
                    <input type="file" id="image" name="image" accept=".jpg, .jpeg, .png" required><br>
                </div>
            </div>
            <hr><br>

            <!-- //map -->
            <div class="flex flex-wrap items-center justify-center -mx-3 mb-6">
                <div id="map" style="width:100%;height:400px;"></div>
            </div>

            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-2/6 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="lon">
                        Latitude
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="lat" type="text" placeholder="Latitude" name="lat" required>
                </div>
                <div class="w-full md:w-2/6 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="lon">
                        Longitude
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="lon" type="text" placeholder="Longitude" name="lon" required>
                </div>
                <!-- //get location butttton -->
                <div class="w-full md:w-2/6 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="btn">
                        Get Current Location
                    </label>
                    <button id="btn" name="btn" type="button"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-7 rounded">
                        Get Location
                    </button>

                </div>


            </div>



            <!-- //map -->
            <hr><br>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        for="name">Name</label>
                    <p>Name</p>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        for="email">Email</label>
                    <p>user@mail.com</p>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        for="number">Number</label>
                    <p>+9471234567</p>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6 text-right">
                <div class="w-full px-3">
                    <button type="submit" name="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Submit
                    </button>
                </div>
            </div>

            <hr><br>
            <p class="text-red-500 text-xs italic">By Posting this Property, You Agree to the Terms & Conditions of this
                Site.
            </p>

        </form>

    </div>
    <?php include("footer.php"); ?>

    <!-- --map-- -->
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5Y2wjpvIxdIEZiaog97p2jj9p1o6hjv4&libraries=geometry"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var map = new google.maps.Map(document.getElementById("map"), {
                center: new google.maps.LatLng(6.82163802690581, 80.04154070852864),
                zoom: 8,
            });



            //nsbm marker
            var NSBMmarker = new google.maps.Marker({
                position: { lat: 6.820996372680341, lng: 80.03984441709781 },
                title: "NSBM Green University",
                map: map,
                //animation: google.maps.Animation.BOUNCE,
                draggable: true,
                icon: "./map/nsbmMarker.png"
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
                window.setTimeout(function () { map.setZoom(pos); }, 20000);
            });


            // nsbm circle
            map.data.loadGeoJson('map/data/data.json')
            map.data.setStyle({
                fillColor: '#35d016',
                strokeColor: '#0b751c',
                fillOpacity: 0.1
            });


            //marker get location
            google.maps.event.addListener(map, 'click', function (event) {
                var marker = new google.maps.Marker({
                    position: event.latLng,
                    map: map,
                    icon: "map/pin2.png",
                    animation: google.maps.Animation.BOUNCE
                });

                // Set latitude and longitude values to input fields
                document.getElementById('lat').value = event.latLng.lat();
                document.getElementById('lon').value = event.latLng.lng();

                // zoom in marker
                google.maps.event.addListener(marker, 'click', function () {
                    var pos = map.getZoom();
                    map.setZoom(15);
                    map.setCenter(marker.getPosition());
                    window.setTimeout(function () { map.setZoom(pos); }, 20000);
                });

                // Remove the marker after 5 seconds
                setTimeout(function () {
                    marker.setMap(null);
                }, 10000);
            });


            // Get location by button
            document.getElementById('btn').addEventListener('click', function () {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        (position) => {
                            const currentLocation = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude,
                            };

                            // Set latitude and longitude values to input fields
                            document.getElementById('lat').value = currentLocation.lat;
                            document.getElementById('lon').value = currentLocation.lng;

                            // Add marker for current location
                            const marker = new google.maps.Marker({
                                position: currentLocation,
                                map: map,
                                animation: google.maps.Animation.BOUNCE,
                                icon: "map/pin.png"
                            });

                            map.setCenter(currentLocation);
                            var pos = 8;
                            map.setZoom(11);
                            window.setTimeout(function () { map.setZoom(pos); }, 20000);

                            // Remove marker after 5 seconds
                            setTimeout(() => {
                                marker.setMap(null);
                            }, 10000);

                        }
                    );
                } else {
                    alert('Geolocation is not supported by this browser.');
                }
            });


        });
    </script>

</body>

</html>