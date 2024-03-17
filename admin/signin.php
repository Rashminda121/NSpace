<html>
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/0.7.5/flowbite.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>NSPACE - Hostel Management System</title>
</head>
<body>

<section class="bg-gradient-to-b from-blue-600 via-green-600 to-green-900">
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
  <button onclick="window.history.back()" class="mt-4 mb-4 text-white bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-700 dark:hover:bg-gray-800 dark:focus:ring-gray-800"> <i class="fas fa-arrow-left mr-2"></i>Back</button>
      <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                  Admin Sign in
              </h1>
              <form class="space-y-4 md:space-y-6" action="signin.php" method="post">
                  <div>
                      <label for="aemail" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                      <input type="email" name="aemail" id="aemail" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required="">
                  </div>
                  <div>
                      <label for="apassword" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                      <input type="password" name="apassword" id="apassword" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                  </div>
                  
                  <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Sign in</button>
                  
              </form>
          </div>
      </div>
  </div>
</section>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$aemail = $_POST['aemail'];
$apassword = $_POST['apassword'];

$valid_email = "nsbmadmin@gmail.com";
$valid_password = "admin1234";

if ($aemail == $valid_email && $apassword == $valid_password) {
     echo "<script>location.href='home.php';</script>";    
} else {
  echo "<script>alert('Invalid Credentials');</script>";
}
}
    ?>
</body>
</html>