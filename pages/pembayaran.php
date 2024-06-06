<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Tailwind CSS -->
  <link rel="stylesheet" href="/styles/styles.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="/js/index.js"></script>
  <title>Ngamobil</title>
</head>

<body class="bg-gray-100">
  <!-- Header / Nav -->
  <header class="flex items-center justify-between p-1 bg-white shadow-md">
    <div class="flex items-center space-x-1">
      <img src="/Ngamobil/src/logo-ngamobil.jpg" alt="logo-website" class="h-16 w-20">
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
            <path stroke-linecap="round" stroke-linejoin="round" stroke-`width="2" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>
      </div>
    </nav>
  </header>
  <!--/Header / nav-->
  <!--hamburger menu-->
  <div id="mobile-menu" class="menu-closed md:hidden">
    <a href="#" class="block px-4 py-2 text-gray-700">Home</a>
    <a href="#" class="block px-4 py-2 text-gray-700">Contact</a>
  </div>
  <!--/hamburger menu-->

  <!--detail pemesanan-->
  <div id="detail-pemesanan" class="m-16 bg-gray-300 p-4">
    <h1 class="text-xl font-bold mb-4">DETAIL PEMESANAN</h1>
    <div class="m-4 bg-white p-6">
      <div class="flex flex-col space-y-4">
        <div class="flex flex-row justify-center mx-8 gap-72">
          <img src="/Ngamobil/src/contoh-mobil.png" alt="contoh-mobil" class="h-auto w-96">
          <div class="flex flex-col justify-center ">
            <h2 class="text-xl font-bold mb-2">Toyota Agya</h2>
            <ul class="list-disc">
              <li class="py-2">Warna: Putih</li>
              <li class="py-2">Jenis BBM: Bensin</li>
              <li class="py-2">Transmisi: Manual</li>
              <li class="py-2">Jumlah Kursi: 5</li>
              <li class="py-2">Tahun Produksi: 2020</li>
            </ul>
          </div>
        </div>
        <div class="py-8">
          <ul>
            <li class="py-2">ID_Pemesanan: 123456</li>
            <li class="py-2">Waktu Rental: 3 Hari</li>
            <li class="py-2">Harga: Rp 450,000/hari</li>
            <li class="py-2">Catatan: Mohon hubungi 30 menit sebelum pengambilan.</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!--/detail pemesanan-->

  <!--metode pembayaran-->
  <div id="metode-pembayaran" class="m-16 bg-gray-300 p-4">
    <h1 class="text-xl font-bold mb-4">METODE PEMBAYARAN</h1>
    <div class="m-4 bg-white p-6">
      <form class="flex flex-col space-y-4">
        <!-- Bayar di Tempat -->
        <label class="flex items-center justify-between cursor-pointer">
          <span class="text-lg font-semibold">Bayar di Tempat</span>
          <input type="radio" name="payment-method" value="bayar-di-tempat">
          <img src="./src/checkmark.png" alt="checkmark" class="h-6 w-6 hidden">
        </label>
        <!-- Transfer Bank -->
        <label class="flex items-center justify-between cursor-pointer">
          <span class="text-lg font-semibold">Transfer Bank</span>
          <input type="radio" name="payment-method" value="transfer-bank">
          <img src="./src/checkmark.png" alt="checkmark" class="h-6 w-6 hidden">
        </label>
        <!-- Virtual Account -->
        <label class="flex items-center justify-between cursor-pointer">
          <span class="text-lg font-semibold">Virtual Account</span>
          <input type="radio" name="payment-method" value="virtual-account">
          <img src="./src/checkmark.png" alt="checkmark" class="h-6 w-6 hidden">
        </label>
      </form>
    </div>
  </div>
  <!--/metode pembayaran-->

  <!--subtotal-->
  <div class="m-16 bg-gray-300 p-4">
    <h1 class="text-xl font-bold mb-4">SUBTOTAL</h1>
    <div class="m-4 bg-white p-6">
      <div class="flex flex-col space-y-4">
        <div class="flex justify-between">
          <div>
            <p>Biaya Sewa:</p>
            <p>Biaya Admin:</p>
            <p>Biaya Lain-Lain:</p>
            <p class="font-bold">SUBTOTAL</p>
          </div>
          <div class="text-right">
            <p>Rp 450.000</p>
            <p>Rp 1.000</p>
            <p>-</p>
            <p class="font-bold">Rp 451.000</p>
          </div>
        </div>
        <div class="flex justify-center">
          <button class="bg-blue-900 text-white px-4 py-2 rounded">BAYAR</button>
        </div>
      </div>
    </div>
  </div>
  <!--/subtotal-->

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

  <!--script-->
  <script src="/js/index.js"></script>
  <!--/script-->
</body>

</html>