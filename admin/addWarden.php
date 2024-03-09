<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Add Warden</title>
</head>
<body>
<?php include("adminNavbar.php"); ?>
<section class="bg-white mt-16">
  <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
      <h2 class="mb-10 text-3xl text-center font-bold text-gray-900">Let's add a new warden.</h2>
      <form action="addWarden.php" method="post">
          <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 mt-16">
              <div class="w-full">
                  <label for="wname" class="block mb-2 text-sm font-medium text-gray-900 ">Warden Name</label>
                  <input type="text" name="wname" id="wname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Name" required="">
              </div>
              <div class="w-full">
                  <label for="wmobile" class="block mb-2 text-sm font-medium text-gray-900 ">Mobile No</label>
                  <input type="text" name="wmobile" id="wmobile" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Mobile" required="">
              </div>
              <div class="w-full">
                  <label for="wemail" class="block mb-2 text-sm font-medium text-gray-900 ">Warden Email</label>
                  <input type="text" name="wemail" id="wemail" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Email" required="">
              </div>
              <div class="w-full">
                  <label for="wpassword" class="block mb-2 text-sm font-medium text-gray-900 ">Warden Password</label>
                  <input type="password" name="wpassword" id="wpassword" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Password" required="">
              </div> 
          </div>
          <div class="flex justify-center">
          <button type="submit" class="self-center border bg-[#084cd4] items-center px-10 py-2.5 mt-6 sm:mt-10 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 hover:bg-primary-800">
              Add Warden
          </button>
          </div>
      </form>
  </div>
</section>

<?php

require_once('dbConfig.php');

function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = OpenCon();
    // Sanitize user input
    $wname = sanitizeInput($_POST['wname']);
    $wmobile = sanitizeInput($_POST['wmobile']);
    $wemail = sanitizeInput($_POST['wemail']);
    $wpassword = sanitizeInput($_POST['wpassword']);

    
    $sql = "INSERT INTO warden (wname, wmobile, wemail, wpassword)
            VALUES (?, ?, ?, ?)";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $wname, $wmobile, $wemail, $wpassword);

        $stmt->execute();

        $success_message = "Warden details added successfully.";
        echo "<script>alert('$success_message');</script>";

    } catch(mysqli_sql_exception $e) {
        $error_message = $e->getMessage();
        echo "<script>alert('$error_message');</script>";
    } finally {
        $stmt->close();
        CloseCon($conn); 
    }
}
?>

</body>
</html>