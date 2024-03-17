<?php
require_once("dbConfig.php");

$conn = OpenCon();

if(isset($_GET['studID'])) {
    $studID = $_GET['studID'];
    
    
    $sql = "SELECT * FROM student WHERE studID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $studID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows === 1) {
        $student = $result->fetch_assoc();
    } else {
        echo "Student details not found.";
        exit;
    }
} else {
    echo "Student id is missing.";
    exit;
}

if(isset($_POST['update_student'])) {
    // Debug: Check the POST data
    var_dump($_POST);

    $studID = $_POST['studID'];
    $sname = $_POST['sname'];
    $sbatch = $_POST['sbatch'];
    $sgender = $_POST['sgender'];
    $semail = $_POST['semail'];
    $spass = $_POST['spass'];
    
    $sql = "UPDATE student SET sname=?, sbatch=?, sgender=?, semail=?, spass=? WHERE studID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $sname, $sbatch, $sgender, $semail, $spass, $studID);

    
    // Debug: Check for errors in prepared statement
    if (!$stmt) {
        echo "Error: " . $conn->error;
    }

    $stmt->execute();
    
    // Debug: Check if update was successful
    if ($stmt->affected_rows > 0) {
        echo "Update successful!";
    } else {
        echo "Update failed.";
    }
    
    header("Location: editStudent.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NSPACE - Hostel Management System</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<?php include ("adminNavbar.php"); ?>
    <section class="bg-white dark:bg-gray-900 mt-16">

            <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">Edit Student Details</h2>
            <form action="" method="POST" class="space-y-8">
        
            <div>
                <label for="studID" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">StudentID</label>
                <input type="text" id="studID" name="studID" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" value="<?php echo $student['studID']; ?> ">
            </div>
            <div>
                <label for="sname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Student Name</label>
                <input type="text" id="sname" name="sname" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" value="<?php echo $student['sname']; ?> ">
            </div>
            <div>
                <label for="sbatch" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Student Batch</label>
                <input type="text" id="sbatch" name="sbatch" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" value="<?php echo $student['sbatch']; ?>" placeholder="Student Batch" required>
            </div>
            <div>
                <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 ">Gender</label>
                <select id="sgender" name="sgender" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                <option value="male" <?php if ($student['sgender'] === 'male') echo 'selected'; ?>>Male</option>
                <option value="female" <?php if ($student['sgender'] === 'female') echo 'selected'; ?>>Female</option>
            </select>
            
            </div>
            <div class="w-full">
                    <label for="semail" class="block mb-2 text-sm font-medium text-gray-900 ">Student Email</label>
                    <input type="email" id="semail" name="semail" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" value="<?php echo $student['semail']; ?>" placeholder="Student Email" required>
                </div>
                <div class="w-full">
                    <label for="spass" class="block mb-2 text-sm font-medium text-gray-900 ">Student Password</label>
                    <input type="password" id="spass" name="spass" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" value="<?php echo $student['spass']; ?>" placeholder="Student password" required>
                </div>
        
            <button type="submit" class="py-3 px-5 text-sm font-medium text-center text-white rounded-lg bg-blue-700 sm:w-fit hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" name="update_student" value="Update student">Update Student Deatils</button>
            
            
    </form>
  </div>
    </section>
</body>
</html>
