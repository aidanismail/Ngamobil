<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $payment_method = $_POST['payment_method'];
  $car_id = $_POST['car_id'];
  $total_harga = $_POST['total_harga'];
  $tanggal_pembayaran = date('Y-m-d H:i:s');

  $sql = "INSERT INTO pembayaran (id_kendaraan, metode_pembayaran, total_harga, tanggal_pembayaran) VALUES ('$car_id', '$payment_method', '$total_harga', '$tanggal_pembayaran')";

  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
}
?>
