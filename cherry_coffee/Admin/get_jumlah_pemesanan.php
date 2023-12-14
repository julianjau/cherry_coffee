<?php
// Koneksi ke database (sesuaikan dengan konfigurasi Anda)
$conn = mysqli_connect("localhost", "root", "", "cherry_coffee");

// Periksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Query untuk mendapatkan jumlah data/pesanan
$query = "SELECT COUNT(*) as jumlah_pesanan FROM pemesanan WHERE status ='baru'";
$result = mysqli_query($conn, $query);

// Periksa apakah query berhasil dieksekusi
if (!$result) {
    die("Error: " . mysqli_error($conn));
}

// Ambil hasil query
$row = mysqli_fetch_assoc($result);

// Keluarkan hasil dalam format JSON
echo json_encode($row);

// Tutup koneksi ke database
mysqli_close($conn);
?>
