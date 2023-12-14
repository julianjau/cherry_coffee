<?php
// Koneksi ke database
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

// Query untuk mendapatkan data dari tabel pemesanan
$query = "SELECT * FROM pemesanan WHERE status = 'baru' ORDER BY id_pesanan DESC";


$result = mysqli_query($conn, $query);

// Periksa apakah query berhasil dieksekusi
if (!$result) {
    die("Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Mr+Dafoe&family=Poppins:wght@200&family=Roboto:wght@900&display=swap"
        rel="stylesheet">
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="../transaksi/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

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
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here...">
            </div>

            <img src="../gambar/profil.png" alt="">
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title1">
                    <div class="bg-image-tr">
                        <img src="../gambar/keranjang-putih.png" alt="">
                    </div>
                    <span class="text">Transaksi / Pesanan</span>
                </div>

                <div class="menu-content">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>No.HP</th>
                                <th>Tanggal</th>
                                <th>Nama Menu</th>
                                <th>Jumlah </th>
                                <th style="width:150px ;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        // Perulangan untuk menampilkan data dari tabel pemesanan
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                    <tr>
                        <td><?php echo $row['Username']; ?></td>
                        <td><?php echo $row['alamat']; ?></td>
                        <td><?php echo $row['no_telepon']; ?></td>
                        <td><?php echo $row['tanggal']; ?></td>
                        <td><?php echo $row['nama_menu']; ?></td>
                        <td><?php echo $row['jumlah_pesanan']; ?></td>
                        <td>
                        <select name="status" onchange="updateStatus(<?php echo $row['id_pesanan']; ?>, this.value)">
                        <option value="baru" <?php echo ($row['status'] == 'baru') ? 'selected' : ''; ?>>
                        Baru
                        </option>
                            <option value="diterima" <?php echo ($row['status'] == 'diterima') ? 'selected' : ''; ?>>
                                Diterima
                            </option>
                            <option value="tidak_diterima" <?php echo ($row['status'] == 'tidak_diterima') ? 'selected' : ''; ?>>
                                Tidak Diterima
                            </option>

                            <!-- Opsi lainnya -->
                        </select>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>

                        </tbody>
                    </table>

                </div>
            </div>

        </div>

    </section>

    <script src="../script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $(document).ready(function () {
            //jquery for toggle sub menus
            $('.sub-btn').click(function () {
                $(this).next('.sub-menu').slideToggle('');
                $(this).find('.dropdown').toggleClass('rotate');
            });
        });
        
        function updateStatus(id_pesanan, newStatus) {
    // Kirim permintaan AJAX ke server untuk memperbarui status pesanan
    fetch('update_status.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'id_pesanan=' + id_pesanan + '&new_status=' + newStatus,
    })
    .then(response => response.json())
    .then(data => {
        // Handle respons dari server jika diperlukan
        console.log(data);
        // Refresh halaman jika perlu
        location.reload();
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

    </script>
</body>

</html>