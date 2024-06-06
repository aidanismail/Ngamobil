<?php
session_start();
include '../php/database.php'; // Ensure this file contains the code to initialize $conn

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

    // Debugging: Print the car_id
    echo "Debug: Car ID - " . $car_id . "<br>";

    // Verify if the car_id exists in the kendaraan table
    $check_sql = "SELECT COUNT(*) FROM kendaraan WHERE ID_kendaraan = ?";
    $check_stmt = $conn->prepare($check_sql);

    if (!$check_stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $check_stmt->bind_param("i", $car_id);
    $check_stmt->execute();
    $check_stmt->bind_result($car_exists);
    $check_stmt->fetch();
    $check_stmt->close();

    // Debugging: Print the result of the check
    echo "Debug: Car exists - " . $car_exists . "<br>";

    if ($car_exists == 0) {
        die("Error: Invalid car ID.");
    }

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

    // Redirect to a success page based on the selected payment method
    if ($payment_method === 'bayar-di-tempat') {
        header("Location: ../pages/success.php");
        exit;
    } elseif ($payment_method === 'transfer-bank') {
        header("Location: https://youtu.be/dQw4w9WgXcQ?si=yGg4y-jtFR1fkULA");
        exit;
    } elseif ($payment_method === 'virtual-account') {
        header("Location: https://youtu.be/dQw4w9WgXcQ?si=yGg4y-jtFR1fkULA");
        exit;
    } else {
        echo "Error: Invalid payment method.";
    }
} else {
    echo "Error: Invalid request method.";
}

// Close the connection
$conn->close();
