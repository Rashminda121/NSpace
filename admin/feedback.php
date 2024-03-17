<?php
// Fetch feedback from the database
require_once("dbconfig.php");

$conn = OpenCon();
$sql = "SELECT * FROM feedback";
$result = $conn->query($sql);

$feedbacks = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $feedbacks[] = $row;
    }
}

CloseCon($conn);
?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NSPACE - Hostel Management System</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <?php include ("Navbar.php"); ?>
    
<section class="bg-white dark:bg-gray-900 mt-14">
  <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-6">
      <div class="mx-auto max-w-screen-sm">
          <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Feedbacks</h2>
      </div> 
      <div class="grid mb-8 lg:mb-12 lg:grid-cols-2">
      <?php foreach ($feedbacks as $feedback) : ?>
          <figure class="flex flex-col justify-center items-center p-8 text-center bg-gray-50 border-b border-gray-200 md:p-12 lg:border-r dark:bg-gray-800 dark:border-gray-700">
              <blockquote class="mx-auto mb-8 max-w-2xl text-gray-500 dark:text-gray-400">
                  <h3 class="text-lg font-semibold text-gray-900 dark:text-white"><?php echo htmlspecialchars($feedback['subject']); ?></h3>
                  <p class="my-4"><?php echo htmlspecialchars($feedback['message']); ?></p>
                 
              </blockquote>
              <figcaption class="flex justify-center items-center space-x-3">
                 
              <div class="flex items-center mt-4">
              <img class="w-7 h-7 rounded-full" src="image/blogP.png" alt="profile picture">
                  <div class="ml-4">
                      <p class="font-medium text-white dark:text-white"><?php echo htmlspecialchars($feedback['name']); ?></p>
                      <p class="text-sm text-gray-400 dark:text-gray-400"><?php echo htmlspecialchars($feedback['email']); ?></p>
                  </div>
              </div>
              </figcaption>    
          </figure>
          <?php endforeach; ?>
          
          </div>
      <div class="text-center">
          <a href="#" class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Show more...</a> 
      </div>
</section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>
