<?php

require 'koneksi.php';

$menuId = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : null;

// Pastikan $menuId tidak kosong
if ($menuId !== null) {
    $query = "SELECT * FROM data_daftar_menu_makanan_dan_minuman WHERE id_menu = '$menuId'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $dataMenu = mysqli_fetch_assoc($result);
        echo json_encode($dataMenu);
    } else {
        echo json_encode(['error' => 'Data menu tidak ditemukan']);
    }

    mysqli_free_result($result);
} else {
    echo json_encode(['error' => 'ID menu tidak valid']);
}

mysqli_close($conn);
?>