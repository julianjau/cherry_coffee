<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Selamat Datang di Cherry Coffee</title>

    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+One&family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- css -->
    <link rel="stylesheet" href="css/styles.css" />
  </head>
  <body>
    <!-- Form login -->
    <div class="login">
      <div class="image">
        <img src="img/Frame 3.png" alt="" />
      </div>
      <div class="all-login">
        <div class="login-text">Daftar Akun</div>
        <form action="proses_pendaftaran.php" method="post">
          <div class="form">
            <div class="nama">
              <input type="text" name="nama" placeholder="nama" />
            </div>
            <div class="username">
              <input type="text" name="username" placeholder="username" />
            </div>
            <div class="email">
              <input type="email" name="email" placeholder="Email" />
            </div>
            <div class="alamat">
              <input type="text" name="alamat" placeholder="Alamat" />
            </div>
            <div class="nomor-tlp">
              <input type="text" name="no_telp" placeholder="No. Telp" />
            </div>
            <div class="password">
              <input type="password" name="password" placeholder="Password" />
            </div>
            <div class="conf-pass">
              <input type="password" name="konfirmasi_password" placeholder="Konfirmasi Password" />
            </div>
          </div>
          <div class="submit" style="justify-content:center;">
              <input type="submit" value="Daftar" style="border: none; background-color: #ffffff; font-family: 'Mochiy Pop One', sans-serif;" />
          </div>
        </form>
        <div class="new">Sudah Punya akun? <a href="login.php">Login Sekarang</a></div>
      </div>
    </div>
    
  </body>
</html>
