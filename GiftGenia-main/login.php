<?php
session_start();
include "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST['email']) || empty($_POST['password'])) {
        $message = "Email and password are required!";
    } else {

        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = $_POST['password'];

        $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

        if (mysqli_num_rows($query) == 1) {

            $user = mysqli_fetch_assoc($query);

            if (password_verify($password, $user['password'])) {

                // Login success
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['full_name'];

                // Redirect to home page
                header("Location: home.php"); 
                exit();

            } else {
                $message = "Incorrect password!";
            }

        } else {
            $message = "Email not registered!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - GiftGenia</title>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="login.css">

</head>
<body>

<div class="container">

  <!-- LEFT PANEL -->
  <div class="left-panel">
    <img src="logo.png" class="big-logo-top" alt="Logo">
    <img src="logo.png" class="big-logo-bottom" alt="Logo">

    <div class="left-content">
      <div class="quote-icon">
        <img src="logo.png" class="quote-logo" alt="Logo">
      </div>
      <h2>"The excellence of a gift lies in its appropriateness rather than its value."</h2>
      <p>— Charles Dudley Warner</p>
    </div>
  </div>

  <!-- RIGHT PANEL -->
  <div class="right-panel">

    <div class="brand">
      <div class="brand-icon">
        <img src="logo.png" width="50">
      </div>
      <h1>GiftGenia</h1>
    </div>

    <div class="welcome">
      <h2>Welcome back</h2>
      <p>Please enter your details to sign in.</p>
    </div>

    <?php if ($message != "") { ?>
      <p style="color:red;"><?php echo $message; ?></p>
    <?php } ?>

    <form method="POST">

      <div class="input-group">
        <label>Email Address</label>
        <input type="email" name="email" placeholder="name@company.com" required>
      </div>

      <div class="input-group">
        <div class="forgot-wrap">
          <label>Password</label>
          <a href="#">Forgot Password?</a>
        </div>
        <input type="password" name="password" placeholder="••••••••" required>
      </div>

      <button type="submit" class="submit-btn">Login</button>
    </form>

    <div class="divider">
      <div class="divider-line"></div>
      <div class="divider-text">Or continue with</div>
    </div>

    <p class="signup-text">
      Don't have an account?
      <a href="registration.php">Sign up</a>
    </p>

  </div>
</div>

</body>
</html>
