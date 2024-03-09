<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
require_once('dbConfig.php');
$conn = dbCon();

$email = $_GET['email'];

// Retrieve data from the database
$sql = "SELECT * FROM landlord WHERE lemail=?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/866e8148a5.js" crossorigin="anonymous"></script>
    <script src="navbar.js"></script>
    <title>Land_lord Dashboard</title>
</head>

<body>
    <?php include("navbar.php"); ?>
    <?php
    session_start();
    $req = false;
    //get email
    if (isset($_GET['email'])) {

        $email = $_GET['email'];
    }
    //other
    
    if (isset($_GET['error'])) {
        // $_SESSION['error'] = $_GET['error'];
        $error = $_GET['error'];
    }
    if (isset($_GET['update'])) {
        // $_SESSION['error'] = $_GET['error'];
        $error = "Successfully Password Updated!";
        $bgcolour = "bg-green-100 border-green-400 text-green-700";
        $text = "Success : ";
        $tcol = "text-green-500";
    }

    if (isset($_GET["error"])) {
        $bgcolour = "bg-red-100 border-red-400 text-red-700";
        $text = "Error : ";
        $tcol = "text-red-500";
    }


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
            window.location.href = 'landlordProfile.php?email=<?php echo $email ?>';
        });
    </script>


    <section class="">
        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-8 lg:px-12">
            <div class="flex flex-col mb-5 space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">
                <img src="https://images.g2crowd.com/uploads/product/image/large_detail/large_detail_d5f4bf67004e05149f3eac303f46819e/nspace.png"
                    class="rounded-full mx-auto  w-32 h-32 shadow-md border-4 border-white transition duration-200 transform hover:scale-110"
                    alt="Nspace Logo" />
            </div>
        </div>
    </section>
    <h1 class=" text-2xl text-center m-5 text-blue-800 font-bold">Profile</h1>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        ?>


        <div class="flex justify-center p-10 place-content-center mb-10">

            <form action="landlordProfileData.php?email=<?php echo $email ?>&id=<?php echo $row['id']; ?>" method="post"
                enctype="multipart/form-data" class="w-full max-w-lg">

                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="title">
                            Name
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="name" name="name" type="text" placeholder="Name" value="<?php echo $row['lname']; ?>"
                            disabled>
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="phone">
                            Mobile
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="phone" name="phone" type="text" placeholder="Mobile" value="<?php echo $row['lmobile']; ?>"
                            disabled>
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="address">
                            Address
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="address" name="address" type="text" placeholder="Address"
                            value="<?php echo $row['laddress']; ?>" disabled>
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
                            Email
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="email" name="email" type="text" placeholder="Email" value="<?php echo $row['lemail']; ?>"
                            disabled>
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="password">
                            Password
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="password" name="password" type="password" placeholder="Password"
                            value="<?php echo $row['lpassword']; ?>" required>
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6 text-left">
                    <div class="w-full px-3">
                        <button type="submit" name="edit"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-9 rounded">
                            Update
                        </button>
                    </div>
                </div>


                <hr><br>
                <p class="text-red-500 text-xs italic">You can change your password, Other changes can be done by contacting
                    Admin.
                </p>

            </form>

        </div>
        <?php
    }
    ?>

    <?php include("footer.php"); ?>





</body>

</html>