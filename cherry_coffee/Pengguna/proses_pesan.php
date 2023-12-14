<?php
// Pastikan untuk memeriksa koneksi ke database Anda di sini dan membuat koneksi ke database cherry_coffee
// Misalnya:
// $koneksi = mysqli_connect("nama_host", "nama_pengguna", "password", "cherry_coffee");

// Periksa apakah ada data yang dikirim dari halaman web
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Misalkan terdapat sesi yang menyimpan informasi pengguna yang login
    session_start();
    
    // Pastikan pengguna telah login dan sesi pengguna tersedia
    if(isset($_SESSION['id_user'])){
        $id_user = $_SESSION['id_user']; // Gunakan id_user dari sesi pengguna yang login
        $alamat = $_POST['alamat'];
        $no_telepon = $_POST['no_telepon'];
        $tanggal = date("Y-m-d H:i:s"); // Tanggal saat ini

        // Loop untuk setiap produk dalam keranjang belanja
        foreach ($_POST['produk'] as $produk) {
            $id_menu = $produk['id_menu'];
            $nama_menu = $produk['nama_menu'];
            $jumlah_pesanan = $produk['jumlah_pesanan'];
            $harga = $produk['harga'];
            $status = 'Menunggu Konfirmasi'; // Status awal

            // Simpan data ke dalam tabel pemesanan
            $sql = "INSERT INTO pemesanan (id_user, id_menu, alamat, no_telepon, tanggal, nama_menu, jumlah_pesanan, harga, status)
                    VALUES ('$id_user', '$id_menu', '$alamat', '$no_telepon', '$tanggal', '$nama_menu', '$jumlah_pesanan', '$harga', '$status')";

            if ($koneksi->query($sql) === TRUE) {
                echo "Pemesanan berhasil disimpan.";
            } else {
                echo "Error: " . $sql . "<br>" . $koneksi->error;
            }
        }
    } else {
        echo "Pengguna belum login.";
    }
} else {
    echo "Tidak ada data yang dikirimkan.";
}
?>
