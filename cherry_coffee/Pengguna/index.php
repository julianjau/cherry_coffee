<?php
//koneksi ke database
require 'koneksi.php';


session_start();

// Periksa apakah pengguna telah login
if (!isset($_SESSION['username'])) {
    // Jika tidak, alihkan pengguna kembali ke halaman login
    header("Location: ../login.php");
    exit();
}



// Ambil informasi pengguna dari database berdasarkan username yang ada di session
$username = $_SESSION['username'];
$query = "SELECT * FROM daftar_akun WHERE username='$username'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $nama = $row['nama'];
    $alamat = $row['alamat'];
    $noTelp = $row['no_telepon'];
} else {
    // Jika data pengguna tidak ditemukan, lakukan penanganan kesalahan sesuai kebutuhan
    echo "Data pengguna tidak ditemukan.";
    // Redirect atau tindakan lainnya, sesuai kebutuhan
}

// Fungsi untuk mendapatkan data daftar menu
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

$dataMenu = getDaftarMenu();

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cherry Coffee</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,700;1,100;1,700&display=swap"
      rel="stylesheet"
    />
    <link href="https://fonts.googleapis.com/css2?family=Mr+Dafoe&family=Poppins:wght@200&family=Roboto:wght@900&display=swap" rel="stylesheet">

    <!-- ikon  -->
    <script src="https://unpkg.com/feather-icons"></script>


    <!-- css -->
    <link rel="stylesheet" href="css/style.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    // Kode JavaScript yang menggunakan jQuery
    $(document).ready(function() {
      // Pastikan untuk menggunakan $.ajax setelah jQuery dimuat
      $.ajax({
        // Pengaturan ajax
      });
    });
  </script>

  </head>
  <body>
    <!-- Navbar Start -->
    <nav class="navbar">
      <a href="#" class="navbar-logo"><img src="image/CHERRY COFFEE (2)/img2.png" alt=""><div class="text">Cherry Coffee</div></a>

      <div class="navbar-nav">
        <a href="#">Home</a>
        <a href="#menu">Menu</a>
        <a href="#about">Tentang Kami</a>
        <a href="#contact">Kontak</a>
      </div>

      <div class="navbar-extra">
        <a href="#" id="shopping-cart"><i data-feather="shopping-cart"></i></a>
        <a href="#user" id="user"><i data-feather="user"></i></a>
        <a href="#hamburger-menu" id="hamburger-menu"><i data-feather="menu"></i></a>
      </div>


      <!-- Navbar End -->
  
      <!-- Profil -->
      <div class="profil">
        <div class="profil-nav">
          <div class="image">
            <img src="image/asset/profile.png" alt="profil-imgage">
          </div>
            <!-- Tampilkan informasi profil pengguna -->
            <div class="nama-profil">
                <img src="image/asset/user.png" alt="nama">
                <div class="user-profil"><?php echo $nama; ?></div>
            </div>
            <div class="nama-kontak">
                <img src="image/asset/kontak.png" alt="nama">
                <div class="user-kontak"><?php echo $noTelp; ?></div>
            </div>
            <div class="nama-alamat">
                <img src="image/asset/alamat.png" alt="nama">
                <div class="user-alamat"><?php echo $alamat; ?></div>
            </div>
            <div class="logout">
                <a href="logout.php">Log Out</a>
            </div>
        </div>
    </div>
      <!-- Profil End-->

      <!-- shopping -->
      <div class="shopping">
        <div class="chart-shop">
          <div class="shopping-add">Pembelian</div>
            <div class="scroll">
              <div class="keranjang-belanja">
                <!-- <div class="img-produk">
                    <img src="" alt="" class="checkout-gambar">
                </div>
                <div class="ket-produk">
                    <div class="produk-info">
                        <p class="Menu-jenis"></p>
                        <p class="Menu-harga"></p>
                    </div> -->
                    <!-- <div class="jumlah">
                        <div class="min">
                            <a href="#"><i data-feather="minus"></i></a>
                        </div>
                        <div class="box-jumlah">
                          1
                        </div>
                        <div class="plus">
                            <a href="#"><i data-feather="plus"></i></a>
                        </div>
                    </div>   -->
              </div>
            </div>


            <!-- chekout -->
              <section class="chck">
                <div class="checkout">
                  <div class="status-pemesanan" style="display:none;">
                    Status : Sedang di proses
                  </div>
                  <div class="ch-now">
                    <div class="konfirmasi">
                      <a href="#" class="item-conf-btn" ><p>Beli Sekarang</p></a>
                    </div>
                    <div class="cancel" style="cursor : pointer;">
                      <a href="#"><i data-feather="x"></i></a>
                    </div>
                  </div>
                </div>
              </section>
         </div>
      </div>
      <!-- Profil End-->
    </nav>



    <!-- Hero Section Start -->
    <section class="hero" id="home">
        <main class="content">
            <h1>Selamat Datang Di Cherry <span>Coffee</span></h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat, repudiandae.</p>
            <a href="#menu" class="cta">Beli Sekarang</a>
        </main>
    </section>
    <!-- Hero Section End -->

    <!-- Menu section Start -->
    <section id = "menu" class= "menu">
      <h2>Menu Makanan</h2>
      
      <div class="row">

      <?php
  foreach ($dataMenu as $menu) {
    if ($menu['jenis_menu'] == 'MA') {
        echo "<div class='menu-card' id='menu-{$menu['id_menu']}' data-status='{$menu['status']}'>";
        echo "<img src='img/{$menu['gambar']}' alt='{$menu['nama_menu']}' class='menu-card-img'>";
        echo "<h3 class='menu-card-makanan'>{$menu['nama_menu']}</h3>";
        echo "<p class='menu-card-harga'>Rp.{$menu['harga']}</p>";
        // Tidak menampilkan status, tetapi menyimpannya dalam atribut data
        echo "</div>";
    }
}
      ?>
      </div>
    </section>


    <section id = "menu" class= "menu">
      <h2>Menu Minuman</h2>
      
      <div class="row">
      <?php
foreach ($dataMenu as $menu) {
  if ($menu['jenis_menu'] == 'MU') {
      echo "<div class='menu-card' id='menu-{$menu['id_menu']}' data-status='{$menu['status']}'>";
      echo "<img src='img/{$menu['gambar']}' alt='{$menu['nama_menu']}' class='menu-card-img'>";
      echo "<h3 class='menu-card-minuman'>{$menu['nama_menu']}</h3>";
      echo "<p class='menu-card-harga'>Rp.{$menu['harga']}</p>";
      // Tidak menampilkan status, tetapi menyimpannya dalam atribut data
      echo "</div>";
  }
}
    ?> 
        
      </div>
    </section>


    
    <section id="about" class="About">
        <h2>Tentang Kami</h2>
        <div class="row">
          <div class="content">
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Earum corporis quam, culpa mollitia quae quisquam iusto hic quas enim suscipit.</p>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus magni odio obcaecati fugiat distinctio maiores modi similique praesentium labore quisquam, repellendus quidem saepe aut ipsa, rem aliquid veritatis at neque ratione sunt temporibus delectus. Consequatur inventore labore praesentium officiis laborum in possimus asperiores deleniti ducimus similique minima, debitis fugiat, a corrupti blanditiis ullam temporibus cupiditate. Blanditiis rem quisquam sapiente quo, dolores labore cumque praesentium sit eos consectetur sequi ea obcaecati adipisci explicabo, minima inventore repellendus eveniet perferendis magni dolorem similique totam quibusdam quasi. Iure aut dicta iste nihil deserunt, odit repudiandae! Eum quaerat, vero nesciunt id repellendus excepturi sit incidunt.</p>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ullam fugit debitis itaque eaque dolores animi dolor deleniti nobis ratione vel odio iure sint est voluptates delectus nostrum, vero distinctio voluptas voluptatem. Aperiam vel soluta corrupti accusantium recusandae nostrum magnam nulla quas neque nisi debitis amet quod, iste, laudantium distinctio dolorum!</p>
            <!-- <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Corporis aperiam dolorem omnis voluptatum hic error placeat. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Consequatur, dolorem. Doloremque perspiciatis quod nobis sed, et nemo error totam quam iure, officiis, corrupti commodi velit culpa. Ducimus possimus necessitatibus consectetur quod eos dolores cum aliquid, ad nisi ea error iusto, adipisci optio! Quae optio perferendis natus, mollitia earum iste nisi deserunt ea deleniti iusto labore placeat dolorum esse suscipit voluptate iure amet dolore officia. Labore, possimus vitae. Nam, commodi consectetur. Alias, esse consequatur! Porro sed cumque dolores quas deserunt, vero quae totam molestias, non eos necessitatibus illo id sapiente nam tempora possimus quod eaque eum debitis sequi. Voluptatem, obcaecati doloribus. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Praesentium modi voluptatem eveniet? Maiores omnis ex pariatur at. Deleniti qui porro accusamus veniam excepturi veritatis quisquam reprehenderit autem temporibus repudiandae laudantium beatae vel magni, dolores sint? Veniam, saepe deleniti! Rerum veritatis blanditiis tempore necessitatibus aperiam iste deleniti facilis similique minima soluta odit quo cum, amet doloribus et qui alias obcaecati aspernatur quas incidunt aliquam consequuntur? Eum, exercitationem ducimus voluptatibus id doloribus, nesciunt labore accusantium fugiat assumenda animi ullam explicabo provident pariatur eius et in hic ut impedit magnam odio! Quam aut repellat alias quos earum dolor impedit libero reiciendis quibusdam odit?</p> -->
          </div>
          <div class="about-img">
            <img src="image/img-tentang-kami.png" alt="Tentang kami">
          </div>
        </div>
      
      </section>
      <!-- About end -->

      <!-- kontak start -->
      <section id="contact" class="contact">
        <h2><span>Kontak</span> Kami</h2>    
        <div class="row">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d997.3336344429805!2d104.48096606952907!3d0.8922582408862351!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d96d4ff42f44c9%3A0xd8d26cf375174f28!2sCherry%20Coffee!5e0!3m2!1sid!2sid!4v1699699196636!5m2!1sid!2sid"
            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="map"></iframe>
    
          <form action="">
            <div class="text-kontak"><h3>Nama</h3></div>
            <div class="input-group">
              <input type="text">
            </div>
            <div class="text-kontak"><h3>Email</h3>
            <div class="input-group">
              <input type="text">
            </div>
            <div class="text-kontak"><h3>Masukkan</h3>
            <div class="input-group">
              <input type="text">
            </div>
            <div class="submit">
              <button type="submit" class="btn">kirim pesan</button>
            </div>
          </form>
        </div>
      </section>

      
      <!-- kontak end -->

      <!-- Footer start -->
  <footer>
    <div class="socials">
      <a href="#"><i data-feather="instagram"></i></a>
      <a href="#"><i data-feather="twitter"></i></a>
      <a href="#"><i data-feather="facebook"></i></a>
    </div>

    <div class="links">
      <a href="#home">Home</a>
      <a href="#about">Tentang Kami</a>
      <a href="#menu">Menu</a>
      <a href="#contact">Kontak</a>
    </div>
  </footer>
  <!-- Footer end -->


      <!-- pop UP checkout
      <div class="beli" id="makanan-ini">
        <div class="beli-container">
          <div class="beli-konten">
            Konfirmasi Pembelian
          </div>
          <div class="konfirmasi">
            <div class="setuju">
              <a href="#" class="setuju-btn" >Konfirmasi</a>
            </div>
            <div class="batal">
              <a href="#" class="batal-btn" >Batal</a>
            </div>
          </div>
        </div>
      </div>
   -->

      <!-- pop UP cmenu -->

<!-- Struktur HTML untuk pop-up menu yang diubah -->


<div class="pop-up-menu">
    <div class="menu-container">
        <div class="menu-details">
            <div class="gambar-makanan">
                <img src="" alt="Gambar Makanan" class="menu-image">
            </div>
            <div class="harga">
                <div class="harga-menu">
                    <p class="menu-jenis"></p>
                    <p class="menu-harga"></p>
                </div>
                <div class="status-menu">
                    <p class="menu-status"></p>
                </div>
            </div>
        </div>
        <div class="menu-actions">
            <div class="konfirmasi">
                <button>Konfirmasi</button>
            </div>
            <div class="batal">
                <button class="close-btn">Batal</button>
            </div>
        </div>
    </div>
</div>


    <!-- ikon -->
    <script>
      feather.replace();
    </script>
    <!-- java script -->
    <script src="js/script.js">

    </script>
  </body>
</html>
