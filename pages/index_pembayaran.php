<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="./index.js"></script>
  <title>Pembayaran</title>
</head>

<body class="bg-gray-100">

  <?php
  session_start(); // Ensure session is started
  include '../php/database.php';
  ?>
  <?php
  // database.php
  $db_host = 'localhost';
  $db_user = 'root';
  $db_password = 'mysql';
  $db_name = 'ngamobil';

  $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  ?>


  <?php
  // Include database configuration
  include '../php/database.php';

  // Check if the ID_pemesanan parameter is set in the URL
  if (isset($_GET['id_pemesanan'])) {
    $id_pemesanan = $_GET['id_pemesanan'];

    // Fetch details from pemesanan table
    $sql = "SELECT ID_pemesanan, waktu_awal, waktu_akhir, harga, lokasi_pengantaran,
          jam_penjemputan, ID_kendaraan, ID_penyewa, keterangan, catatan
          FROM pemesanan
          WHERE ID_pemesanan = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
      $stmt->bind_param("i", $id_pemesanan);
      $stmt->execute();
      $result = $stmt->get_result();

      $pemesanan_details = $result->fetch_assoc();

      $stmt->close();
    } else {
      echo "Error preparing statement: " . $conn->error;
    }

    // Fetch additional details from database
    $sql = "SELECT sk.warna, sk.jenis_bbm, sk.transmisi, sk.jumlah_kursi, sk.tahun
          FROM spesifikasi_kendaraan sk
          INNER JOIN kendaraan k ON sk.id_kendaraan = k.ID_kendaraan
          INNER JOIN pemesanan p ON k.ID_kendaraan = p.ID_kendaraan
          WHERE p.ID_pemesanan = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
      $stmt->bind_param("i", $id_pemesanan);
      $stmt->execute();
      $result = $stmt->get_result();

      $car_details = $result->fetch_assoc();

      $waktu_awal = new DateTime($pemesanan_details['waktu_awal']);
      $waktu_akhir = new DateTime($pemesanan_details['waktu_akhir']);
      $waktu_rental = $waktu_awal->diff($waktu_akhir)->days;

      $stmt->close();
    } else {
      echo "Error preparing statement: " . $conn->error;
    }
  }

  // Initialize $jenis_mobil variable
  $jenis_mobil = 'Unknown';

  // Create a new SQL query to fetch jenis_mobil
  $sql_jenis_mobil = "SELECT k.jenis_mobil
                        FROM kendaraan k
                        INNER JOIN pemesanan p ON k.ID_kendaraan = p.ID_kendaraan
                        WHERE p.ID_pemesanan = ?";
  $stmt_jenis_mobil = $conn->prepare($sql_jenis_mobil);

  if ($stmt_jenis_mobil) {
    $stmt_jenis_mobil->bind_param("i", $id_pemesanan);
    $stmt_jenis_mobil->execute();
    $result_jenis_mobil = $stmt_jenis_mobil->get_result();

    // Fetch jenis_mobil
    if ($result_jenis_mobil->num_rows > 0) {
      $row_jenis_mobil = $result_jenis_mobil->fetch_assoc();
      $jenis_mobil = $row_jenis_mobil['jenis_mobil'];
    } else {
      // Handle if no jenis_mobil found
      $jenis_mobil = 'Unknown';
    }

    $stmt_jenis_mobil->close();
  } else {
    // Handle error preparing statement
    echo "Error preparing statement: " . $conn->error;
  }
  ?>
  <?php
  // Include database configuration
  include '../php/database.php';

  // Check if the ID_pemesanan parameter is set in the URL
  if (isset($_GET['id_pemesanan'])) {
    $id_pemesanan = $_GET['id_pemesanan'];

    // Fetch details from pemesanan table
    $sql = "SELECT ID_kendaraan FROM pemesanan WHERE ID_pemesanan = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
      $stmt->bind_param("i", $id_pemesanan);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_kendaraan = $row['ID_kendaraan'];
      } else {
        // Handle if no rows are found
        echo "No rows found for ID_pemesanan: " . $id_pemesanan;
      }

      $stmt->close();
    } else {
      echo "Error preparing statement: " . $conn->error;
    }
  } else {
    // Handle if ID_pemesanan parameter is not set
    echo "ID_pemesanan parameter is not set.";
  }

  // Define an array mapping id_kendaraan to the corresponding image file
  $kendaraan_images = array(
    1 => "../src/GT-86.png",
    2 => "../src/Avanza.png",
    3 => "../src/Agya.png",
    4 => "../src/Beat.png",
    5 => "../src/HR-V.png",
    6 => "../src/Brio.png",
    7 => "../src/Magnite.png",
    8 => "../src/GrandLivina.png",
    9 => "../src/terra.png"
  );

  // Check if the id_kendaraan exists in the mapping array
  if (array_key_exists($id_kendaraan, $kendaraan_images)) {
    // If it exists, use the corresponding image file
    $image_src = $kendaraan_images[$id_kendaraan];
  } else {
    // If it doesn't exist, use a default image or handle it as needed
    $image_src = ""; // Change "default.png" to the path of your default image
  }
  ?>

  <header class="flex items-center justify-between p-1 bg-white shadow-md">
    <div class="flex items-center space-x-1">
      <img src="../src/logo-ngamobil.jpg" alt="logo-website" class="h-16 w-20">
      <p class="text-xl font-bold">Ngamobil.</p>
    </div>

    <nav>
      <div class="hidden md:flex space-x-4 pr-8">
        <a href="../pages/index_pemilihan.php" class="rounded-md text-black hover:text-gray-500 p-2">Home</a>
        <a href="../pages/" class="rounded-md text-black hover:text-gray-500 p-2">Log</a>
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
  <div id="mobile-menu" class="menu-closed md:hidden">
    <a href="#" class="block px-4 py-2 text-gray-700">Home</a>
    <a href="#" class="block px-4 py-2 text-gray-700">Contact</a>
  </div>

  <div class="flex justify-between items-center my-8 space-x-4">
    <div class="flex-1 text-center">
      <div class="w-10 h-10 bg-blue-900 text-white rounded-full mx-auto flex items-center justify-center">
        1
      </div>
      <div class="mt-2 text-black">Pemilihan</div>
    </div>
    <div class="flex-1 border-t-4 border-blue-900"></div>
    <div class="flex-1 text-center">
      <div class="w-10 h-10 bg-blue-900 text-white rounded-full mx-auto flex items-center justify-center">
        2
      </div>
      <div class="mt-2 text-black">Pemesanan</div>
    </div>
    <div class="flex-1 border-t-4 border-blue-900"></div>
    <div class="flex-1 text-center">
      <div class="w-10 h-10 bg-blue-900 text-white rounded-full mx-auto flex items-center justify-center">
        3
      </div>
      <div class="mt-2 text-black">Pembayaran</div>
    </div>
  </div>

  <div id="detail-pemesanan" class="m-16 bg-gray-300 p-4">
    <h1 class="text-xl font-bold mb-4">DETAIL PEMESANAN</h1>
    <div class="m-4 bg-white p-6">
      <div class="flex flex-col space-y-4">
        <div class="flex flex-col md:flex-row justify-center mx-8 gap-8 md:gap-72">
          <?php
          $sql = "SELECT * FROM kendaraan WHERE id_kendaraan = 1";
          $result = $conn->query($sql);

          if ($result && $result->num_rows > 0) {
            $car = $result->fetch_assoc();
          } else {
            $car = [
              'jenis_mobil' => 'Unknown',
              'warna' => 'Unknown',
              'jenis_bbm' => 'Unknown',
              'transmisi' => 'Unknown',
              'jumlah_kursi' => 'Unknown',
              'tahun' => 'Unknown',
            ];
          }
          ?>
          <img src="<?php echo $image_src; ?>" alt="contoh-mobil" class="w-full md:w-96 h-auto">
          <div class="flex flex-col justify-center text-center md:text-left">
            <h2 class="text-xl font-bold mb-2"><?php echo $jenis_mobil; ?></h2>
            <ul class="list-disc list-inside">
              <li class="py-2">Warna: <?php echo htmlspecialchars($car_details['warna']); ?></li>
              <li class="py-2">Jenis BBM: <?php echo htmlspecialchars($car_details['jenis_bbm']); ?></li>
              <li class="py-2">Transmisi: <?php echo htmlspecialchars($car_details['transmisi']); ?></li>
              <li class="py-2">Jumlah Kursi: <?php echo htmlspecialchars($car_details['jumlah_kursi']); ?></li>
              <li class="py-2">Tahun Produksi: <?php echo htmlspecialchars($car_details['tahun']); ?></li>
            </ul>
          </div>
        </div>
        <div class="py-8">
          <ul class="list-disc list-inside">
            <li class="py-2">ID_Pemesanan: <?php echo htmlspecialchars($pemesanan_details['ID_pemesanan']); ?></li>
            <li class="py-2">Waktu Rental: <?php echo $waktu_rental; ?> hari</li>
            <li class="py-2">Harga: Rp <?php echo htmlspecialchars($pemesanan_details['harga']); ?></li>
            <li class="py-2">Catatan: <?php echo htmlspecialchars($pemesanan_details['catatan']); ?></li>
          </ul>

        </div>
      </div>
    </div>
  </div>

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
            <p>Rp <?php echo ($pemesanan_details['harga']) ?></p>
            <p>Rp -</p>
            <p>Rp -</p>
            <p class="font-bold">Rp <?php echo ($pemesanan_details['harga']) ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div id="metode-pembayaran" class="m-16 bg-gray-300 p-4">
    <h1 class="text-xl font-bold mb-4">METODE PEMBAYARAN</h1>
    <div class="m-4 bg-white p-6">
      <form id="payment-form" class="flex flex-col space-y-4" action="../php/process_form_pembayaran.php" method="POST">
        <label class="flex items-center justify-between cursor-pointer">
          <span class="text-lg font-semibold">Bayar di Tempat</span>
          <input type="radio" name="payment_method" value="bayar-di-tempat" required>
          <img src="./src/checkmark.png" alt="checkmark" class="h-6 w-6 hidden">
        </label>
        <label class="flex items-center justify-between cursor-pointer">
          <span class="text-lg font-semibold">Transfer Bank</span>
          <input type="radio" name="payment_method" value="transfer-bank" required>
          <img src="./src/checkmark.png" alt="checkmark" class="h-6 w-6 hidden">
        </label>
        <label class="flex items-center justify-between cursor-pointer">
          <span class="text-lg font-semibold">Virtual Account</span>
          <input type="radio" name="payment_method" value="virtual-account" required>
          <img src="./src/checkmark.png" alt="checkmark" class="h-6 w-6 hidden">
        </label>
        <input type="hidden" name="car_id" value="<?php echo htmlspecialchars($car['id_kendaraan']); ?>">
        <input type="hidden" name="total_harga" value="1350000"> <!-- Example total price -->
        <button id="bayar-button" type="submit" class="bg-blue-900 text-white px-4 py-2 rounded">BAYAR</button>
      </form>
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

  <?php $conn->close(); ?>


  <script>
    // Get the payment form and bayar button
    const paymentForm = document.getElementById('payment-form');
    const bayarButton = document.getElementById('bayar-button');

    // Add event listener to the payment form
    paymentForm.addEventListener('change', function() {
      // Enable the bayar button if a payment method is selected
      if (document.querySelector('input[name="payment_method"]:checked')) {
        bayarButton.disabled = false;
      } else {
        bayarButton.disabled = true;
      }
    });
  </script>
</body>

</html>