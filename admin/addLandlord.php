<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Add Landlord</title>
</head>
<body>
<?php include("adminNavbar.php"); ?>
<section class="bg-white ">
  <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
      <h2 class="mb-10 text-2xl font-bold text-gray-900">Let's add a new landlord.</h2>
      <form action="addLandlord.php" method="post">
          <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 mt-16">
              <div class="w-full">
                  <label for="lname" class="block mb-2 text-sm font-medium text-gray-900 ">Landlord Name</label>
                  <input type="text" name="lname" id="lname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Name" required="">
              </div>
              <div class="w-full">
                  <label for="lmobile" class="block mb-2 text-sm font-medium text-gray-900 ">Mobile No</label>
                  <input type="text" name="lmobile" id="lmobile" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Mobile" required="">
              </div>
              <div class="sm:col-span-2">
                  <label for="laddress" class="block mb-2 text-sm font-medium text-gray-900">Address</label>
                  <input type="text" name="laddress" id="laddress" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Type address" required="">
              </div>
              <div class="w-full">
                  <label for="lemail" class="block mb-2 text-sm font-medium text-gray-900 ">Landlord Email</label>
                  <input type="text" name="lemail" id="lemail" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Email" required="">
              </div>
              <div class="w-full">
                  <label for="lpassword" class="block mb-2 text-sm font-medium text-gray-900 ">Landlord Password</label>
                  <input type="password" name="lpassword" id="lpassword" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Password" required="">
              </div> 
          </div>
          <div class="flex justify-center">
          <button type="submit" class="self-center border bg-[#084cd4] items-center px-10 py-2.5 mt-6 sm:mt-10 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 hover:bg-primary-800">
              Add Landlord
          </button>
          </div>
      </form>
  </div>
</section>





</body>
</html>