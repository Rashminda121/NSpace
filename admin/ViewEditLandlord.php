<?php
// Fetch landlords from the database
require_once("dbConfig.php");

$conn = OpenCon();
$sql = "SELECT * FROM landlord";
$result = $conn->query($sql);

$landlords = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $landlords[] = $row;
    }
}

CloseCon($conn);
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Landlords</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <?php include("adminNavbar.php"); ?>
    <div class="mx-auto max-w-screen-sm mt-20">
        <h2 class="mb-4 text-4xl tracking-tight text-center font-extrabold text-gray-900 dark:text-white">Edit Landlords</h2>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg ml-4 mr-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Landlord ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Landlord Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Landlord Address
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Mobile
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($landlords as $landlord) : ?>
                    <tr class="bg-white border-gray dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <?php echo htmlspecialchars($landlord['id']); ?>
                        </th>
                        <td class="px-6 py-4">
                            <?php echo htmlspecialchars($landlord['lname']); ?>
                        </td><td class="px-6 py-4">
                            <?php echo htmlspecialchars($landlord['laddress']); ?>
                        </td>
                        
                        <td class="px-6 py-4">
                            <?php echo htmlspecialchars($landlord['lemail']); ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo htmlspecialchars($landlord['lmobile']); ?>
                        </td>
                        <td class="px-6 py-4">
                            <a href="EditLandlord.php?id=<?php echo $landlord['id']; ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        </td>
                        <td>
                            <a href="EditLandlord.php?action=delete&id=<?php echo $landlord['id']; ?>" class="font-medium text-red-600 dark:text-red-500 hover:underline" onclick="return confirm('Are you sure you want to delete this landlord?')">Remove</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>
