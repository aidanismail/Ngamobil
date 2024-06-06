<?php
session_start();

// Database configuration
$servername = "localhost";
$username = "root";
$password = "mysql";
$database = "ngamobil";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user_id is set in the session
if (!isset($_SESSION['user_id'])) {
    echo "Error: User not logged in.";
    exit();
}

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the ID_pemesanan and new_waktu_akhir from the form data
    $ID_pemesanan = $_POST['ID_pemesanan'];
    $new_waktu_akhir = $_POST['new_waktu_akhir'];
    $user_id = $_SESSION['user_id'];

    // Fetch the current waktu_akhir and ID_kendaraan
    $sql = "SELECT waktu_akhir, ID_kendaraan FROM pemesanan WHERE ID_pemesanan = ? AND ID_penyewa = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("ii", $ID_pemesanan, $user_id);
    $stmt->execute();
    $stmt->bind_result($waktu_akhir, $ID_kendaraan);
    $stmt->fetch();
    $stmt->close();

    // Fetch the daily rate for the vehicle
    $rate_sql = "SELECT harga FROM kendaraan WHERE ID_kendaraan = ?";
    $rate_stmt = $conn->prepare($rate_sql);

    if (!$rate_stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $rate_stmt->bind_param("i", $ID_kendaraan);
    $rate_stmt->execute();
    $rate_stmt->bind_result($daily_rate);
    $rate_stmt->fetch();
    $rate_stmt->close();

    // Calculate the new rental period
    $current_end_date = new DateTime($waktu_akhir);
    $new_end_date = new DateTime($new_waktu_akhir);
    $interval = $current_end_date->diff($new_end_date);
    $additional_days = $interval->days;

    // Calculate the new total price
    // If the new end date is earlier, reduce the price accordingly
    $new_harga = $additional_days * $daily_rate;

    // Update the waktu_akhir and harga in the database
    $update_sql = "UPDATE pemesanan SET waktu_akhir = ?, harga = harga + ? WHERE ID_pemesanan = ? AND ID_penyewa = ?";
    $update_stmt = $conn->prepare($update_sql);

    if (!$update_stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    // Adjust the price based on whether the new end date is earlier or later
    if ($new_end_date < $current_end_date) {
        // Reduce the price if the new end date is earlier
        $new_harga = -$new_harga;
    }

    $update_stmt->bind_param("siii", $new_waktu_akhir, $new_harga, $ID_pemesanan, $user_id);
    $update_stmt->execute();

    // Check for errors in execution
    if ($update_stmt->errno) {
        echo "Error executing statement: " . $update_stmt->error;
        exit();
    }

    // Close the statement
    $update_stmt->close();
    $conn->close();

    // Redirect back to the log page
    header("Location: ../pages/index_aktivitas_log.php");
    exit();
}
?>
