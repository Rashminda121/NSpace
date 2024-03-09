<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management System</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css"  rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 dark:bg-gray-900">

<!-- Navbar -->
<?php include("Navbar.php"); ?>

<!-- Articles Section -->
<section class="py-8 px-4 mx-auto max-w-screen-xl">
    <div class="text-center mb-8">
        <h2 class="text-3xl lg:text-4xl font-extrabold text-gray-900 dark:text-white">Our Articles</h2>
        <p class="text-gray-500 sm:text-lg dark:text-gray-400">Exploring Ideas, Sharing Insights: Your Gateway to Inspiration on <br> Our Blog Page.</p>
    </div> 
    <div class="grid gap-8 lg:grid-cols-2">
        <article class="bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4 text-gray-500">
                    <span class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd"></path><path d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V7z"></path></svg>
                        Article
                    </span>
                    <span class="text-sm">14 days ago</span>
                </div>
                <h2 class="mb-2 text-xl lg:text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><a href="#" class="hover:underline">How to quickly deploy a static website</a></h2>
                <p class="mb-4 text-sm lg:text-base text-gray-500 dark:text-gray-400">Static websites are now used to bootstrap lots of websites and are becoming the basis for a variety of tools that even influence both web designers and developers.</p>
                <div class="flex items-center">
                    <img class="w-7 h-7 rounded-full mr-2" src="image/blogP.png" alt="Jese Leos avatar" />
                    <span class="font-medium dark:text-white">Jese Leos</span>
                </div>
            </div>
        </article> 
        <article class="bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4 text-gray-500">
                    <span class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd"></path><path d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V7z"></path></svg>
                        Article
                    </span>
                    <span class="text-sm">14 days ago</span>
                </div>
                <h2 class="mb-2 text-xl lg:text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><a href="#" class="hover:underline">Our first project with React</a></h2>
                <p class="mb-4 text-sm lg:text-base text-gray-500 dark:text-gray-400">Static websites are now used to bootstrap lots of websites and are becoming the basis for a variety of tools that even influence both web designers and developers.</p>
                <div class="flex items-center">
                    <img class="w-7 h-7 rounded-full mr-2" src="image/blogP.png" alt="Bonnie Green avatar" />
                    <span class="font-medium dark:text-white">Bonnie Green</span>
                </div>
            </div>
        </article>                  
    </div>  
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>
