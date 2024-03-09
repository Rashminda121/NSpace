<html>
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/0.7.5/flowbite.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <title>Hostel Management System</title>
</head>
<body>
<?php include ("Navbar.php"); ?>
<section class="bg-white dark:bg-gray-900 mt-16">

  <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
      <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">Contact Us</h2>
      <p class="mb-8 lg:mb-16 font-light text-center text-gray-500 dark:text-gray-400 sm:text-xl">Got a technical issue? Want to send feedback about our Hostel Management System? Please Let us know.</p>
      <form action="contact.php" method="post">
        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your Name</label>
            <input type="text" id="name" name="name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" placeholder="Your Name" required>
        </div>
        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your Email</label>
            <input type="email" id="email" name="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" placeholder="name@email.com" required>
        </div>
        <div>
            <label for="subject" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Subject</label>
            <input type="text" id="subject" name="subject" class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" placeholder="Let us know how we can help you" required>
        </div>
        <div class="sm:col-span-2">
            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Your message</label>
            <textarea id="message" name="message" rows="6" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg shadow-sm border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Leave a comment..."></textarea>
        </div>
        <button type="submit" class="py-3 px-5 text-sm font-medium text-center text-white rounded-lg bg-blue-700 sm:w-fit hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Send message</button>
    </form>
  </div>
</section>


<?php

require_once("dbconfig.php"); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $conn = OpenCon(); 

  $name = sanitizeInput($_POST["name"]);
  $email = sanitizeInput($_POST["email"]);
  $subject = sanitizeInput($_POST["subject"]);  
  $message = sanitizeInput($_POST["message"]);
  

  
  $sql = "INSERT INTO contact (name, email, subject, message)
          VALUES (?, ?, ?, ?)";

  $stmt = $conn->prepare($sql); 
  $stmt->bind_param("ssss", $name, $email, $subject, $message); 

  try {
    if ($stmt->execute()) {
      echo "<script>alert('Feedback added successfully!');</script>";
    } 
  } catch (mysqli_sql_exception $e) {
    echo "<script>alert('Error!');</script>";
  } finally {
    $stmt->close(); 
    CloseCon($conn); 
  }
}

// Function to sanitize user input (IMPORTANT to prevent security vulnerabilities)
function sanitizeInput($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

</body>
</html>