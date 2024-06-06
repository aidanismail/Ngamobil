<?php
session_start();

// Database configuration
$db_host = 'localhost';
$db_user = 'root';
$db_password = 'mysql';
$db_name = 'ngamobil';

// Create connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Enable error reporting and display
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all form fields are set and not empty
    if (
        isset($_SESSION['first_name']) && isset($_SESSION['last_name']) && isset($_SESSION['nomor_telepon']) &&
        isset($_SESSION['email']) && isset($_POST['tempat']) && isset($_POST['jam_penjemputan']) &&
        isset($_POST['tanggal_penjemputan']) && isset($_POST['keterangan']) && isset($_POST['tanggal_pengembalian']) &&
        isset($_POST['catatan']) && isset($_GET['car_id'])
    ) {
        // Retrieve form data
        $tempat = $_POST['tempat'];
        $jam_penjemputan = $_POST['jam_penjemputan'];
        $tanggal_penjemputan = $_POST['tanggal_penjemputan'];
        $keterangan = $_POST['keterangan'];
        $tanggal_pengembalian = $_POST['tanggal_pengembalian'];
        $catatan = $_POST['catatan'];
        $car_id = $_GET['car_id'];

        // Retrieve the user data from the session
        $user_id = $_SESSION['user_id'];
        $nama = $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];
        $handphone = $_SESSION['nomor_telepon'];
        $email = $_SESSION['email'];

        // Retrieve harga from the database using prepared statement
        $sql = "SELECT harga FROM Kendaraan WHERE ID_kendaraan = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Error preparing statement: " . $conn->error);
        }

        $stmt->bind_param("i", $car_id);
        $stmt->execute();
        $stmt->bind_result($harga);

        // Fetch the result
        if ($stmt->fetch()) {
            // Now you have the 'harga' associated with the 'car_id'
            // You can use $harga in your code
        } else {
            echo "Error fetching harga.";
            exit;
        }
        // Close the statement
        $stmt->close();

        // Calculate the duration in days
        $datetime1 = new DateTime($tanggal_penjemputan);
        $datetime2 = new DateTime($tanggal_pengembalian);
        $interval = $datetime1->diff($datetime2);
        $duration_days = $interval->days;

        // Calculate the total cost
        $total_cost = $harga * $duration_days;

        // Prepare and execute the SQL query to insert data into the database
        $sql = "INSERT INTO Pemesanan (waktu_awal, waktu_akhir, lokasi_pengantaran, jam_penjemputan, keterangan, catatan, ID_kendaraan, ID_penyewa, harga) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Error preparing statement: " . $conn->error);
        }

        $stmt->bind_param("ssssssiii", $tanggal_penjemputan, $tanggal_pengembalian, $tempat, $jam_penjemputan, $keterangan, $catatan, $car_id, $user_id, $total_cost);
        $stmt->execute();

        // Check for errors in execution
        if ($stmt->errno) {
            echo "Error executing statement: " . $stmt->error;
            exit;
        }

        // Get the ID_pemesanan of the newly inserted row
        $id_pemesanan = $stmt->insert_id;

        // Close the statement
        $stmt->close();

        // Redirect to another page on success with the ID_pemesanan appended as a query parameter
        header("Location: ../pages/index_pembayaran.php?id_pemesanan=" . $id_pemesanan);
        exit;
    } else {
        echo "Error: All form fields are required.";
    }
} else {
    echo "Error: Invalid request method.";
}

// Close the connection
$conn->close();
