<?php
// update_pemesanan.php

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ID_pemesanan'])) {
    // Retrieve the ID_pemesanan from the form
    $ID_pemesanan = $_POST['ID_pemesanan'];

    // Perform your update logic here
    // For example, you can update the database record with the provided ID_pemesanan

    // Redirect back to the index page after updating
    header("Location: index_pemesanan.php");
    exit();
} else {
    // Redirect back to the index page if the form is not submitted properly
    header("Location: index_pemesanan.php");
    exit();
}
?>
