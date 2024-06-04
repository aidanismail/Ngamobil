<?php
session_start();
?>

<?php

// Database configuration
$db_host = 'localhost'; // replace with your database host
$db_user = 'root'; // replace with your database user
$db_password = 'mysql'; // replace with your database password
$db_name = 'ngamobil'; // replace with your database name
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);
include 'database.php';

// Enable error reporting and display
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all form fields are set and not empty
    if(isset($_SESSION['nama']) && isset($_SESSION['handphone']) && isset($_SESSION['email']) && isset($_POST['tempat']) && isset($_POST['jam_penjemputan'])&& isset($_POST['tanggal_penjemputan']) && isset($_POST['keterangan']) && isset($_POST['tanggal_pengembalian'])&& isset($_POST['harga']) && isset($_POST['catatan']) && isset($_GET['car_id'])) {
        echo "All form fields are set and not empty.<br>";

            $car_id = $_GET['car_id']; // this is from the url

            // Retrieve form data
            $tempat = $_POST['tempat'];
            $jam_penjemputan = $_POST['jam_penjemputan'];
            $tanggal_penjemputan = $_POST['tanggal_penjemputan'];
            $keterangan = $_POST['keterangan'];
            $tanggal_pengembalian = $_POST['tanggal_pengembalian'];
            $catatan = $_POST['catatan'];
        
            $jam_penjemputan = str_replace(' WITA', ':00', $jam_penjemputan);

        // Retrieve the user ID from the session
        $user_id = $_SESSION['user_id'];
        $nama = $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];
        $handphone = $_SESSION['nomor_telepon'];
        $email = $_SESSION['email'];

        $sql = "SELECT harga FROM cars WHERE id = ?";

        // Prepare the statement
        if ($stmt = $conn->prepare($sql)) {
            // Bind the 'car_id' to the statement
            $stmt->bind_param("i", $car_id);

            // Execute the statement
            $stmt->execute();

            // Bind the result to a variable
            $stmt->bind_result($harga);

            // Fetch the result
            if ($stmt->fetch()) {
                // Now you have the 'harga' associated with the 'car_id'
                // You can use $harga in your code
            }

            // Close the statement
            $stmt->close();
        }

        // Close the connection
        $conn->close();
    }
        if (isset($car_id) && is_numeric($car_id)) {
            echo "Car ID is valid.<br>";

            // Prepare and execute the SQL query to insert data into the database
            $sql = "INSERT INTO Pemesanan (waktu_awal, waktu_akhir, lokasi_pengantaran, jam_penjemputan, keterangan, catatan, ID_kendaraan, ID_penyewa) 
                    VALUES (:waktu_awal, :waktu_akhir, :lokasi_pengantaran, :jam_penjemputan, :keterangan, :catatan, :ID_kendaraan, :ID_penyewa)";
            $stmt = $pdo->prepare($sql);
            if (!$stmt) {
                echo "\nPDO::errorInfo():\n";
                print_r($pdo->errorInfo());
                exit;
            }
            $result = $stmt->execute([
                'waktu_awal' => $tanggal_penjemputan,
                'waktu_akhir' => $tanggal_pengembalian,
                'harga' => $harga,
                'lokasi_pengantaran' => $tempat,
                'jam_penjemputan' => $jam_penjemputan,
                'keterangan' => $keterangan,
                'catatan' => $catatan,
                'ID_kendaraan' => $car_id, // Use the retrieved car ID here
                'ID_penyewa' => $user_id, // Use the retrieved user ID here
            ]);

            // Check for errors in execution
            if (!$result) {
                echo "\nPDOStatement::errorInfo():\n";
                print_r($stmt->errorInfo());
                exit;
            }

            // Redirect to another page on success
            header("Location: index_pembayaran.php");
            exit;
        } else {
            echo "Error: Invalid car ID.";
        }
    } else {
        echo "Error: All form fields are required.";
    }
?>
