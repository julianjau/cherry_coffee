<?php
// Koneksi ke database (sesuaikan dengan konfigurasi Anda)
$conn = mysqli_connect("localhost", "root", "", "cherry_coffee");

// Periksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Query untuk mendapatkan jumlah data/pesanan dari halaman data_penjualan
$query = "SELECT COUNT(*) as jumlah_selesai FROM pemesanan WHERE status ='selesai'";
$result = mysqli_query($conn, $query);

// Periksa apakah query berhasil dieksekusi
if (!$result) {
    die("Error: " . mysqli_error($conn));
}

// Ambil hasil query
$row = mysqli_fetch_assoc($result);

// Buat array dengan hasilnya
$response = array(
    'jumlah_selesai' => $row['jumlah_selesai']
);

// Mengembalikan data dalam format JSON
echo json_encode($response);

// Tutup koneksi ke database
mysqli_close($conn);
?>
