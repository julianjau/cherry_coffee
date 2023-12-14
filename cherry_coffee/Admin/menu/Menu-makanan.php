<?php

//koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "cherry_coffee");

session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
  // Jika tidak ada sesi username, redirect ke halaman login atau halaman lain yang sesuai
  header("Location: ../index.php");
  exit();
}

function getDaftarMenu()
{
    global $conn;
    $query = "SELECT * FROM data_daftar_menu_makanan_dan_minuman";
    $result = mysqli_query($conn, $query);

    $dataMenu = array();
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $dataMenu[] = $row;
        }
    }

    return $dataMenu;
}

// Fungsi untuk mendapatkan daftar menu berdasarkan kata kunci pencarian
function searchMenu($keyword)
{
    global $conn;
    $query = "SELECT * FROM data_daftar_menu_makanan_dan_minuman WHERE nama_menu LIKE '%$keyword%'";
    $result = mysqli_query($conn, $query);

    $dataMenu = array();
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $dataMenu[] = $row;
        }
    }
    return $dataMenu;
}
// Cek apakah formulir pencarian dikirimkan
if (isset($_GET['search']) && $_GET['search'] !== '') {
    $keyword = mysqli_real_escape_string($conn, $_GET['search']);
    $dataMenu = searchMenu($keyword);

    // Set variabel sesi untuk menyimpan status pencarian
    $_SESSION['search_status'] = true;
} else {
    // Jika tidak ada pencarian atau pencarian kosong, tampilkan daftar menu lengkap
    $dataMenu = getDaftarMenu();

}
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

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
                <li><a href="../dashboard.php" style="padding-top: 65px; padding-bottom:25px;">
                        <div class="icon">
                            <i class="uil uil-estate"></i>
                        </div>
                        <div class="teks">
                            <span class="link-name" style="font-size: 20px; ">Dashboard</span>
                        </div>
                    </a>
                </li>
                <li><a href="../statistik/Statistik.html">
                        <div class="icon">
                            <img src="../gambar/statistik.png" alt="">
                        </div>
                        <div class="teks">
                            <span class="link-name" style="font-size: 20px; padding-left:4px;">Statistik</span>
                        </div>
                    </a>
                </li>
                <li><a href="../data-penjualan/data Penjualan.php">
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
                        <a href="../menu/Menu-makanan.php" class="sub-item">
                            <div class="cild-sub-item">
                                <div class="circle"></div>
                                <div class="circle2"></div>
                                Makanan
                            </div>
                            
                        </a>
                        <a href="../menu/Menu-minuman.php" class="sub-item" style="margin-top: 10px;">
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
                        <a href="../transaksi/Transaksi-pesanan.php" class="sub-item">
                            <div class="cild-sub-item">
                                <div class="circle"></div>
                                <div class="circle2"></div>
                                Pesanan
                            </div>
                            
                        </a>
                        <a href="../transaksi/Transaksi-dalamproses.php" class="sub-item" style="margin-top: 10px;">
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

                <li><a href="../logout.php">
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
            <form action="" method="GET">
                <i class="uil uil-search"></i>
                <input type="text" name="search" id="search" placeholder="Search here..." autocomplete="off">
            </form>
            </div>

            <img src="../gambar/profil.png" alt="">
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title1">
                    <div class="bg-image-list">
                        <img src="../gambar/pemesanan-putih.png" alt="">
                    </div>
                    <span class="text">Menu / <small> Makanan </small></span>
                </div>
            </div>
            <!-- <form action="" method="GET">
                
                <input type="text" name="search" id="search">

            </form> -->

            <div >
                <a href="tambah-makanan.php" class="new-item">
                    <button>+ Tambah Data</button>
                </a>
            </div>

            <div class="menu-content">
                <table id="menu-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Menu</th>
                            <th>Gambar</th>
                            <th>Status</th>
                            <th>Harga</th>
                            <th style="width:130px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                        $no = 1;
                        foreach ($dataMenu as $menu) {
                            if ($menu['jenis_menu'] == 'MA') {
                                echo "<tr>";
                                echo "<td>{$no}</td>";
                                echo "<td>{$menu['nama_menu']}</td>";
                                echo "<td><img src='../../pengguna/img/{$menu['gambar']}' alt='Gambar' class='dbase-img'></td>";
                                echo "<td>{$menu['status']}</td>";
                                echo "<td>Rp. {$menu['harga']}</td>";
                                
                                echo "<div class='button-container'>";
                                echo "<td>";
                                echo "<div class='cs'>";
                                echo "<a href='edit-makanan.php?id={$menu['id_menu']}' class='edit-link'>";
                                echo "<button class='edit-btn'>Edit</button>";
                                echo "</a>";
                                echo "<div class='cc'></div>";

                                echo "<form action='hapus_makanan.php' method='post' onsubmit='return confirm(\"Apakah Anda yakin ingin menghapus menu ini?\")'>";
                                echo "<input type='hidden' name='id_menu' value='{$menu['id_menu']}'>";
                                echo "<button type='submit' class='hapus-btn'>Hapus</button>";
                                echo "</form>";
                                echo "</div>";
                                echo "</td>";
        
                                echo "</tr>";
                                $no++;
                            }
                        }
                        ?>
                    </tbody>
                </table>

            </div>

            <div class="pagination" id="pagination">
                <!-- Tombol paginasi akan ditambahkan di sini menggunakan JavaScript -->
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

        // Ambil URL saat ini
        var currentUrl = window.location.href;

        // Cek apakah parameter search ada dalam URL
        if (currentUrl.includes('?search=')) {
            // Hapus parameter search dari URL
            var newUrl = currentUrl.split('?')[0];
            window.history.replaceState({}, document.title, newUrl);
        }
    
    </script>

    <script src="../script.js"></script>
    <script src="../js2.js"></script>
</body>

</html>

