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
    $sql = "SELECT id, password, first_name, last_name FROM penyewa WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($id, $stored_hash, $first_name, $last_name);
    $stmt->fetch();
    $stmt->close();

    // Verify the password
    if (password_verify($password, $stored_hash)) {
        // Store user data in session
        $_SESSION['user_id'] = $id;
        $_SESSION['first_name'] = $first_name;
        $_SESSION['last_name'] = $last_name;
        $_SESSION['email'] = $email;

        // Redirect to a protected page
        header("Location: protected_page.php");
        exit();
    } else {
        echo "Invalid email or password.";
    }
} else {
    echo "Invalid request method.";
}
?>
