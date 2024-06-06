<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Activity Log</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body class="flex flex-col">
    <header class="flex items-center justify-between p-1 bg-white shadow-md">
        <div class="flex items-center space-x-1">
            <img src="../src/logo-ngamobil.jpg" alt="logo-website" class="h-16 w-20">
            <p class="text-xl font-bold">Ngamobil.</p>
        </div>
        <nav>
            <div class="hidden md:flex space-x-4 pr-8">
                <a href="../pages/index_pemilihan.php" class="rounded-md text-black hover:text-gray-500 p-2">Home</a>
                <a href="../pages/index_aktivitas_log.php" class="rounded-md text-black hover:text-gray-500 p-2">Log</a>
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

    <div class="container mx-auto mt-8">
        <h2 class="text-2xl font-bold mb-6 text-center">Log Aktivitas</h2>
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Nama Mobil</th>
                        <th class="py-2 px-4 border-b">Waktu Peminjaman</th>
                        <th class="py-2 px-4 border-b">Waktu Pengembalian</th>
                        <th class="py-2 px-4 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Start the session
                    session_start();

                    // Check if the user_id is set in the session
                    if (isset($_SESSION['user_id'])) {
                        $user_id = $_SESSION['user_id'];

                        // Connect to the database
                        $conn = new mysqli('localhost', 'root', 'mysql', 'ngamobil');

                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // Fetch pemesanan data for the user
                        $sql = "SELECT kendaraan.model AS nama_mobil, 
                            pemesanan.waktu_awal AS waktu_peminjaman, 
                            pemesanan.waktu_akhir AS waktu_pengembalian,
                            pemesanan.ID_pemesanan,
                            pemesanan.ID_kendaraan AS car_id
                            FROM pemesanan
                            JOIN kendaraan ON pemesanan.ID_kendaraan = kendaraan.ID_kendaraan
                            WHERE pemesanan.ID_penyewa = ?";

                        $stmt = $conn->prepare($sql);
                        if (!$stmt) {
                            die("Error in preparing statement: " . $conn->error);
                        }

                        $stmt->bind_param("i", $user_id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        // Check if there are any records
                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td class='py-2 px-4 border-b'>" . htmlspecialchars($row['nama_mobil']) . "</td>";
                                echo "<td class='py-2 px-4 border-b'>" . htmlspecialchars($row['waktu_peminjaman']) . "</td>";
                                echo "<td class='py-2 px-4 border-b'>" . htmlspecialchars($row['waktu_pengembalian']) . "</td>";
                                echo "<td class='py-2 px-4 border-b flex space-x-2'>";
                                echo "<form action='../php/process_form_delete.php' method='post'>";
                                echo "<input type='hidden' name='ID_pemesanan' value='" . htmlspecialchars($row['ID_pemesanan']) . "'>";
                                echo "<button type='submit' class='bg-red-500 text-white px-4 py-2 rounded-lg' onclick='return confirm(\"Are you sure you want to delete this entry?\")'>Delete</button>";
                                echo "</form>";
                                echo "<form action='../php/process_form_update.php' method='post'>";
                                echo "<input type='hidden' name='ID_pemesanan' value='" . htmlspecialchars($row['ID_pemesanan']) . "'>";
                                echo "<button type='submit' class='bg-green-500 text-white px-4 py-2 rounded-lg' onclick='return confirm(\"Are you sure you want to extend this booking?\")'>Perpanjang</button>";
                                echo "</form>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4' class='py-2 px-4 border-b text-center'>No records found</td></tr>";
                        }

                        // Close the connection
                        $stmt->close();
                        $conn->close();
                    } else {
                        echo "<tr><td colspan='4' class='py-2 px-4 border-b text-center'>Please log in to view your activity log.</td></tr>";
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
    <footer class="bg-blue-900 text-white py-8">
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