<?php
include 'koneksi.php'; // Memasukkan file koneksi.php yang berisi koneksi ke database

// Pastikan ID menu diberikan melalui parameter GET
if (isset($_GET['id_menu'])) {
    $id_menu = $_GET['id_menu'];

    // Query untuk mengambil status dari database berdasarkan ID menu
    $query = "SELECT status FROM data_daftar_makanan_dan_minuman WHERE id_menu = $id_menu";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo json_encode($row);
        } else {
            echo json_encode(array('status' => 'Menu tidak ditemukan'));
        }
    } else {
        echo json_encode(array('status' => 'Gagal mengambil data'));
    }
} else {
    echo json_encode(array('status' => 'ID menu tidak diberikan'));
}
?>
