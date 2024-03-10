<?php
if (isset($_GET['email'])) {

  $email = $_GET['email'];
} ?>

<nav class="bg-white border-gray-200 border-b">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto py-2">
    <a href="#" class="flex items-center space-x-2 rtl:space-x-reverse">
      <img
        src="https://images.g2crowd.com/uploads/product/image/large_detail/large_detail_d5f4bf67004e05149f3eac303f46819e/nspace.png"
        class="h-10" alt="Flowbite Logo" />
      <span class="self-center text-2xl font-semibold whitespace-nowrap">NSpace</span>
    </a>
    <button id="toggleNav" type="button"
      class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
      aria-controls="navbar-default" aria-expanded="false">
      <span class="sr-only">Open main menu</span>
      <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M1 1h15M1 7h15M1 13h15" />
      </svg>
    </button>
    <div class="hidden w-full md:block md:w-auto" id="navbar-default">
      <ul
        class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:bg-transparent md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0">
        <li>
          <a href="landlordHome.php?email=<?php echo $email ?>"
            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-2"
            aria-current="page">Home</a>
        </li>
        <li>
          <a href="#"
            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-2">Articles</a>
        </li>
        <li>
          <a href="propertyView.php?email=<?php echo $email ?>"
            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-2">Properties</a>
        </li>
        <li>
          <a href="wardenAccept.php?email=<?php echo $email ?>"
            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-2">Warden
            Accept</a>
        </li>
        <li>
          <a href="./student/stViewProperty.php?email=<?php echo $email ?>"
            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-2">Student</a>
        </li>
        <li>
          <a href="landlordProfile.php?email=<?php echo $email ?>"
            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-2">Profile</a>
        </li>
        <li>
          <a href="#"
            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-2">Contact</a>
        </li>
        <li class="pl-3 pr-3">
          <a href="signin.php"
            class="block text-white rounded hover:bg-gray-100 md:hover:bg-green-800 md:border-0 md:hover:text-white md:p-2 bg-blue-800 p-3">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>