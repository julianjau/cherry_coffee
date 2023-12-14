<?php
// proses_tambah_makanan.php

require '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_menu = mysqli_real_escape_string($conn, $_POST['nama_menu']);
    $harga = mysqli_real_escape_string($conn, $_POST['harga']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // Upload gambar
    $gambar = ''; // Sesuaikan ini dengan logika pengunggahan gambar sesuai dengan kebutuhan Anda

    if ($_FILES['file-input']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['file-input']['tmp_name'];
        $fileName = $_FILES['file-input']['name'];
        $fileSize = $_FILES['file-input']['size'];
        $fileType = $_FILES['file-input']['type'];

        $uploadPath = '../../Pengguna/img/'; // Sesuaikan dengan lokasi folder penyimpanan gambar
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $gambar = uniqid() . '.' . $fileExt;

        // Pindahkan file ke lokasi yang diinginkan
        move_uploaded_file($fileTmpPath, $uploadPath . $gambar);
    }

    // Jenis menu (MA)
    $jenis_menu = 'MA';

    // Query untuk menambahkan data menu makanan ke dalam tabel
    $query = "INSERT INTO data_daftar_menu_makanan_dan_minuman (nama_menu, gambar, harga, status, jenis_menu) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'sssss', $nama_menu, $gambar, $harga, $status, $jenis_menu);
        mysqli_stmt_execute($stmt);

        // Redirect ke halaman admin setelah berhasil menambahkan menu
        header('Location: ../menu/Menu-makanan.php');
        exit;
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}
?>
