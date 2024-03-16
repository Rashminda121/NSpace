<?php
require_once("dbConfig.php");
$conn = OpenCon();

// Check if feedback id is provided in the URL
if(isset($_GET['id'])) {
    $feedback_id = $_GET['id'];
    
    // Retrieve feedback details from the database based on the provided id
    $sql = "SELECT * FROM feedback WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $feedback_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows === 1) {
        // Fetch feedback details
        $feedback = $result->fetch_assoc();
    } else {
        // No feedback found with the provided id
        echo "Feedback not found.";
        exit;
    }
} else {
    // Feedback id is not provided in the URL
    echo "Feedback id is missing.";
    exit;
}

// Handle form submission for updating the feedback
if(isset($_POST['update_feedback'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    
    // Update feedback details in the database
    $sql = "UPDATE feedback SET name=?, email=?, subject=?, message=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $name, $email, $subject, $message, $feedback_id);
    $stmt->execute();
    
    // Redirect to the page where feedbacks are listed after update
    header("Location: feedbackEdit.php");
    exit;
}
// Delete Action
if (isset($_POST['delete'])) {
    $sql = "DELETE FROM feedback WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $feedback_id); // Use "i" for integer
        mysqli_stmt_execute($stmt);

        // Check if any rows were affected
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            header("Location: feedbackEdit.php?delete=1");
            exit();
        } else {
            // Handle no rows affected error
            header("Location: feedbackEdit.php?error=No feedback found to delete");
            exit();
        }
    } else {
        // Handle SQL error
        header("Location: feedbackEdit.php?error=" . mysqli_error($conn));
        exit();
    }
}


mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Feedback</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<?php include ("adminNavbar.php"); ?>
    <section class="bg-white dark:bg-gray-900 mt-16">

  <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
  <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">Edit Feedback</h2>
    <form action="" method="POST" class="space-y-8">
       
        <div>
              <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Name</label>
              <input type="text" id="name" name="name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" value="<?php echo $feedback['name']; ?>">
          </div>
          <div>
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your email</label>
              <input type="email" id="email" name="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" value="<?php echo $feedback['email']; ?>" placeholder="name@flowbite.com" required>
          </div>
          <div>
              <label for="subject" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your email</label>
              <input type="text" id="subject" name="subject" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" value="<?php echo $feedback['subject']; ?>" placeholder="name@flowbite.com" required>
          </div>
        
          <div class="sm:col-span-2">
              <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Your message</label>
              <textarea id="message" name="message" rows="6" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg shadow-sm border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Leave a comment..."><?php echo $feedback['message']; ?></textarea>
          </div>
       
          <button type="submit" class="py-3 px-5 text-sm font-medium text-center text-white rounded-lg bg-blue-700 sm:w-fit hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" name="update_feedback" value="Update Feedback">Update Feedback</button>
        
        
    </form>
  </div>
    </section>
</body>
</html>
