<?php
// Include the dbConfig.php file to establish a database connection
require_once("dbConfig.php");

// Open a connection to the database
$conn = OpenCon();

// Check if feedback id is provided in the URL
if(isset($_GET['id'])) {
    $article_id = $_GET['id'];
    
    // Retrieve feedback details from the database based on the provided id
    $sql = "SELECT * FROM article WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $article_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows === 1) {
        // Fetch feedback details
        $article = $result->fetch_assoc();
    } else {
        // No feedback found with the provided id
        echo "article not found.";
        exit;
    }
} else {
    // Feedback id is not provided in the URL
    echo "article id is missing.";
    exit;
}

// Handle form submission for updating the feedback
if(isset($_POST['update_article'])) {
    // Retrieve form data
    $title = $_POST['title'];
    $name = $_POST['name'];
    $date = $_POST['date'];
    $content = $_POST['content'];
    
    // Update feedback details in the database
    $sql = "UPDATE article SET title=?, name=?, date=?, content=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $title, $name, $date, $content, $article_id);
    $stmt->execute();
    
    // Redirect to the page where feedbacks are listed after update
    header("Location: editArticle.php");
    exit;
}
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
  <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">Edit Article</h2>
    <form action="" method="POST" class="space-y-8">
       
        <div>
              <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Article Title</label>
              <input type="text" id="name" name="name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" value="<?php echo $article['name']; ?>">
          </div>
          <div>
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Author's Name</label>
              <input type="email" id="email" name="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" value="<?php echo $article['email']; ?>" placeholder="name@flowbite.com" required>
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
