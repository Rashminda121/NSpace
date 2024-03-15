<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Add Student</title>
</head>
<body>
<?php include("adminNavbar.php"); ?>
<section class="bg-white mt-16">
  <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
      <h2 class="mb-10 text-3xl text-center font-bold text-gray-900">Let's add a new student.</h2>
      <form action="addStudent.php" method="post">
          <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 mt-16">
              <div class="w-full">
                  <label for="studID" class="block mb-2 text-sm font-medium text-gray-900 ">Student ID</label>
                  <input type="text" name="studID" id="studID" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Student ID" required="">
              </div>
              <div class="w-full">
                  <label for="sname" class="block mb-2 text-sm font-medium text-gray-900 ">Student Name</label>
                  <input type="text" name="sname" id="sname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Student Name" required="">
              </div>
              <div class="w-full">
                  <label for="sbatch" class="block mb-2 text-sm font-medium text-gray-900 ">Student Batch</label>
                  <input type="text" name="sbatch" id="sbatch" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Student Batch" required="">
              </div>
              <div>
                  <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 ">Gender</label>
                  <select id="sgender" name="sgender" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                  </select>
              </div>
              <div class="w-full">
                  <label for="semail" class="block mb-2 text-sm font-medium text-gray-900 ">Student Email</label>
                  <input type="text" name="semail" id="semail" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Student Email" required="">
              </div>
              <div class="w-full">
                  <label for="spass" class="block mb-2 text-sm font-medium text-gray-900 ">Student Password</label>
                  <input type="password" name="spass" id="spass" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Student Password" required="">
              </div> 
          </div>
          <div class="flex justify-center">
          <button type="submit" class="self-center border bg-[#084cd4] items-center px-10 py-2.5 mt-6 sm:mt-10 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 hover:bg-primary-800">
              Add Student
          </button>
          </div>
      </form>
  </div>
</section>

<?php

require_once("dbconfig.php"); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $conn = OpenCon(); 

  $studID = sanitizeInput($_POST["studID"]);
  $sname = sanitizeInput($_POST["sname"]);
  $sbatch = sanitizeInput($_POST["sbatch"]);
  $sgender = $_POST["sgender"];  
  $semail = sanitizeInput($_POST["semail"]);
  $spass = sanitizeInput($_POST["spass"]); 

  
  $sql = "INSERT INTO student (studID, sname, sbatch, sgender, semail, spass)
          VALUES (?, ?, ?, ?, ?, ?)";

  $stmt = $conn->prepare($sql); 
  $stmt->bind_param("ssssss", $studID, $sname, $sbatch, $sgender, $semail, $spass); 

  try {
    if ($stmt->execute()) {
      echo "<script>alert('Student added successfully!');</script>";
    } 
  } catch (mysqli_sql_exception $e) {
    echo "<script>alert('Error: Student ID already exists!');</script>";
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