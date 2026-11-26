<?php include 'navbar.php'; ?>

<?php
$conn = new mysqli("localhost","root","","giftgenia");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Fetch 4 random gifts
$sql = "SELECT * FROM gifts ORDER BY RAND() LIMIT 4";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>GiftGenia – Gift-giving, simplified.</title>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">

<!-- Material Icons -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

<!-- External CSS -->
<link rel="stylesheet" href="home.css">
</head>

<body>

<section class="hero">
  <div class="hero-text">
    <h1>Gift-giving, simplified.</h1>
    <p>Discover the perfect present for every person and any occasion with curated recommendations.</p>
    <div class="hero-buttons">
      <button class="primary-btn" onclick="window.location.href='ocassion.php'">Start Finding</button>
      <button class="secondary-btn" onclick="window.location.href='howitworks.php'">How it Works</button>
    </div>
  </div>
  <div class="hero-image"></div>
</section>

<div class="occasion-container">

  <div class="tag" onclick="window.location.href='result.php?occasion=Birthday'">
    <span class="material-symbols-outlined">cake</span>
    <p>Birthday</p>
  </div>

  <div class="tag" onclick="window.location.href='result.php?occasion=Anniversary'">
    <span class="material-symbols-outlined">favorite</span>
    <p>Anniversary</p>
  </div>

  <div class="tag" onclick="window.location.href='result.php?occasion=Wedding'">
    <span class="material-symbols-outlined">celebration</span>
    <p>Wedding</p>
  </div>

  <div class="tag" onclick="window.location.href='result.php?occasion=Graduation'">
    <span class="material-symbols-outlined">school</span>
    <p>Graduation</p>
  </div>

  <div class="tag" onclick="window.location.href='result.php?occasion=Baby%20Shower'">
    <span class="material-symbols-outlined">sentiment_satisfied</span>
    <p>Baby Shower</p>
  </div>

</div>

<section class="top-rated-section">

  <div class="header-row">
    <div>
      <h2>Top Rated Gifts</h2>
      <p>Our most-loved picks this month</p>
    </div>
    <a href="result.php" class="view-all">View all →</a>
  </div>

  <div class="product-grid">

  <?php
  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
  ?>
      <div class="product-card">
        <div class="image-wrap">
          <img src="<?php echo $row['image']; ?>" alt="gift">
        </div>

        <div class="card-body">
          <h3><?php echo $row['gift_name']; ?></h3>
          <p class="category"><?php echo $row['description']; ?></p>
          <span class="price">₹<?php echo $row['price']; ?></span>
          <form method="POST" action="payment.php">
             <input type="hidden" name="name" value="<?php echo $row['gift_name']; ?>">
             <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
             <input type="hidden" name="image" value="<?php echo $row['image']; ?>">
             <input type="hidden" name="qty" value="1">

             <button type="submit" class="btn">View Gift</button>
          </form>
        </div>
      </div>
  <?php
      }
  } else {
      echo "<p>No gifts found</p>";
  }
  ?>

  </div>
</section>

<!-- MILESTONE SUBSCRIBE SECTION -->
<section class="milestone-section">
  <div class="milestone-box">

    <span class="material-symbols-outlined mail-icon">mail</span>

    <h2>Never miss a milestone.</h2>

    <p>
      Get your personalized gift ideas and reminder alerts for upcoming
      birthdays and anniversaries.
    </p>

    <div class="milestone-form">
      <input type="email" placeholder="Your email address">
      <button>Join Us</button>
    </div>

  </div>
</section>

<footer>
  <div class="footer-top">
    <div class="footer-brand">
      <img src="logo.png" width="30">
      GiftGenia
    </div>
    
    <div class="footer-links">
      <a href="#">Privacy</a>
      <a href="#">Terms</a>
      <a href="#">Cookies</a>
    </div>
  
  </div>
  <div class="footer-bottom">
    © 2026 GiftGenia. All rights reserved.
  </div>
</footer>

</body>
</html>