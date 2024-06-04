<?php
// DB configuration
$host = 'localhost'; // or your host
$dbname = 'ngamobil'; // your database name
$username = 'root'; // your database username
$password = 'mysql'; // your database password

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $nama_depan = $conn->real_escape_string($_POST['first_name']);
    $nama_belakang = $conn->real_escape_string($_POST['last_name']);
    $alamat = $conn->real_escape_string($_POST['address']);
    $nomor_telepon = $conn->real_escape_string($_POST['phone']);
    $email = $conn->real_escape_string($_POST['email']);
    // Properly hash the password for security
    $password = password_hash($conn->real_escape_string($_POST['password']), PASSWORD_BCRYPT);
    $nomor_ktp = ''; // Assuming you might add this field later

    // SQL to insert new record
    $sql = "INSERT INTO penyewa (nama_depan, nama_belakang, alamat, nomor_telepon, email, password, nomor_ktp) VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Prepare and bind
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $nama_depan, $nama_belakang, $alamat, $nomor_telepon, $email, $password, $nomor_ktp);

    // Execute and check
    if ($stmt->execute()) {
        // Redirect to login page after successful registration
        header("Location: index_login.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
    