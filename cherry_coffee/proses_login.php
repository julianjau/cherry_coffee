<?php
include 'koneksi.php'; // Sertakan file koneksi.php di sini

// Cek apakah pengguna telah melakukan submit form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Lakukan validasi atau autentikasi dengan database
    // Contoh: Anda dapat menggunakan query SELECT untuk mencocokkan username dan password dari tabel pengguna

    $query = "SELECT * FROM daftar_akun WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $storedPassword = $row['password']; // Ambil password yang disimpan di database
        // Lakukan pengecekan password dengan fungsi password_verify atau metode autentikasi yang Anda gunakan
        if (password_verify($password, $storedPassword)) {
            // Jika username dan password cocok, Anda bisa melakukan sesuatu seperti menyimpan informasi ke session dan mengarahkan pengguna ke halaman selanjutnya
            session_start();
            $_SESSION['username'] = $username; // Simpan informasi ke session, contoh: username
            header("Location: Pengguna/index.php"); // Ganti halaman_dashboard.php dengan halaman tujuan setelah login berhasil
            exit();
        } else {
            echo "Username atau password salah.";
        }
    } else {
        echo "Username atau password salah.";
    }
}
?>
