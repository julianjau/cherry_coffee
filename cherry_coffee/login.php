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
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <!-- Form login -->
    <div class="login">
      <div class="image">
          <img src="img/Frame 3.png" alt="" />
      </div>
      <div class="all-login">
          <div class="login-text">Selamat Datang</div>
          <form class="form" action="proses_login.php" method="post">
              <div class="username">
                  <input type="text" name="username" placeholder="Username" />
              </div>
              <div class="password">
                  <input type="password" name="password" placeholder="Password" />
              </div>
              <div class="submit">
                <div class="submit-btn" style="display: flex; justify-content:center;">
                  <input type="submit" value="Login" />
                </div>
              </div>
          </form>
          <div class="new">Sudah Punya akun? <a href="daftar-akun.php">Daftar Sekarang</a></div>
      </div>
    </div>
  </body>
</html>
