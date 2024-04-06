<html>

<head>
    <title>Property Data</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>

<body>

    <?php include ("navbar.php"); ?>
    <h1 class="text-center font-semibold text-4xl mt-20">Property List</h1>

    <div class="relative overflow-x-auto shadow-md mt-8">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
            <thead class="text-xs text-white uppercase bg-gray-50 dark:bg-gray-600 text-white">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Id
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Bedrooms
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Bathrooms
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Land size
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Unit
                    </th>
                    <th scope="col" class="px-6 py-3">
                        City
                    </th>
                    <th scope="col" class="px-6 py-3">
                        State
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Zip Code
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Address
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Description
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Price
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Negotiable
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Image
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Landlord Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Property Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch data from the database and populate the table rows
                $servername = "localhost";
                $username = "root";
                $password = "12345678";
                $dbname = "nspacedb";

                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // SQL query to fetch data from the database
                $sql = "SELECT * FROM landlorddata";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr class='bg-white border-b text-white dark:bg-gray-800 dark:border-gray-700'>";
                        echo "<td class='px-6 py-4'>" . $row['id'] . "</td>";
                        echo "<td class='px-6 py-4'>" . $row['title'] . "</td>";
                        echo "<td class='px-6 py-4'>" . $row['bedrooms'] . "</td>";
                        echo "<td class='px-6 py-4'>" . $row['bathrooms'] . "</td>";
                        echo "<td class='px-6 py-4'>" . $row['landsize'] . "</td>";
                        echo "<td class='px-6 py-4'>" . $row['unit'] . "</td>";
                        echo "<td class='px-6 py-4'>" . $row['city'] . "</td>";
                        echo "<td class='px-6 py-4'>" . $row['state'] . "</td>";
                        echo "<td class='px-6 py-4'>" . $row['zipcode'] . "</td>";
                        echo "<td class='px-6 py-4'>" . $row['address'] . "</td>";
                        echo "<td class='px-6 py-4'>" . $row['description'] . "</td>";
                        echo "<td class='px-6 py-4'>" . $row['price'] . "</td>";
                        echo "<td class='px-6 py-4'>" . $row['negotiable'] . "</td>";
                        echo "<td class='px-6 py-4'><img src='../uploads/" . $row['image'] . "' class='w-16 h-16'></td>";
                        echo "<td class='px-6 py-4'>" . $row['status'] . "</td>";
                        echo "<td class='px-6 py-4'>" . $row['lemail'] . "</td>";
                        echo "<td class='px-6 py-4'>" . $row['proname'] . "</td>";
                        echo "<td class='px-6 py-4'><a href='#' class='font-medium text-red-600 dark:text-red-500 hover:underline'>Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='18' class='px-6 py-4'>No data found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>