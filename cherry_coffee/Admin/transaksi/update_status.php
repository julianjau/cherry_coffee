<?php
// Koneksi ke database (sesuaikan dengan konfigurasi Anda)
$conn = mysqli_connect("localhost", "root", "", "cherry_coffee");

// Periksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Tangkap data dari permintaan POST
$id_pesanan = $_POST['id_pesanan'];
$new_status = $_POST['new_status'];

// Perbarui status pesanan di database
$query = "UPDATE pemesanan SET status = '$new_status' WHERE id_pesanan = $id_pesanan";
$result = mysqli_query($conn, $query);

// Periksa apakah query berhasil dieksekusi
if (!$result) {
    die("Error: " . mysqli_error($conn));
}

// Tanggapi ke klien (misalnya, dapat berupa JSON)
echo json_encode(['status' => 'success']);
?>
