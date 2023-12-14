<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "cherry_coffee");

// Memeriksa apakah data dikirimkan dari AJAX
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Mendapatkan data JSON dari JavaScript dan memparsingnya ke dalam array PHP
  $produk = json_decode($_POST['produk'], true);

  // Lakukan operasi untuk menyimpan setiap produk ke dalam database
  foreach ($produk as $item) {
    $jenisMenu = $item['jenis'];
    $jumlahPesanan = $item['jumlah'];
    $hargaMenu = $item['harga'];

    // Lakukan sanitasi data jika diperlukan sebelum melakukan query
    // Contoh menggunakan mysqli_real_escape_string:
    $jenisMenu = mysqli_real_escape_string($conn, $jenisMenu);
    $jumlahPesanan = mysqli_real_escape_string($conn, $jumlahPesanan);
    $hargaMenu = mysqli_real_escape_string($conn, $hargaMenu);

    $query = "INSERT INTO pemesanan (nama_menu, jumlah_pesanan, harga) VALUES ('$jenisMenu', '$jumlahPesanan', '$hargaMenu')";
    $result = mysqli_query($conn, $query);

    if (!$result) {
      echo "Gagal menyimpan data ke database: " . mysqli_error($conn);
      exit; // Keluar dari skrip jika ada kesalahan
    }
  }

  echo "Data berhasil disimpan ke database.";
} else {
  echo "Tidak ada data yang dikirimkan.";
}

// Tutup koneksi ke database
mysqli_close($conn);
?>
