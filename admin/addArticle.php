<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Add Article</title>
</head>
<body>
<?php include("adminNavbar.php"); ?>
<section class="bg-white ">
  <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
      <h2 class="mb-10 text-2xl font-bold text-gray-900">Let's add a new article.</h2>
      <form action="addArticle.php" method="post">
          <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 mt-16">
              <div class="sm:col-span-2">
                  <label for="title" class="block mb-2 text-sm font-medium text-gray-900 ">Article Title</label>
                  <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Title" required="">
              </div>
             
              <div class="sm:col-span-2">
                  <label for="content" class="block mb-2 text-sm font-medium text-gray-900 ">Description</label>
                  <textarea id="description" name="content" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500" placeholder="Your content here"></textarea>
              </div>
          </div>
          
          <div class="flex justify-center">
          <button type="submit" class="self-center border bg-[#084cd4] items-center px-10 py-2.5 mt-6 sm:mt-10 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 hover:bg-primary-800">
              Add Article
          </button>
          </div>
      </form>
  </div>
</section>


</body>
</html>