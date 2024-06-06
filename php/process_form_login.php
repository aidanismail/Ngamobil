<?php
session_start();

// DB configuration
$host = 'localhost';
$dbname = 'ngamobil';
$username = 'root';
$password = 'mysql';

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password']; // Note: Do not escape the password before verification

    // Query to fetch the stored hash and other user data
    $sql = "SELECT ID_penyewa, password, nama_depan, nama_belakang, nomor_telepon FROM penyewa WHERE email = ?";
    $stmt = $conn->prepare($sql);

    // Check if the statement was prepared successfully
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($ID_penyewa, $stored_hash, $nama_depan, $nama_belakang, $nomor_telepon);
    $stmt->fetch();

    // Close the statement
    $stmt->close();

    // Verify the password  
    if ($stored_hash && password_verify($password, $stored_hash)) {
        // Store user data in session
        $_SESSION['user_id'] = $ID_penyewa;
        $_SESSION['first_name'] = $nama_depan;
        $_SESSION['last_name'] = $nama_belakang;
        $_SESSION['email'] = $email;
        $_SESSION['nomor_telepon'] = $nomor_telepon;

        // Redirect to index_pemilihan.php after successful login
        header("Location: /Ngamobil/pages/index_pemilihan.php");
        exit();
    } else {
        // Redirect back to login page with error parameter
        header("Location: /Ngamobil/pages/index_login.php?error=1");
        exit();
    }
} else {
    echo "Invalid request method.";
}

// Close the database connection
$conn->close();
