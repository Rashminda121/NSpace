<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
require_once('../dbConfig.php');
$conn = dbCon();

// $email = $_GET['email'];
$accept = "accept";

// Retrieve data from the database
$sql = "SELECT * FROM landlorddata WHERE status=?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $accept);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NSPACE - Hostel Management System</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/0.7.5/flowbite.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .top-space {
            height: 200px;

        }

        .bottom-space {
            height: 400px;

        }

        @media (max-width: 640px) {
            .top-space {
                height: 100px;

            }
        }

        @media (max-width: 400px) {
            .top-space {
                height: 100px;

            }
        }

        @media (min-width: 200px) {
            .top-space {
                height: 100px;

            }
        }
    </style>
</head>

<body>
    <?php include("navbar.php"); ?>
    <h1 class="text-center mt-10 text-2xl font-bold text-blue-800">View all propertise</h1>
    <div class="top-space"></div>

    <!-- Grid content -->
    <div class="flex flex-wrap justify-center place-content-center">
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            ?>



            <div
                class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 m-2 shadow-lg">
                <!-- /// -->
                <div class="flex flex-wrap -mx-2 mb-6 text-center pt-5">
                    <div class="w-full px-3">
                        <h5 class="font-sans text-lg text-grey-900 font-bold">
                            <?php echo ucfirst($row['title']); ?>

                        </h5>
                    </div>
                </div>
                <div class="py-4 px-4 mx-auto max-w-screen-xl text-center lg:py-4 lg:px-12">
                    <hr>
                </div>

                <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-8 lg:px-12">
                    <div
                        class="flex flex-col mb-5 space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4 pr-5 pl-5">
                        <img src="../uploads/<?php echo $row['image']; ?>"
                            class=" mx-auto  w-auto h-40 shadow-md  transition duration-200 transform hover:scale-110"
                            style="height:100%;max-height: 200px;overflow: hidden;" alt="Nspace Logo" />
                    </div>
                </div>
                <div class="flex flex-wrap -mx-4 mb-6 pl-6">
                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 pl-4"
                            for="bedroom">Property</label>
                        <p id="bedroom" name="bedroom"
                            class="appearance-none block w-full  text-gray-700  rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <span class="">
                                <?php echo $row['proname']; ?>
                            </span>
                        </p>
                    </div>
                </div>
                <div class="p-5">

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <textarea id="description" name="description" rows="4" cols="50"
                                class="appearance-none block w-full  rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-300"
                                placeholder="Description" disabled><?php echo $row['description']; ?></textarea>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-4 mb-6">
                        <div class="w-full px-3">
                            <p id="bedroom" name="bedroom"
                                class="appearance-none block w-full  text-gray-700  rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                Price(Rs): <span class="ml-5">
                                    <?php echo $row['price']; ?>
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-4 mb-4 text-center">
                        <div class="w-full px-3">
                            <a href="#">
                                <button type="submit" name="delete"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 w-full rounded">
                                    Reserve
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-4 mb-4 text-center">
                        <div class="w-full px-3">
                            <a href="viewMore.php?id=<?php echo $row['id']; ?>&email=<?php echo $row['lemail']; ?>">
                                <button type="submit" name="delete"
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 w-full rounded">
                                    View More
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>




            <?php
        }
        ?>

    </div>
    <!-- Space below the grid -->
    <div class="bottom-space"></div>

    <?php include("footer.php"); ?>

</body>

</html>