<?php
// process_form.php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $nama = $_POST['nama'];
    $handphone = $_POST['handphone'];
    $email = $_POST['email'];
    $tempat = $_POST['tempat'];
    $jam_penjemputan = $_POST['jam_penjemputan'];
    $tanggal_penjemputan = $_POST['tanggal_penjemputan'];
    $keterangan = $_POST['keterangan'];
    $tanggal_pengembalian = $_POST['tanggal_pengembalian'];
    $harga = $_POST['harga'];
    $catatan = $_POST['catatan'];

    // Format the jam_penjemputan to be MySQL TIME format
    $jam_penjemputan = str_replace(' WITA', ':00', $jam_penjemputan);

    // Retrieve the selected car ID from the query parameter
    $car_id = $_GET['car_id'];

    // Check if the car ID is valid (you might want to add further validation)
    if (!is_numeric($car_id)) {
        echo "Error: Invalid car ID.";
        exit;
    }

    // Prepare and execute the SQL query to insert data into the database
    $sql = "INSERT INTO Pemesanan (waktu_awal, waktu_akhir, harga, lokasi_pengantaran, jam_penjemputan, ID_kendaraan) 
            VALUES (:waktu_awal, :waktu_akhir, :harga, :lokasi_pengantaran, :jam_penjemputan, :ID_kendaraan)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'waktu_awal' => $tanggal_penjemputan . ' ' . $jam_penjemputan,
        'waktu_akhir' => $tanggal_pengembalian,
        'harga' => $harga,
        'lokasi_pengantaran' => $tempat,
        'jam_penjemputan' => $jam_penjemputan,
        'ID_kendaraan' => $car_id, // Use the retrieved car ID here
    ]);

    // Redirect to another page on success
    header("Location: success_page.php");
    exit;
} else {
    echo "Invalid request method.";
}
?>
