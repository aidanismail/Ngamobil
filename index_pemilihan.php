<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: index_login.php");
    exit();
}

// User is logged in, access session data
$user_id = $_SESSION['user_id'];
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];
$email = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="styles.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
  <title>3x3 Card Grid</title>
</head>
<body>

  <!-- Header / Nav -->
  <header class="flex items-center justify-between p-1 bg-white shadow-md">
    <div class="flex items-center space-x-1">
      <img src="images/logo-ngamobil.jpg" alt="logo-website" class="h-16 w-20">
      <p class="text-xl font-bold">Ngamobil.</p>
    </div>
    <nav>
      <div class="hidden md:flex space-x-4 pr-8">
        <a href="#" class="rounded-md text-black hover:text-gray-500 p-2">Home</a>
        <a href="log.php" class="rounded-md text-black hover:text-gray-500 p-2">Log Aktivitas</a>
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
  <!--/Header / nav-->

  <main>
    <h1 class="text-4xl text-center my-8 font-bold">Pilih Teman Anda Untuk Hari Ini</h1>
    <p class="text-center text-gray-700">Welcome, <?php echo htmlspecialchars($first_name); ?> <?php echo htmlspecialchars($last_name); ?>!</p>
    
    <div class="filters">
      <a href="#toyota"><button class="filter-btn">Toyota</button></a>
      <a href="#honda"><button class="filter-btn">Honda</button></a>
      <a href="#nissan"><button class="filter-btn">Nissan</button></a>
    </div>
    
<!-- Toyota Section -->
<h2 id="toyota" class="text-4xl text-center my-8 font-bold text-gray-500">Toyota</h2>
<div class="container mx-auto px-4 py-8">
  <div class="flex justify-center">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl">
      <!-- Card for Toyota GT-86 -->
      <div class="card bg-white rounded-lg shadow-lg overflow-hidden flex flex-col">
        <div class="card-header p-4 bg-gray-100 text-center font-bold">Toyota GT-86</div>
        <img src="images/GT-86.png" alt="Toyota GT-86" class="object-cover h-48 w-full">
        <div class="card-content p-4">
          <p class="text-lg font-semibold">Rp 1.500.000</p>
          <p class="details">2016 | 15k | auto | Pertamax</p>
          <a href="index_pemesanan.php?car_id=1" class="mt-4 bg-blue-800 text-white text-center p-2 cursor-pointer block"> Rental </a>
        </div>
      </div>
      <!-- Card for Toyota Avanza -->
      <div class="card bg-white rounded-lg shadow-lg overflow-hidden flex flex-col">
        <div class="card-header p-4 bg-gray-100 text-center font-bold">Toyota Avanza</div>
        <img src="images/Avanza.png" alt="Toyota Avanza" class="w-full h-48 object-cover">
        <div class="card-content p-4">
          <p class="text-lg font-semibold">Rp 500.000</p>
          <p>2016 | 15k | auto | Pertalite</p>
          <a href="index_pemesanan.php?car_id=2" class="mt-4 bg-blue-800 text-white text-center p-2 cursor-pointer block"> Rental </a>
        </div>
      </div>
      <!-- Card for Toyota Agya -->
      <div class="card bg-white rounded-lg shadow-lg overflow-hidden flex flex-col">
        <div class="card-header p-4 bg-gray-100 text-center font-bold">Toyota Agya</div>
        <img src="images/Agya.png" alt="Toyota Agya" class="w-full h-48 object-cover">
        <div class="card-content p-4">
          <p class="text-lg font-semibold">Rp 300.000</p>
          <p>2023 | 15k | auto | Pertalite</p>
          <a href="index_pemesanan.php?car_id=3" class="mt-4 bg-blue-800 text-white text-center p-2 cursor-pointer block"> Rental </a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Honda Section -->
<h2 id="honda" class="text-4xl text-center my-8 font-bold text-gray-500">Honda</h2>
<div class="container mx-auto px-4 py-8">
  <div class="flex justify-center">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl">
      <!-- Card for Honda Beat -->
      <div class="card bg-white rounded-lg shadow-lg overflow-hidden flex flex-col">
        <div class="card-header p-4 bg-gray-100 text-center font-bold">Honda Beat</div>
        <img src="images/Beat.png" alt="Honda Beat" class="w-full h-48 object-cover">
        <div class="card-content p-4">
          <p class="text-lg font-semibold">Rp 1.000.000</p>
          <p>2004 | 15k | auto | Pertalite</p>
          <a href="index_pemesanan.php?car_id=4" class="mt-4 bg-blue-800 text-white text-center p-2 cursor-pointer block"> Rental </a>
        </div>
      </div>
      <!-- Card for Honda HR-V -->
      <div class="card bg-white rounded-lg shadow-lg overflow-hidden flex flex-col">
        <div class="card-header p-4 bg-gray-100 text-center font-bold">Honda HR-V</div>
        <img src="images/HR-V.png" alt="Honda HR-V" class="w-full h-48 object-cover">
        <div class="card-content p-4">
          <p class="text-lg font-semibold">Rp 700.000</p>
          <p>2023 | 15k | auto | Pertamax</p>
          <a href="index_pemesanan.php?car_id=5" class="mt-4 bg-blue-800 text-white text-center p-2 cursor-pointer block"> Rental </a>
        </div>
      </div>
      <!-- Card for Honda Brio -->
      <div class="card bg-white rounded-lg shadow-lg overflow-hidden flex flex-col">
        <div class="card-header p-4 bg-gray-100 text-center font-bold">Honda Brio</div>
        <img src="images/Brio.png" alt="Honda Brio" class="w-full h-48 object-cover">
        <div class="card-content p-4">
          <p class="text-lg font-semibold">Rp 300.000</p>
          <p>2016 | 15k | auto | Pertalite</p>
          <a href="index_pemesanan.php?car_id=6" class="mt-4 bg-blue-800 text-white text-center p-2 cursor-pointer block"> Rental </a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Nissan Section -->
<h2 id="nissan" class="text-4xl text-center my-8 font-bold text-gray-500">Nissan</h2>
<div class="container mx-auto px-4 py-8">
  <div class="flex justify-center">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl">
      <!-- Card for Nissan Magnite -->
      <div class="card bg-white rounded-lg shadow-lg overflow-hidden flex flex-col">
        <div class="card-header p-4 bg-gray-100 text-center font-bold">Nissan Magnite</div>
        <img src="images/Magnite.png" alt="Nissan Magnite" class="w-full h-48 object-cover">
        <div class="card-content p-4">
          <p class="text-lg font-semibold">Rp 500.000</p>
          <p>2018 | 20k | manual | Pertamax</p>
          <a href="index_pemesanan.php?car_id=7" class="mt-4 bg-blue-800 text-white text-center p-2 cursor-pointer block"> Rental </a>
        </div>
      </div>
      <!-- Card for Nissan Grand Livina -->
      <div class="card bg-white rounded-lg shadow-lg overflow-hidden flex flex-col">
        <div class="card-header p-4 bg-gray-100 text-center font-bold">Nissan Grand Livina</div>
        <img src="images/GrandLivina.png" alt="Nissan Grand Livina" class="w-full h-48 object-cover">
        <div class="card-content p-4">
          <p class="text-lg font-semibold">Rp 300.000</p>
          <p>2017 | 18k | auto | Pertalite</p>
          <a href="index_pemesanan.php?car_id=8" class="mt-4 bg-blue-800 text-white text-center p-2 cursor-pointer block"> Rental </a>
        </div>
      </div>
      <!-- Card for Nissan Terra -->
      <div class="card bg-white rounded-lg shadow-lg overflow-hidden flex flex-col">
        <div class="card-header p-4 bg-gray-100 text-center font-bold">Nissan Terra</div>
        <img src="images/download.png" alt="Nissan Terra" class="w-full h-48 object-cover">
        <div class="card-content p-4">
          <p class="text-lg font-semibold">Rp 1.000.000</p>
          <p>2020 | 10k | auto | Pertamax</p>
         <!-- Using <a> tag styled as a button -->
          <a href="index_pemesanan.php?car_id=9" class="mt-4 bg-blue-800 text-white text-center p-2 cursor-pointer block"> Rental </a>
        </div>
      </div>
    </div>
  </div>
</div>
    

  <!--footer-->
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
  <!--/footer-->
  <script src="file.js"></script>
</body>
</html>
