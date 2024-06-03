<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Login Page</title>
  <style>
    .background-image {
        background-image: url('images/bg.png'); /* Path to your background image */
        background-size: cover;
        background-position: center;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0.5; /* Set the opacity to 50% */
        z-index: -1; /* Place it behind other elements */
    }
  </style>
</head>
<body class="relative">
  <header class="flex items-center justify-between p-1 bg-white shadow-md">
    <div class="flex items-center space-x-1">
        <img src="src/logo.png" alt="logo-website" class="h-16 w-20">
        <p class="text-xl font-bold">Ngamobil.</p>
    </div>
    <nav>
        <div class="hidden md:flex space-x-4 pr-8">
            <a href="#" class="rounded-md text-black hover:text-gray-500 p-2">Home</a>
            <a href="#" class="rounded-md text-black hover:text-gray-500 p-2">Contact</a>
        </div>
        <div class="md:hidden">
            <button id="menu-btn" class="text-gray-700 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </nav>
  </header>
  <div class="background-image"></div>
  <div class="flex items-center justify-center h-screen">
      <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
          <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
          <form id="login-form" action="process_form_login.php" method="POST">
              <div class="mb-4">
                  <label for="email" class="block text-gray-700">Email</label>
                  <input type="email" id="email" name="email" class="mt-1 p-2 w-full border rounded-lg" required>
              </div>
              <div class="mb-6">
                  <label for="password" class="block text-gray-700">Password</label>
                  <input type="password" id="password" name="password" class="mt-1 p-2 w-full border rounded-lg" required>
              </div>
              <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-lg">Login</button>
          </form>
          <div class="mt-4 text-center">
              <a href="index_register.html" class="w-full inline-block bg-gray-500 text-white p-2 rounded-lg">Register</a>
          </div>
      </div>
  </div>
  <footer class="bg-blue-900 text-white p-8 mt-8">
    <div class="container mx-auto px-4">
      <div class="flex justify-between">
        <div>
          <h3 class="font-bold">Reservation</h3>
          <ul class="space-y-2">
            <li><a href="#" class="hover:underline">Car Hire</a></li>
            <li><a href="#" class="hover:underline">Modify Or Cancel</a></li>
            <li><a href="#" class="hover:underline">Get A Receipt</a></li>
          </ul>
        </div>
        <div>
          <h3 class="font-bold">Customer Services</h3>
          <ul class="space-y-2">
            <li><a href="#" class="hover:underline">Help / FAQS</a></li>
            <li><a href="#" class="hover:underline">Press</a></li>
            <li><a href="#" class="hover:underline">Blog</a></li>
            <li><a href="#" class="hover:underline">Contact Us</a></li>
          </ul>
        </div>
        <div>
          <h3 class="font-bold">Company</h3>
          <ul class="space-y-2">
            <li><a href="#" class="hover:underline">About Us</a></li>
            <li><a href="#" class="hover:underline">Career</a></li>
            <li><a href="#" class="hover:underline">Report & Governance</a></li>
          </ul>
        </div>
      </div>
      <div class="flex justify-between items-center mt-4">
        <div>&copy; 2024 NGAMOBIL</div>
        <div class="flex space-x-4">
          <a href="#" class="hover:underline">Twitter</a>
          <a href="#" class="hover:underline">Facebook</a>
          <a href="#" class="hover:underline">Instagram</a>
        </div>
      </div>
    </div>
  </footer>
</body>
</html>
