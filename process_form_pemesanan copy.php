<?php
session_start();

// Database configuration
$db_host = 'localhost';
$db_user = 'root';
$db_password = 'mysql';
$db_name = 'ngamobil';

// Create connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Enable error reporting and display
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all form fields are set and not empty
    if (
        isset($_SESSION['nama']) && isset($_SESSION['handphone']) && isset($_SESSION['email']) &&
        isset($_POST['tempat']) && isset($_POST['jam_penjemputan']) && isset($_POST['tanggal_penjemputan']) &&
        isset($_POST['keterangan']) && isset($_POST['tanggal_pengembalian']) && isset($_POST['harga']) &&
        isset($_POST['catatan']) && isset($_GET['car_id'])
    ) {
        // Retrieve form data
        $tempat = $_POST['tempat'];
        $jam_penjemputan = $_POST['jam_penjemputan'];
        $tanggal_penjemputan = $_POST['tanggal_penjemputan'];
        $keterangan = $_POST['keterangan'];
        $tanggal_pengembalian = $_POST['tanggal_pengembalian'];
        $catatan = $_POST['catatan'];
        $car_id = $_GET['car_id']; // From the URL

        // Retrieve the user data from the session
        $user_id = $_SESSION['user_id'];
        $nama = $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];
        $handphone = $_SESSION['nomor_telepon'];
        $email = $_SESSION['email'];

        // Retrieve harga from the database using prepared statement
        $sql = "SELECT harga FROM cars WHERE id = ?";
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

            // Store user data in session (this part seems redundant as the data is already in the session)
            $_SESSION['user_id'] = $user_id;
            $_SESSION['first_name'] = $nama;
            $_SESSION['last_name'] = $last_name;
            $_SESSION['email'] = $email;
            $_SESSION['nomor_telepon'] = $handphone;
        } else {
            echo "Error fetching harga.";
            exit; // Terminate script if there's an error
        }

        // Close the statement
        $stmt->close();

        // Prepare and execute the SQL query to insert data into the database
        $sql = "INSERT INTO Pemesanan (waktu_awal, waktu_akhir, lokasi_pengantaran, jam_penjemputan, keterangan, catatan, ID_kendaraan, ID_penyewa, harga) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Error preparing statement: " . $conn->error);
        }

        $stmt->bind_param("ssssssiii", $tanggal_penjemputan, $tanggal_pengembalian, $tempat, $jam_penjemputan, $keterangan, $catatan, $car_id, $user_id, $harga);
        $stmt->execute();

        // Check for errors in execution
        if ($stmt->errno) {
            echo "Error executing statement: " . $stmt->error;
            exit; // Terminate script if there's an error
        }

        // Close the statement
        $stmt->close();

        // Redirect to another page on success
        header("Location: index_pembayaran.php");
        exit;
    } else {
        echo "Error: All form fields are required.";
    }
} else {
    echo "Error: Invalid request method.";
}

// Close the connection
$conn->close();
?>
