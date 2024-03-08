<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management System</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <?php include ("Navbar.php"); ?>
    <section class="bg-[#082f49]">
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="lg:col-span-7 lg:mr-auto">
                <br>
                <h1 class="text-4xl font-bold text-white md:text-5xl xl:text-6xl max-w-4xl">Welcome to our Hostel Management System!</h1>
                <p class="mt-3 text-lg font-medium text-yellow-300 lg:mt-6 lg:text-xl">Where strangers become friends and adventures begin</p>
                <br>
                <div class="mt-6">
                    <a href="#" class="inline-block ml-3 px-5 py-3 text-base font-medium text-gray-900 bg-[#7dd3fc] rounded-lg hover:bg-[#0369a1] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0369a1]">Book Now...</a>
                    <span class="mx-1"></span>
                    <a href="#" class="inline-block px-5 py-3 text-base font-medium text-white bg-[#0369a1] rounded-lg hover:bg-[#7dd3fc] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0369a1]">See More Article</a>
                </div>
            </div>
            <div class="flex items-center justify-center mt-6 lg:mt-0 lg:col-span-5">
                <img src="image/2.avif" alt="Mockup" class="w-full h-auto lg:w-auto">
            </div>
        </div>
    </section>

    <section id="Projects"
    class="w-fit mx-auto grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 justify-items-center justify-center gap-y-20 gap-x-14 mt-10 mb-5">

    <!-- Product card 1 -->
    <div class="h-80 w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
        <a href="#">
            <img src="image/a1.jpg"
                    alt="Product" class="h-60 w-72 object-cover rounded-t-xl" />
            <div class="px-4 py-3 w-72">
                <p class="text-lg font-bold text-black truncate block capitalize">How to find a good hostel</p>
                <span class="text-gray-400 mr-3 uppercase text-xs">2024-03-08</span>
            </div>
        </a>
    </div>
    <!-- Product card 1 End -->

    <!-- Product card 2 -->
    <div class="h-80 w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
        <a href="#">
                    <img src="https://images.unsplash.com/photo-1651950537598-373e4358d320?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwcm9maWxlLXBhZ2V8MjV8fHxlbnwwfHx8fA%3D%3D&auto=format&fit=crop&w=500&q=60"
                    alt="Product" class="h-60 w-72 object-cover rounded-t-xl" />
            <div class="px-4 py-3 w-72">
            <p class="text-lg font-bold text-black truncate block capitalize">How to find a good hostel</p>
                <span class="text-gray-400 mr-3 uppercase text-xs">2024-03-08</span>
            </div>
        </a>
    </div>
    <!-- Product card 2 Ends-->

    <!-- Product card 3 -->
    <div class="h-80 w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
        <a href="#">
            <img src="https://images.unsplash.com/photo-1646753522408-077ef9839300?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwcm9maWxlLXBhZ2V8NjZ8fHxlbnwwfHx8fA%3D%3D&auto=format&fit=crop&w=500&q=60"
                    alt="Product" class="h-60 w-72 object-cover rounded-t-xl" />
            <div class="px-4 py-3 w-72">
                <span class="text-gray-400 mr-3 uppercase text-xs">Brand</span>
                <p class="text-lg font-bold text-black truncate block capitalize">Product Name</p>
            </div>
        </a>
    </div>
    <!-- Product card 3 Ends-->
</section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>
