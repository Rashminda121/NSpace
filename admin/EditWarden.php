<?php
require_once("dbConfig.php");

$conn = OpenCon();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM warden WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $warden = $result->fetch_assoc();
    } else {
        echo "Warden details not found.";
        exit;
    }
} else {
    echo "Warden id is missing.";
    exit;
}

if (isset($_POST['update_warden'])) {
    $id = $_POST['id'];
    $wname = $_POST['wname'];
    $wmobile = $_POST['wmobile'];
    $wpassword = $_POST['wpassword'];
    $wemail = $_POST['wemail'];

    $sql = "UPDATE warden SET wname=?, wmobile=?, wpassword=?, wemail=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $wname, $wmobile, $wpassword, $wemail, $id);
    $stmt->execute();

    header("Location: View&EditWarden.php");
    exit;
}

// Handle warden deletion
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM warden WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: View&EditWarden.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Warden Details</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<?php include ("adminNavbar.php"); ?>
    <section class="bg-white dark:bg-gray-900 mt-16">

  <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
  <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">Edit Warden Details</h2>
    <form action="" method="POST" class="space-y-8">
       
          <div>
              <label for="id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Warden ID</label>
              <input type="text" id="wardenID" name="id" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" value="<?php echo $warden['id']; ?> " readonly>
          </div>
          <div>
              <label for="wname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Warden Name</label>
              <input type="text" id="wname" name="wname" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" value="<?php echo $warden['wname']; ?> ">
          </div>
          <div>
              <label for="wmobile" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Warden Mobile</label>
              <input type="text" id="wmobile" name="wmobile" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" value="<?php echo $warden['wmobile']; ?>" placeholder="Warden Mobile" required>
          </div>
          <div class="w-full">
                  <label for="wemail" class="block mb-2 text-sm font-medium text-gray-900 ">Warden Email</label>
                  <input type="email" id="wemail" name="wemail" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" value="<?php echo $warden['wemail']; ?>" placeholder="Warden Email" required>
              </div>
              <div class="w-full">
                  <label for="wpassword" class="block mb-2 text-sm font-medium text-gray-900 ">Warden Password</label>
                  <input type="password" id="wpassword" name="wpassword" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" value="<?php echo $warden['wpassword']; ?>" placeholder="Warden password" required>
              </div>
       
          <button type="submit" class="py-3 px-5 text-sm font-medium text-center text-white rounded-lg bg-blue-700 sm:w-fit hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" name="update_warden" value="Update warden">Update Warden Details</button>
        
        
    </form>
  </div>
    </section>
</body>
</html>