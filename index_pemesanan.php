<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="styles.css">
</head>
<body class="bg-gray-100">

<?php
include 'database.php';
?>

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

<main class="container mx-auto px-4 py-8">
    <form action="process_form.php" method="POST" class="bg-white p-6 rounded-lg shadow">
      <div class="flex justify-between mb-4 px-12">
        <button type="button" class="bg-blue-600 text-white py-2 px-10 rounded">Pemilihan</button>
        <button type="button" class="bg-blue-600 text-white py-2 px-10 rounded">Pemesanan</button>
        <button type="button" class="bg-blue-600 text-white py-2 px-10 rounded">Pembayaran</button>
      </div>

      <div class="bg-gray-200 p-4 rounded-lg mb-4">
        <h2 class="text-xl font-bold mb-2">Informasi Kontak</h2>
        <div class="space-y-2">
          <div>
            <label class="block" for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" class="w-full p-2 rounded border border-gray-300" required>
          </div>
          <div>
            <label class="block" for="handphone">Handphone:</label>
            <input type="text" id="handphone" name="handphone" class="w-full p-2 rounded border border-gray-300" required>
          </div>
          <div>
            <label class="block" for="email">Email:</label>
            <input type="email" id="email" name="email" class="w-full p-2 rounded border border-gray-300" required>
          </div>
        </div>
      </div>

      <div class="bg-gray-200 p-4 rounded-lg mb-4">
        <h2 class="text-xl font-bold mb-2">Detail Penjemputan</h2>
        <div class="space-y-2">
          <div>
            <label class="block" for="tempat">Tempat:</label>
            <select id="tempat" name="tempat" class="w-full p-2 rounded border border-gray-300" required>
              <option value="bandara">Bandara</option>
              <option value="stasiun">Stasiun</option>
              <option value="ngamobil">Ngamobil</option>
            </select>
          </div>
          <div>
            <label class="block" for="jam_penjemputan">Jam Penjemputan:</label>
            <select id="jam_penjemputan" name="jam_penjemputan" class="w-full p-2 rounded border border-gray-300" required>
              <!-- Generating options for every hour between 06:00 and 21:00 WITA -->
              <?php
              for ($i = 6; $i <= 21; $i++) {
                  $time = str_pad($i, 2, '0', STR_PAD_LEFT) . ':00';
                  echo "<option value='$time'>$time WITA</option>";
              }
              ?>
            </select>
          </div>
          <div>
            <label class="block" for="tanggal_penjemputan">Tanggal Penjemputan:</label>
            <input type="date" id="tanggal_penjemputan" name="tanggal_penjemputan" class="w-full p-2 rounded border border-gray-300" required>
          </div>
          <div>
            <label class="block" for="keterangan">Keterangan Tambahan:</label>
            <textarea id="keterangan" name="keterangan" class="w-full p-2 rounded border border-gray-300"></textarea>
          </div>
        </div>
      </div>

      <div class="bg-gray-200 p-4 rounded-lg mb-4">
        <h2 class="text-xl font-bold mb-2">Detail Pemesanan</h2>
        <div class="flex space-x-4">
          <img src="src/agya.jpeg" alt="Toyota Agya" class="w-1/3">
          <div class="w-2/3 space-y-2">
            <div>
                <label class="block" for="tanggal_pengembalian">Tanggal Pengembalian:</label>
                <input type="date" id="tanggal_pengembalian" name="tanggal_pengembalian" class="w-full p-2 rounded border border-gray-300" required>
              </div>
            <div>
              <label class="block" for="harga">Harga:</label>
              <input type="text" id="harga" name="harga" class="w-full p-2 rounded border border-gray-300" required>
            </div>
            <div>
              <label class="block" for="catatan">Catatan:</label>
              <textarea id="catatan" name="catatan" class="w-full p-2 rounded border border-gray-300"></textarea>
            </div>
          </div>
        </div>
      </div>

      <div class="text-right">
        <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded">Pesan Sekarang</button>
      </div>
    </form>
</main>

<footer class="bg-blue-900 text-white py-8 mt-8">
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
<script src="index.js"></script>
</body>
</html>
