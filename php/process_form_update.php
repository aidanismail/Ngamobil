<?php
session_start();
include '../php/database.php'; // Ensure this file contains the code to initialize $conn

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

    // Connect to the database
    $conn = new mysqli('localhost', 'root', 'mysql', 'ngamobil');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch the current waktu_akhir
    $sql = "SELECT waktu_akhir FROM pemesanan WHERE ID_pemesanan = ? AND ID_penyewa = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("ii", $ID_pemesanan, $user_id);
    $stmt->execute();
    $stmt->bind_result($waktu_akhir);
    $stmt->fetch();
    $stmt->close();

    // Validate the new_waktu_akhir date
    if (strtotime($new_waktu_akhir) <= strtotime($waktu_akhir)) {
        echo "Error: New end date must be later than the current end date.";
        exit();
    }

    // Update the waktu_akhir in the database
    $update_sql = "UPDATE pemesanan SET waktu_akhir = ? WHERE ID_pemesanan = ? AND ID_penyewa = ?";
    $update_stmt = $conn->prepare($update_sql);

    if (!$update_stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $update_stmt->bind_param("sii", $new_waktu_akhir, $ID_pemesanan, $user_id);
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Extend Booking</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="ID_pemesanan">Booking ID:</label>
        <input type="text" id="ID_pemesanan" name="ID_pemesanan" required><br>

        <label for="new_waktu_akhir">New End Date:</label>
        <input type="datetime-local" id="new_waktu_akhir" name="new_waktu_akhir" required><br>

        <input type="submit" value="Extend Booking">
    </form>
</body>
</html>
