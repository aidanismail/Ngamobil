<?php
session_start();

// Database configuration
$db_host = 'localhost';
$db_user = 'root';
$db_password = 'mysql';
$db_name = 'ngamobil';

// Establish database connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);

}

// Enable error reporting and display
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all form fields are set and not empty
    if ( isset(
        $_SESSION['first_name'],
        $_SESSION['last_name'],
        $_SESSION['handphone'],
        $_SESSION['email'],
        $_POST['tempat'],
        $_POST['jam_penjemputan'],
        $_POST['tanggal_penjemputan'],
        $_POST['keterangan'],
        $_POST['tanggal_pengembalian'],
        $_POST['harga'],
        $_POST['catatan'],
        $_GET['car_id']
    )) {
        
        // Retrieve form data
        $tempat = $_POST['tempat'];
        $jam_penjemputan = $_POST['jam_penjemputan'];
        $tanggal_penjemputan = $_POST['tanggal_penjemputan'];
        $keterangan = $_POST['keterangan'];
        $tanggal_pengembalian = $_POST['tanggal_pengembalian'];
        $catatan = $_POST['catatan'];
        $car_id = $_GET['car_id'];

        // Retrieve the user ID from the session
        $user_id = $_SESSION['user_id'];
        $nama = $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];
        $nomor_telepon = $_SESSION['nomor_telepon'];
        $email = $_SESSION['email'];

        // Retrieve harga from the database using prepared statement
        $sql = "SELECT harga FROM cars WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $car_id);
        $stmt->execute();
        $stmt->bind_result($harga);
        $stmt->fetch();
        $stmt->close();

        // Check if car ID is valid
        if (isset($car_id)) {
            // Prepare and execute the SQL query to insert data into the database
            $sql = "INSERT INTO Pemesanan (waktu_awal, waktu_akhir, lokasi_pengantaran, jam_penjemputan, keterangan, catatan, ID_kendaraan, ID_penyewa) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssii", $tanggal_penjemputan, $tanggal_pengembalian, $tempat, $jam_penjemputan, $keterangan, $catatan, $car_id, $user_id);
            $stmt->execute();
            $stmt->close();

            // Redirect to another page on success
            header("Location: index_pembayaran.php");
            exit;
        } else {
            echo "Error: Invalid car ID.";
        }
    } else {
        echo "Error: All form fields are required.";
        // Dump the contents of the $_POST array
echo "Contents of \$_POST array:<br>";
var_dump($_POST);
echo "<br><br>";

// Dump the contents of the $_SESSION array
echo "Contents of \$_SESSION array:<br>";
var_dump($_SESSION);
echo "<br><br>";
    }
}
?>