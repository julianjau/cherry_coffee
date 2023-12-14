<?php
require '../koneksi.php';

session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
  // Jika tidak ada sesi username, redirect ke halaman login atau halaman lain yang sesuai
  header("Location: ../index.php");
  exit();
}

// Pastikan parameter id_menu terdefinisi dan valid
if (isset($_GET['id'])) {
    $id_menu = mysqli_real_escape_string($conn, $_GET['id']);

    // Query untuk mendapatkan data menu berdasarkan id_menu
    $query = "SELECT * FROM data_daftar_menu_makanan_dan_minuman WHERE id_menu = '$id_menu'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $menu = mysqli_fetch_assoc($result);
    } else {
        echo 'Data menu tidak ditemukan';
        exit;
    }

    mysqli_free_result($result);
} else {
    echo 'ID menu tidak valid';
    exit;
}

// Proses form edit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_menu = mysqli_real_escape_string($conn, $_POST['nama_menu']);
    $harga = mysqli_real_escape_string($conn, $_POST['harga']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // Upload gambar baru (jika ada perubahan)
    $gambar_baru = $_POST ['gambar_lama']; // Menggunakan nama gambar lama sebagai default

    if (isset($_FILES['file-input']) && $_FILES['file-input']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['file-input']['tmp_name'];
        $fileName = $_FILES['file-input']['name'];
        $fileSize = $_FILES['file-input']['size'];
        $fileType = $_FILES['file-input']['type'];
    
        $uploadPath = '../../Pengguna/img/'; // Sesuaikan dengan lokasi folder penyimpanan gambar
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
        // Menggunakan timestamp sebagai nama unik
        $gambar_baru = uniqid() . '.' . $fileExt;
    
        // Pindahkan file ke lokasi yang diinginkan
        if (move_uploaded_file($fileTmpPath, $uploadPath . $gambar_baru)) {
            // Hapus gambar lama jika file gambar baru berhasil diunggah
            if ($gambar_lama != 'default-image.jpg' && file_exists($uploadPath . $gambar_lama)) {
                unlink($uploadPath . $gambar_lama);
            }
        } elseif (isset($_FILES['file-input']) && $_FILES['file-input']['error'] != UPLOAD_ERR_NO_FILE) {
            echo 'Error saat mengunggah file gambar baru. Kode error: ' . $_FILES['file-input']['error'];
            exit;
        }
    } elseif (isset($_FILES['file-input']) && $_FILES['file-input']['error'] != UPLOAD_ERR_NO_FILE) {
        echo 'Error saat mengunggah file gambar baru. Kode error: ' . $_FILES['file-input']['error'];
        exit;
    }
    

    // Query untuk memperbarui data menu makanan
    $query = "UPDATE data_daftar_menu_makanan_dan_minuman SET nama_menu = ?, gambar = ?, harga = ?, status = ? WHERE id_menu = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssssi', $nama_menu, $gambar_baru, $harga, $status, $id_menu);
        mysqli_stmt_execute($stmt);

        // Redirect ke halaman admin setelah berhasil mengedit menu
        header('Location: ../menu/Menu-minuman.php');
        exit;
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="../menu/style.css">
    <!-- <link rel="stylesheet" href="test.css"> -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Mr+Dafoe&family=Poppins:wght@200&family=Roboto:wght@900&display=swap"
        rel="stylesheet">
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Admin Cherry Cofee</title>
</head>

<body>

    <nav>
        <!-- logo -->
        <div class="logo-name">
            <div class="logo-image">
                <img src="../gambar/logo.png" alt="">
            </div>

            <span class="logo_name">CherryCooffe</span>
        </div>

        <div class="menu-items">

            <!-- sidebar -->
            <ul class="nav-links">
                <li><a href="index.html" style="padding-top: 65px; padding-bottom:25px;">
                        <div class="icon">
                            <i class="uil uil-estate"></i>
                        </div>
                        <div class="teks">
                            <span class="link-name" style="font-size: 20px; ">Dashboard</span>
                        </div>
                    </a>
                </li>

                <li><a href="Statistik.html">
                        <div class="icon">
                            <img src="../gambar/statistik.png" alt="">
                        </div>
                        <div class="teks">
                            <span class="link-name" style="font-size: 20px; padding-left:4px;">Statistik</span>
                        </div>
                    </a>
                </li>
                <li><a href="data Penjualan.html">
                        <div class="icon">
                            <img src="../gambar/list.png" alt="" style="padding-top:9px;">
                        </div>
                        <div class="teks">
                            <span class="link-name" style="font-size: 20px; display:flex; padding-left:4px">Data
                                Penjualan </span>

                        </div>
                    </a>
                </li>

                <div class="item">
                    <li class="sub-btn"><a>
                            <div class="icon1"><img src="../gambar/pemesanan.png" alt="" style="padding-top:8px;"></div>
                            <div class="teks"> <span class="link-name"
                                    style="font-size: 20px; padding-left:4px">Menu</span></div>

                            <i class="fas fa-angle-right dropdown"></i>

                        </a>
                    </li>
                    <div class="sub-menu">
                        <a href="Menu-makanan.html" class="sub-item">
                            <div class="cild-sub-item">
                                <div class="circle"></div>
                                <div class="circle2"></div>
                                Makanan
                            </div>

                        </a>
                        <a href="Menu-minuman.html" class="sub-item" style="margin-top: 10px;">
                            <div class="cild-sub-item">
                                <div class="circle"></div>
                                <div class="circle2"></div>
                                Minuman
                            </div>

                        </a>

                    </div>
                </div>



                <div class="item1">
                    <li class="sub-btn"><a>
                            <div class="icon1"><img src="../gambar/keranjang.png" alt="" style="padding-top:9px;"></div>
                            <div class="teks"> <span class="link-name"
                                    style="font-size: 20px; padding-left:4px">Transaksi</span></div>

                            <i class="fas fa-angle-right dropdown"></i>
                        </a>
                    </li>
                    <div class="sub-menu">
                        <a href="Transaksi-pesanan.html" class="sub-item">
                            <div class="cild-sub-item">
                                <div class="circle"></div>
                                <div class="circle2"></div>
                                Pesanan
                            </div>

                        </a>
                        <a href="Transaksi-dalamproses.html" class="sub-item" style="margin-top: 10px;">
                            <div class="cild-sub-item">
                                <div class="circle"></div>
                                <div class="circle2"></div>
                                Dalam Proses
                            </div>

                        </a>

                    </div>
                </div>
            </ul>


            <ul class="logout-mode">

                <li><a href="#">
                        <div class="icon">
                            <i class="uil uil-signout"></i>
                        </div>
                        <div class="teks">
                            <span class="link-name" style="font-size: 20px;">Logout</span>

                        </div>
                    </a>
                </li>


            </ul>

        </div>

    </nav>

    <section class="dashboard">

        <!-- header -->
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here...">
            </div>

            <img src="../gambar/profil.png" alt="">
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title1">
                    <div class="bg-image-list">
                        <img src="../gambar/pemesanan-putih.png" alt="">
                    </div>
                    <span class="text">Menu / <small>Edit Minuman</small></span>
                </div>
            </div>

            <div class="menu-content">

                <div class="tambah1">
                    <div class="tambah2">
                        <div class="top-tambah">
                            <span>EDIT MENU MINUMAN</span>
                        </div>
                        <div class="bottom-tambah">
                        <form action=""  method="post" enctype="multipart/form-data">
                                <div class="sub-tambah">
                                    <div for="nama_menu" class="aset">Nama Menu :</div>
                                    <input type="text" id="nama_menu" name="nama_menu" value="<?= $menu['nama_menu'] ?>" required>
                                </div>

                                <div class="sub-tambah">
                                    <div for="harga" class="aset">Harga :</div>
                                    <input type="text" id="harga" name="harga" value="<?= $menu['harga'] ?>" required>
                                </div>

                                <div class="sub-tambah">
                                    <div for="status" class="aset">Status :</div>
                                    <select id="status" name="status">
                                    <option value="Tersedia" <?= ($menu['status'] == 'Tersedia') ? 'selected' : '' ?>>Tersedia</option>
                                    <option value="Tidak Tersedia" <?= ($menu['status'] == 'Tidak Tersedia') ? 'selected' : '' ?>>Tidak Tersedia</option>
                                    </select>
                                </div>

                                <input type="hidden" name="gambar_lama" value="<?php echo $menu['gambar']; ?>">
                                
                                <div class="sub-tambah">
                                    <div class="aset2">Gambar :</div>
                                    <div class="image-upload-container">
                                        <div class="image-upload-preview" id="preview-container">
                                            <img id="image-preview" alt="Preview" src="../../Pengguna/img/<?php echo $menu['gambar']; ?>">
                                        </div>
                                        <input type="file" class="text" name="file-input" id="file-input" accept="image/*" onchange="previewImage()" />
                                        
                                        <!-- Menampilkan nama file lama jika tidak ada perubahan gambar -->
                                        <span id="file-name"><?php echo $menu['gambar']; ?></span>
                                    </div>
                                </div>

                                <div class="op-button">
                                <a href="../menu/Menu-minuman.php" class="cancel-button">
                                <button type="button" onclick="cancelForm()">Cancel</button>
                                </a>
                                <button id="update" type="submit">Submit</button>
                                </div>

                        </form>
                        
                        </div>
                        
                    </div>

                </div>

            </div>

        </div>

    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $(document).ready(function () {
            //jquery for toggle sub menus
            $('.sub-btn').click(function () {
                $(this).next('.sub-menu').slideToggle('');
                $(this).find('.dropdown').toggleClass('rotate');
            });
        });
        
        function previewImage() {
        var preview = document.getElementById('image-preview');
        var fileInput = document.getElementById('file-input');
        var fileNameSpan = document.getElementById('file-name');

        // Mengambil file yang dipilih oleh pengguna
        var file = fileInput.files[0];

        if (file) {
            var reader = new FileReader();

            // Membaca konten file sebagai URL data
            reader.readAsDataURL(file);

            // Menampilkan gambar pada elemen preview
            reader.onload = function(e) {
                preview.src = e.target.result;
            };
            // Menampilkan nama file di sebelah input file
            fileNameSpan.textContent = file.name;
        } else {
            // Mengatur preview ke gambar default jika tidak ada file yang dipilih
            preview.src = '../../Pengguna/img/default-image.jpg';
            fileNameSpan.textContent = '<?php echo $menu['gambar']; ?>';
        }
}

    function confirmCancel() {
        return confirm("Apakah Anda yakin ingin membatalkan perubahan?");
    }

    function cancelForm() {
        if (confirmCancel()) {
            // Redirect ke halaman Menu-makanan.php atau lakukan tindakan lain sesuai kebutuhan
            window.location.href = "../menu/Menu-makanan.php";
        }
    }
    </script>

    <script src="script.js"></script>
</body>

</html>