<?php
include "db.php";

$message = "";
$message_color = "red";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (
        !isset($_POST['fullname']) ||
        !isset($_POST['email']) ||
        !isset($_POST['password'])
    ) {
        $message = "All fields are required!";
    } else {

        $name = trim($_POST['fullname']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        if ($name === "" || $email === "" || $password === "") {
            $message = "All fields are required!";
        } else {

            $name = mysqli_real_escape_string($conn, $name);
            $email = mysqli_real_escape_string($conn, $email);

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $check = mysqli_query(
                $conn,
                "SELECT id FROM users WHERE email='$email'"
            );

            if (!$check) {
                $message = "Database error!";
            } elseif (mysqli_num_rows($check) > 0) {
                $message = "Email already registered!";
            } else {

                $insert = mysqli_query(
                    $conn,
                    "INSERT INTO users (full_name, email, password)
                     VALUES ('$name', '$email', '$hashed_password')"
                );

                if ($insert) {
                    $message = "Registration successful!";
                    $message_color = "green";
                } else {
                    $message = "Registration failed!";
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sign Up - GiftGenia</title>

<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
<link rel="stylesheet" href="registration.css">
</head>
<body>

<div class="container">

  <!-- LEFT PANEL -->
  <div class="left-panel">
    <div class="bg"></div>
    <div class="overlay"></div>
    <div class="left-content">
      <div class="logo">
        <img src="logo.png" alt="GIFTGENIA Logo" width="50">
        GiftGenia
      </div>
      <div>
        <h1>The art of giving,<br>perfected for you.</h1>
        <p>Join thousands of thoughtful gifters and never miss a special moment again.</p>
      </div>
      <div class="footer">© 2025 GiftGenia.</div>
    </div>
  </div>

  <!-- RIGHT PANEL -->
  <div class="right-panel">
    <div class="form-box">

      <div class="brand-small">
        <div style="background:rgba(164,19,236,.1);padding:.5rem;border-radius:.5rem;">
          <span class="material-symbols-outlined">card_giftcard</span>
        </div>
        <span>GiftGenia</span>
      </div>

      <h2 class="title">Create Account</h2>
      <p class="subtitle">Join our community of thoughtful gift-givers today.</p>

      <?php if ($message != "") { ?>
        <p style="color:<?php echo $message_color; ?>;">
            <?php echo $message; ?>
        </p>
      <?php } ?>

      <form method="POST" action="">

        <label>Full Name</label>
        <input type="text" name="fullname" placeholder="John Doe" required>

        <label>Email Address</label>
        <input type="email" name="email" placeholder="john@example.com" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="••••••••" required>
        
        <div class="terms">
          <input type="checkbox" required>
          <label>I agree to the <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a></label>
        </div>

        <button type="submit" class="btn-primary">Create Account</button>
      </form>

      <p class="footer-text">Already have an account? <a href="login.php">Log in</a></p>

    </div>
  </div>

</div>

</body>
</html>
