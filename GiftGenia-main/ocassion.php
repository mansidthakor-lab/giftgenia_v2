


<?php include 'navbar.php'; ?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Occasions - GiftGenia</title>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">

<!-- Material Icons -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

<!-- External CSS -->
<link rel="stylesheet" href="ocassion.css">
</head>

<body>

<main class="container">

<!-- HERO -->
<div class="hero">
<h1>Shop by Occasion</h1>


<form  action="result.php" method="GET">
<div class="filters">

<select name="gender">
<option value="">Gender</option>
<option value="Male">Male</option>
<option value="Female">Female</option>
<option value="Non-binary">Non-binary</option>
</select>

<select name="age">
<option value="">Age Range</option>
<option value="0-5">0-5 Years</option>
<option value="6-12">6-12 Years</option>
<option value="13-19">13-19 Years</option>
<option value="20-40">20-40 Years</option>
<option value="40-50+">40-50+ Years</option>
<!-- <option value="50+">50+ Years</option> -->
</select>

<select name="occasion">
<option value="">Occasion</option>
<option value="Birthday">Birthday</option>
<option value="Anniversary">Anniversary</option>
<option value="Wedding">Wedding</option>
<!-- <option value="Congratulations">Congratulations</option> -->
<option value="Baby Shower">Baby Shower</option>
<option value="Housewarming">Housewarming</option>
</select>

<select name="budget">
<option value="">Budget</option>
<option value="500">Under ₹500</option>
<option value="1000">₹500 - ₹1000</option>
<option value="2500">₹1000 - ₹2500</option>
<option value="5000">₹2500+</option>
<!-- <option value="10000">5000+</option> -->
</select>

<button type="submit" class="primary-btn">Find Gifts!</button>

</div>
</form>

</div>
<!-- HERO END -->



<!-- EVERYDAY CELEBRATIONS -->
<section>
<div class="section-title">
<h2>Special Celebrations</h2>
<div class="line"></div>
</div>

<div class="grid">

<div class="card">
<div class="card-img">
<img src="homepic/birthday.jpeg">
</div>
<h3>Birthdays</h3>
<a class="explore" href="result.php?occasion=Birthday">Explore Gifts →</a>
</div>

<div class="card">
<div class="card-img">
<img src="homepic/housewarming.jpeg">
</div>
<h3>Housewarmings</h3>
<a class="explore" href="result.php?occasion=Housewarming">Explore Gifts →</a>
</div>

<div class="card">
<div class="card-img">
<img src="homepic/babyshower.jpeg">
</div>
<h3>Baby Shower</h3>
<a class="explore" href="result.php?occasion=Baby Shower">Explore Gifts →</a>
</div>

</div>
</section>



<!-- MAJOR MILESTONES -->
<section>
<div class="section-title">
<h2>Major Milestones</h2>
<div class="line"></div>
</div>

<div class="grid">

<div class="card">
<div class="card-img">
<img src="homepic/wedding.jpeg">
</div>
<h3>Weddings</h3>
<a class="explore" href="result.php?occasion=Wedding">Explore Gifts →</a>
</div>

<div class="card">
<div class="card-img">
<img src="homepic/anniversary.jpeg">
</div>
<h3>Anniversaries</h3>
<a class="explore" href="result.php?occasion=Anniversary">Explore Gifts →</a>
</div>

<div class="card">
<div class="card-img">
<img src="homepic/graduation.jpeg">
</div>
<h3>Graduations</h3>
<a class="explore" href="result.php?occasion=Graduation">Explore Gifts →</a>
</div>

</div>
</section>




<footer>
<div class="footer-top">
<div class="footer-brand">
<img src="logo.png" width="40">
GiftGenia
</div>

<div class="footer-links">
<a href="#">Privacy</a>
<a href="#">Terms</a>
<a href="#">Cookies</a>
</div>



<div class="footer-bottom">
© 2026 GiftGenia. All rights reserved.
</div>
</footer>

</main>
</body>
</html>