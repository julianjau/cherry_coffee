<?php
require '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_menu = mysqli_real_escape_string($conn, $_POST['id_menu']);

    // Ambil informasi gambar sebelum dihapus
    $query_info = "SELECT gambar FROM data_daftar_menu_makanan_dan_minuman WHERE id_menu = ?";
    $stmt_info = mysqli_prepare($conn, $query_info);
    mysqli_stmt_bind_param($stmt_info, 's', $id_menu);
    mysqli_stmt_execute($stmt_info);
    mysqli_stmt_bind_result($stmt_info, $gambar);
    mysqli_stmt_fetch($stmt_info);
    mysqli_stmt_close($stmt_info);

    // Hapus gambar dari folder
    if (!empty($gambar)) {
        $gambar_path = '../../pengguna/img/' . $gambar;
        if (file_exists($gambar_path)) {
            unlink($gambar_path);
        }
    }

    // Hapus data dari database
    $query_delete = "DELETE FROM data_daftar_menu_makanan_dan_minuman WHERE id_menu = ?";
    $stmt_delete = mysqli_prepare($conn, $query_delete);
    mysqli_stmt_bind_param($stmt_delete, 's', $id_menu);
    
    if (mysqli_stmt_execute($stmt_delete)) {
        // Redirect ke halaman admin setelah berhasil menghapus menu
        header('Location: ../menu/Menu-makanan.php');
        exit;
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt_delete);
}
?>
