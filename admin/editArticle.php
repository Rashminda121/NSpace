<?php
// Fetch feedback from the database
require_once("dbConfig.php");

$conn = OpenCon();
$sql = "SELECT * FROM article";
$result = $conn->query($sql);

$article = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $article[] = $row;
    }
}

// Delete Action
if (isset($_POST['delete'])) {
    $article_id = $_POST['article_id']; 
    $sql = "DELETE FROM article WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $article_id); // Bind the id properly
        mysqli_stmt_execute($stmt);

        // Check if any rows were affected
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            header("Location: editArticle.php?delete=1");
            exit();
        } else {
            // Handle no rows affected error
            header("Location: editArticle.php?error=No article found to delete");
            exit();
        }
    } else {
        // Handle SQL error
        header("Location: editArticle.php?error=" . mysqli_error($conn));
        exit();
    }
}

CloseCon($conn);
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NSPACE - Hostel Management System</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<?php include ("adminNavbar.php"); ?>
<div class="mx-auto max-w-screen-sm mt-20">
          <h2 class="mb-4 text-4xl tracking-tight text-center font-extrabold text-gray-900 dark:text-white">Edit Articles</h2>
      </div> 
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg ml-4 mr-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Article Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Author's Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Description
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>

            <tbody>
            <?php foreach ($article as $article) : ?>
    <tr class="bg-white border-gray dark:bg-gray-800 dark:border-gray-700">
        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            <?php echo htmlspecialchars($article['title']); ?>
        </th>
        <td class="px-6 py-4">
            <?php echo htmlspecialchars($article['name']); ?>
        </td>
        <td class="px-6 py-4">
            <?php echo htmlspecialchars($article['date']); ?>
        </td>
        <td class="px-6 py-4">
            <?php echo htmlspecialchars($article['content']); ?>
        </td>
        <td class="px-6 py-4">
            <a href="edit_article.php?id=<?php echo $article['id']; ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
        </td>
        <td class="px-6 py-4">
            <form action="" method="POST" onsubmit="return confirmDelete()">
                <input type="hidden" name="article_id" value="<?php echo $article['id']; ?>">
                    <button type="submit" name="delete" value="<?php echo $article['id']; ?>"
                    class="font-medium text-red-600 dark:text-red-500 hover:underline mt-3">Delete</button>
            </form>

        </td>
    </tr>

    <script>
            function confirmDelete() {
                if (confirm("Are you sure you want to delete this Article?")) {
                    return true;
                }
                return false;
            }
    </script>

<?php endforeach; ?>


            </tbody>
        </table>
        </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>