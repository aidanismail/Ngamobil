<?php
session_start();
include 'database.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $payment_method = $_POST['payment_method'];
    $car_id = $_POST['car_id'];
    $total_harga = $_POST['total_harga'];

    // Retrieve user data from the session
    $user_id = $_SESSION['user_id'];
    $nama = $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];
    $handphone = $_SESSION['nomor_telepon'];
    $email = $_SESSION['email'];

    // Validate the data
    if (empty($payment_method) || empty($car_id) || empty($total_harga)) {
        die("Error: All fields are required.");
    }

    // Sanitize the data
    $payment_method = $conn->real_escape_string($payment_method);
    $car_id = (int)$car_id;
    $total_harga = (int)$total_harga;
    // Save total price in the session
    $_SESSION['total_harga'] = $total_harga;
    
    // Insert the payment data into the database
    $sql = "INSERT INTO pembayaran (ID_penyewa, ID_kendaraan, metode_pembayaran, total_harga) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("iisi", $user_id, $car_id, $payment_method, $total_harga);
    $stmt->execute();

    // Check for errors in execution
    if ($stmt->errno) {
        echo "Error executing statement: " . $stmt->error;
        exit;
    }

    // Close the statement
    $stmt->close();

    // Redirect to a success page
    header("Location: success_page.php");
    exit;
} else {
    echo "Error: Invalid request method.";
}

// Close the connection
$conn->close();
?>
