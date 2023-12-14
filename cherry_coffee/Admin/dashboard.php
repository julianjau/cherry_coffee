<?php
// Koneksi ke database (sesuaikan dengan konfigurasi Anda)
$conn = mysqli_connect("localhost", "root", "", "cherry_coffee");

session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
  // Jika tidak ada sesi username, redirect ke halaman login atau halaman lain yang sesuai
  header("Location: ../index.php");
  exit();
}

// Periksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Query untuk mendapatkan jumlah data/pesanan
$query = "SELECT COUNT(*) as jumlah_pesanan FROM pemesanan";
$result = mysqli_query($conn, $query);

// Periksa apakah query berhasil dieksekusi
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $jumlah_pesanan = $row['jumlah_pesanan'];
} else {
    $jumlah_pesanan = 0;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="gambar/logo2.png" type="image/x-icon" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Mr+Dafoe&family=Poppins:wght@200&family=Roboto:wght@900&display=swap"
        rel="stylesheet">
    <!----===== Icon CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Admin Cherry Cofee</title>
</head>

<body>

    <nav>
        <!-- logo -->   
        <div class="logo-name">
            <div class="logo-image">
                <img src="gambar/logo.png" alt="">
            </div>

            <span class="logo_name">Cherry Coffee</span>
        </div>

        <div class="menu-items">
            <!-- sidebar -->
            <ul class="nav-links">
                <li><a href="dashboard.php" style="padding-top: 65px; padding-bottom:25px;">
                        <div class="icon">
                            <i class="uil uil-estate"></i>
                        </div>
                        <div class="teks">
                            <span class="link-name" style="font-size: 20px; ">Dahsboard</span>
                        </div>
                    </a>
                </li>
                <li><a href="statistik/Statistik.html">
                        <div class="icon">
                            <img src="gambar/statistik.png" alt="">
                        </div>
                        <div class="teks">
                            <span class="link-name" style="font-size: 20px; padding-left:4px;">Statistik</span>
                        </div>
                    </a>
                </li>
                <li><a href="data-penjualan/data Penjualan.php">
                        <div class="icon">
                            <img src="gambar/list.png" alt="" style="padding-top:9px;">
                        </div>
                        <div class="teks">
                            <span class="link-name" style="font-size: 20px; display:flex; padding-left:4px">Data
                                Penjualan </span>
                        </div>
                    </a>
                </li>
                <div class="item">
                    <li class="sub-btn"><a>
                            <div class="icon1"><img src="gambar/pemesanan.png" alt="" style="padding-top:8px;"></div>
                            <div class="teks"> <span class="link-name"
                                    style="font-size: 20px; padding-left:4px">Menu</span></div>

                            <i class="fas fa-angle-right dropdown"></i>
                        </a>
                    </li>
                    <div class="sub-menu">
                        <a href="menu/Menu-makanan.php" class="sub-item">
                            <div class="cild-sub-item">
                                <div class="circle"></div>
                                <div class="circle2"></div>
                                Makanan
                            </div>                         
                        </a>
                        <a href="menu/Menu-minuman.php" class="sub-item" style="margin-top: 10px;">
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
                            <div class="icon1"><img src="gambar/keranjang.png" alt="" style="padding-top:9px;"></div>
                            <div class="teks"> <span class="link-name"
                                    style="font-size: 20px; padding-left:4px">Transaksi</span></div>

                            <i class="fas fa-angle-right dropdown"></i>
                        </a>
                    </li>
                    <div class="sub-menu">
                        <a href="transaksi/Transaksi-pesanan.php" class="sub-item">
                            <div class="cild-sub-item">
                                <div class="circle"></div>
                                <div class="circle2"></div>
                                Pesanan
                            </div>                            
                        </a>
                        <a href="transaksi/Transaksi-dalamproses.php" class="sub-item" style="margin-top: 10px;">
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
                <li><a href="logout.php">
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

            <img src="gambar/profil.png" alt="">
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Dashboard</span>
                </div>

                <div class="boxes">
                    <div class="box box1">
                        <img src="gambar/mount.png" alt="">
                        <span class="text">Total Count</span>
                        <span class="number1">0</span>
                    </div>
                    <div class="box box2">
                        <img src="gambar/order.png" alt="">
                        <span class="text">Pending Order</span>
                        <span class="number">0</span>
                    </div>
                    <div class="box box3">
                        <img src="gambar/sale.png" alt="">
                        <span class="text">Total Sale</span>
                        <span class="number">Rp. </span>
                    </div>
                    <div class="box box4">
                        <img src="gambar/draft.png" alt="">
                        <span class="text">Last 1 Month Sale</span>
                        <span class="number">Rp. </span>
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
    </script>
     <script>
        // Kirim permintaan AJAX ke server untuk mendapatkan jumlah data/pesanan
        fetch('get_jumlah_pemesanan.php')
            .then(response => response.json())
            .then(data => {
                // Mengisi nilai jumlah_pesanan ke dalam elemen dengan class "number"
                document.querySelector('.number').textContent = data.jumlah_pesanan;
            })
            .catch(error => {
                console.error('Error:', error);
            });

            fetch('get_jumlah_selesai.php')
    .then(response => response.json())
    .then(data => {
        // Mengisi nilai jumlah_selesai ke dalam elemen dengan class "number1"
        document.querySelector('.number1').textContent = data.jumlah_selesai;
    })
    .catch(error => {
        console.error('Error:', error);
    });
    </script>
    <script src="script.js"></script>

</body>

</html>