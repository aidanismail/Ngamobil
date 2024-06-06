<?php
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

// Check if the 'ID_pemesanan' POST parameter is set
if (isset($_POST['ID_pemesanan'])) {
    // Get the booking ID from the POST request
    $ID_pemesanan = $_POST['ID_pemesanan'];

    // Create a SQL DELETE statement
    $sql = "DELETE FROM pemesanan WHERE ID_pemesanan = ?";

    // Prepare the SQL statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameters
        $stmt->bind_param("i", $ID_pemesanan);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to the index_pemesanan.php page with a success message
            header("Location: index_pemesanan.php?message=Booking+deleted+successfully");
            exit();
        } else {
            // Redirect to the index_pemesanan.php page with an error message
            header("Location: index_pemesanan.php?message=Error+deleting+booking");
            exit();
        }

        // Close the statement
        $stmt->close();
    } else {
        // Redirect to the index_pemesanan.php page with an error message
        header("Location: index_pemesanan.php?message=Error+preparing+SQL+statement");
        exit();
    }
} else {
    // Redirect to the index_pemesanan.php page with an error message
    header("Location: index_pemesanan.php?message=Invalid+request");
    exit();
}

// Close the database connection
$conn->close();
?>
