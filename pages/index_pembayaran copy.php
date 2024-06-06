<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="./index.js"></script>
  <title>Ngamobil</title>
</head>
<body class="bg-gray-100">

  <?php 
  session_start(); // Ensure session is started
  include 'database.php'; 
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
include 'database.php'; 

if(isset($_GET['id_pemesanan'])) {
  $id_pemesanan = $_GET['id_pemesanan'];
  
  // Fetch details from pemesanan table
  $sql = "SELECT * FROM pemesanan WHERE ID_pemesanan = ?";
  $stmt = $conn->prepare($sql);
  
  if($stmt) {
      // Bind the parameter
      $stmt->bind_param("i", $id_pemesanan);
      
      // Execute the statement
      $stmt->execute();
      
      // Store the result
      $result = $stmt->get_result();
      
      // Check if query executed successfully
      if($result->num_rows > 0) {
          $pemesanan_details = $result->fetch_assoc();
      } else {
          // If no data found, assign default values
          $pemesanan_details = [
              'ID_Pemesanan' => 'Unknown',
              'Waktu_Rental' => 'Unknown',
              'Harga' => 'Unknown',
              'Catatan' => 'Unknown',
          ];
      }
      
      // Close the statement
      $stmt->close();
  } else {
      echo "Error preparing statement: " . $conn->error;
  }
}

// Check if the ID_pemesanan parameter is set in the URL
if(isset($_GET['id_pemesanan'])) {
    $id_pemesanan = $_GET['id_pemesanan'];
    
    // Fetch additional details from database
    $sql = "SELECT sk.warna, sk.jenis_bbm, sk.transmisi, sk.jumlah_kursi, sk.tahun
            FROM spesifikasi_kendaraan sk
            INNER JOIN kendaraan k ON sk.id_kendaraan = k.ID_kendaraan
            INNER JOIN pemesanan p ON k.ID_kendaraan = p.ID_kendaraan
            WHERE p.ID_pemesanan = ?";
    $stmt = $conn->prepare($sql);
    
    if($stmt) {
        // Bind the parameter
        $stmt->bind_param("i", $id_pemesanan);
        
        // Execute the statement
        $stmt->execute();
        
        // Store the result
        $result = $stmt->get_result();
        
        // Check if query executed successfully
        if($result->num_rows > 0) {
            $car_details = $result->fetch_assoc();
        } else {
            // If no data found, assign default values
            $car_details = [
                'warna' => 'Unknown',
                'jenis_bbm' => 'Unknown',
                'transmisi' => 'Unknown',
                'jumlah_kursi' => 'Unknown',
                'tahun' => 'Unknown',
            ];
        }
        
        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
  }
?>

  <header class="flex items-center justify-between p-1 bg-white shadow-md">
    <div class="flex items-center space-x-1">
      <img src="images/logo-ngamobil.jpg" alt="logo-website" class="h-16 w-20">
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
  <div id="mobile-menu" class="menu-closed md:hidden">
    <a href="#" class="block px-4 py-2 text-gray-700">Home</a>
    <a href="#" class="block px-4 py-2 text-gray-700">Contact</a>
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
          <img src="./src/contoh-mobil.png" alt="contoh-mobil" class="w-full md:w-96 h-auto">
          <div class="flex flex-col justify-center text-center md:text-left">
          <h2 class="text-xl font-bold mb-2"><?php echo htmlspecialchars($car_details['jenis_mobil']); ?></h2>
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
            <li class="py-2">ID_Pemesanan: <?php echo htmlspecialchars($pemesanan_details['ID_Pemesanan']); ?></li>
            <li class="py-2">Waktu Rental: <?php echo htmlspecialchars($pemesanan_details['Waktu_Rental']); ?></li>
            <li class="py-2">Harga: Rp <?php echo htmlspecialchars($pemesanan_details['Harga']); ?>/hari</li>
            <li class="py-2">Catatan: <?php echo htmlspecialchars($pemesanan_details['Catatan']); ?></li>
        </ul>

        </div>
      </div>
    </div>
  </div>

  <div id="metode-pembayaran" class="m-16 bg-gray-300 p-4">
    <h1 class="text-xl font-bold mb-4">METODE PEMBAYARAN</h1>
    <div class="m-4 bg-white p-6">
      <form class="flex flex-col space-y-4" action="process_form_pembayaran.php" method="POST">
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
        <button type="submit" class="bg-blue-900 text-white px-4 py-2 rounded">BAYAR</button>
      </form>
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
            <p>Rp 1350000</p>
            <p>Rp 1000</p>
            <p>-</p>
            <p class="font-bold">Rp 1351000</p>
          </div>
        </div>
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

  <?php $conn->close(); ?>
</body>
</html>