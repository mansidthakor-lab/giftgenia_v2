<?php

session_start();
$isLoggedIn = isset($_SESSION['user_id']);
$userName = $isLoggedIn ? $_SESSION['user_name'] : "";
?>


<header>
  <div class="container header-flex">
    <div class="logo-area">
      <img src="logo.png" alt="GIFTGENIA Logo" width="50">
      GiftGenia
    </div>

    <nav class="nav-links">
      <a href="home.php">Home</a>
      <a href="ocassion.php">Occasions</a>
      <?php if (empty($hideHowItWorks)) { ?>
        <a href="howitworks.php">How it Works</a>
      <?php } ?>
      

      <?php if (!empty($showBackLink)) { ?>
            <a href="ocassion.php" class="back-btn">← Back</a>
          <?php } ?>
      <?php if ($isLoggedIn) { ?>
        <span style="margin-left:15px;">
          Welcome, <?php echo htmlspecialchars($userName); ?> |
          <a href="logout.php">Logout</a>
          
        </span>
      <?php } else { ?>
        <a href="login.php">Login</a>
      <?php } ?>
    </nav>
  </div>
</header>
