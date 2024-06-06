<?php
session_start();
include '../php/database.php'; // Ensure this file contains the code to initialize $conn

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the ID_pemesanan from the form data
    $ID_pemesanan = $_POST['ID_pemesanan'];

    // Check if the user_id is set in the session
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Connect to the database
        $conn = new mysqli('localhost', 'root', 'mysql', 'ngamobil');

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Delete the pemesanan record
        $sql = "DELETE FROM pemesanan WHERE ID_pemesanan = ? AND ID_penyewa = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Error preparing statement: " . $conn->error);
        }

        $stmt->bind_param("ii", $ID_pemesanan, $user_id);
        $stmt->execute();

        // Check for errors in execution
        if ($stmt->errno) {
            echo "Error executing statement: " . $stmt->error;
            exit;
        }

        // Close the statement
        $stmt->close();
        $conn->close();

        // Redirect back to the log page
        header("Location: ../pages/index_aktivitas_log.php");
        exit();
    } else {
        echo "Error: User not logged in.";
    }
} else {
    echo "Error: Invalid request method.";
}
