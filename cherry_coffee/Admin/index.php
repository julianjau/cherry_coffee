<?php

session_start();

include 'koneksi.php'; // Include the database connection file

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query to check if the entered username and password exist in the database
    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Check if a row is returned (valid username and password)
        if (mysqli_num_rows($result) == 1) {
            // Fetch user data and store it in the session
            $_SESSION['username'] = $username;

            // Redirect to the dashboard.php page upon successful login
            header("Location: dashboard.php");
            exit();
        } else {
            // Invalid username or password, show an alert
            echo '<script>alert("Username or password is incorrect. Please try again.");</script>';
        }
    } else {
        // Error in the query
        echo '<script>alert("Error in the query.");</script>';
    }
    // Close the database connection
    mysqli_close($conn);
}
?>

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
    <link rel="stylesheet" href="style2.css" />
  </head>
  <body>
    <!-- Form login -->
    <div class="login">
      <div class="image">
        <img src="gambar/Frame 3.png" alt="" />
      </div>
      <div class="all-login">
        <div class="login-text">Selamat Datang</div>
        <div class="form">
          <form method="post" action="">
          <div class="username">
            <input type="text" name="username" placeholder="Username" />
          </div>
          <div class="password">
            <input type="password" name="password" placeholder="Password" />
          </div>
        </div>
        <div class="submit">
        <button type="submit">Login</button>
        </div>
        </form>
      </div>
    </div>
  </body>
</html>
