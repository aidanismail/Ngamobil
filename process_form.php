
<?php
// process_form.php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Retrieve a valid ID_kendaraan and ID_penyewa from the database
    $stmt_kendaraan = $pdo->query("SELECT ID_kendaraan FROM Kendaraan LIMIT 1");
    $ID_kendaraan = $stmt_kendaraan->fetchColumn();

    $stmt_penyewa = $pdo->query("SELECT ID_penyewa FROM Penyewa LIMIT 1");
    $ID_penyewa = $stmt_penyewa->fetchColumn();

    // Check if valid IDs were found
    if (!$ID_kendaraan || !$ID_penyewa) {
        echo "Error: Valid ID_kendaraan or ID_penyewa not found in the database.";
        exit;
    }

    $sql = "INSERT INTO Pemesanan (waktu_awal, waktu_akhir, harga, lokasi_pengantaran, jam_penjemputan, ID_kendaraan, ID_penyewa) 
            VALUES (:waktu_awal, :waktu_akhir, :harga, :lokasi_pengantaran, :jam_penjemputan, :ID_kendaraan, :ID_penyewa)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'waktu_awal' => $tanggal_penjemputan . ' ' . $jam_penjemputan,
        'waktu_akhir' => $tanggal_pengembalian,
        'harga' => $harga,
        'lokasi_pengantaran' => $tempat,
        'jam_penjemputan' => $jam_penjemputan,
        'ID_kendaraan' => $ID_kendaraan,
        'ID_penyewa' => $ID_penyewa,
    ]);

    echo "Pemesanan berhasil!";
} else {
    echo "Invalid request method.";
}
?>