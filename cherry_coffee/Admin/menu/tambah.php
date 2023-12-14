<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "webmasjid");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    // Handle form submission
    $nama_menu = mysqli_real_escape_string($conn, $_POST['nama_menu']);
    $targetDir = "../../pengguna/img/";
    $harga = mysqli_real_escape_string($conn, $_POST['harga']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "File sudah ada.";
    } else {
        // Upload file
        if (move_uploaded_file($_FILES["file-input"]["tmp_name"], $targetFile)) {
            // Insert data into database
            $insertQuery = "INSERT INTO foto_kegiatan (id_admin, foto, keterangan) VALUES (1, '$targetFile', '$imageCaption')";
            if (mysqli_query($conn, $insertQuery)) {
                echo "<script>
                alert('Data berhasil diperbarui.');
                setTimeout(function(){
                    window.location.href = '../menu/Menu-makanan.php';
                }, 1000);
              </script>";
        exit;
            } else {
                echo "Error: " . $insertQuery . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Gagal upload file.";
        }
    }

    mysqli_close($conn);
}
?>
