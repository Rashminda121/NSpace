<?php
require_once("dbConfig.php");

$conn = OpenCon();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM landlord WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $landlord = $result->fetch_assoc();
    } else {
        echo "Landlord details not found.";
        exit;
    }
} else {
    echo "Landlord id is missing.";
    exit;
}

if (isset($_POST['update_landlord'])) {
    $id = $_POST['id'];
    $lname = $_POST['lname'];
    $lmobile = $_POST['lmobile'];
    $laddress = $_POST['laddress'];
    $lemail = $_POST['lemail'];
    $lpassword = $_POST['lpassword'];

    $sql = "UPDATE landlord SET lname=?, lmobile=?, laddress=?, lemail=?, lpassword=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $lname, $lmobile, $laddress, $lemail, $lpassword, $id);
    $stmt->execute();

    header("Location: View&EditLandlord.php");
    exit;
}

// Handle landlord deletion
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM landlord WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: View&EditLandlord.php");
    exit;
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Landlord Details</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<?php include ("adminNavbar.php"); ?>
    <section class="bg-white dark:bg-gray-900 mt-16">

  <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
  <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">Edit Landlord Details</h2>
    <form action="" method="POST" class="space-y-8">
       
          <div>
              <label for="id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Landlord ID</label>
              <input type="text" id="id" name="id" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" value="<?php echo $landlord['id']; ?> " readonly>
          </div>
          <div>
              <label for="lname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Landlord Name</label>
              <input type="text" id="lname" name="lname" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" value="<?php echo $landlord['lname']; ?> ">
          </div>
          <div>
              <label for="lmobile" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Landlord Mobile</label>
              <input type="text" id="lmobile" name="lmobile" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" value="<?php echo $landlord['lmobile']; ?>" placeholder="Landlord Mobile" required>
          </div>
          <div class="w-full">
              <label for="laddress" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Landlord Address</label>
              <input type="text" id="laddress" name="laddress" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" value="<?php echo $landlord['laddress']; ?>" placeholder="Landlord Address" required>
          </div>
          <div class="w-full">
                  <label for="lemail" class="block mb-2 text-sm font-medium text-gray-900 ">Landlord Email</label>
                  <input type="email" id="lemail" name="lemail" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" value="<?php echo $landlord['lemail']; ?>" placeholder="Landlord Email" required>
              </div>
              <div class="w-full">
                  <label for="lpassword" class="block mb-2 text-sm font-medium text-gray-900 ">Landlord Password</label>
                  <input type="password" id="lpassword" name="lpassword" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" value="<?php echo $landlord['lpassword']; ?>" placeholder="Landlord password" required>
              </div>
       
          <button type="submit" class="py-3 px-5 text-sm font-medium text-center text-white rounded-lg bg-blue-700 sm:w-fit hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" name="update_landlord" value="Update landlord">Update Landlord Details</button>
        
        
    </form>
  </div>
    </section>
</body>
</html>