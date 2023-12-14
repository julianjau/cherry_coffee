<?php
include 'koneksi.php'; // Sertakan file koneksi.php di sini

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai yang di-submit dari formulir
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $noTelp = $_POST['no_telp'];
    $password = $_POST['password'];
    $konfirmasiPassword = $_POST['konfirmasi_password'];

    // Lakukan validasi data (contoh: pastikan password dan konfirmasi password cocok)
    if ($password !== $konfirmasiPassword) {
        echo "Password dan konfirmasi password tidak cocok.";
    } else {
        // Lakukan hashing pada password sebelum menyimpannya ke database (contoh: menggunakan password_hash)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Query untuk memasukkan data ke dalam tabel
        $query = "INSERT INTO daftar_akun (nama, username, email, alamat, no_telepon, password) 
                  VALUES ('$nama', '$username', '$email', '$alamat', '$noTelp', '$hashedPassword')";

        // Eksekusi query
        if (mysqli_query($conn, $query)) {
            echo "Pendaftaran akun berhasil.";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    }
}
?>
