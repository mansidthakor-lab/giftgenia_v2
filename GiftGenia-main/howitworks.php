<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html lang="en" class="light">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>GiftGenia - How it Works</title>

<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
<!-- Material Icons -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
<!-- External CSS -->
<link rel="stylesheet" href="howitworks.css">
</head>
<body>

<!-- ---------- MAIN ---------- -->
<main>
    <section>
        <h1 class="hero-title">Finding the Perfect Gift is Simple</h1>
        <p class="hero-text">
           We help you discover the perfect gifts by filtering options based on your needs and preferences.
        </p>
    </section>

    <section class="steps">
        <div class="step">
            <div class="step-icon">
                <span class="material-symbols-outlined">quiz</span>
            </div>
            <h3 class="step-title">1. Tell us about them</h3>
            <p class="step-desc">
                Answer a few quick questions about their personality, hobbies, and the occasion. It only takes 60 seconds.
            </p>
        </div>
        <div class="step">
            <div class="step-icon">
                <span class="material-symbols-outlined">psychology</span>
            </div>
            <h3 class="step-title">2. Smart Gift Filtering</h3>
            <p class="step-desc">
               Our system filters a wide range of gifts based on your selected preferences to find the most suitable options.
            </p>
        </div>
        <div class="step">
            <div class="step-icon">
                <span class="material-symbols-outlined">celebration</span>
            </div>
            <h3 class="step-title">3. Give with Confidence</h3>
            <p class="step-desc">
                Choose from a curated shortlist of perfect matches and watch them unwrap something they'll truly love.
            </p>
        </div>
    </section>

    <section class="why">
        <h2 class="why-title">Why Choose GiftGenia?</h2>
        <div class="why-grid">
            <div class="why-item">
                <div class="why-icon"><span class="material-symbols-outlined">schedule</span></div>
                <div>
                    <h4 class="why-item-title">Save Time</h4>
                    <p class="why-item-text">No more endless scrolling through generic store pages.</p>
                </div>
            </div>
            <div class="why-item">
                <div class="why-icon"><span class="material-symbols-outlined">verified</span></div>
                <div>
                    <h4 class="why-item-title">Curated Quality</h4>
                    <p class="why-item-text">Every recommendation is vetted for quality and uniqueness.</p>
                </div>
            </div>
            <div class="why-item">
                <div class="why-icon"><span class="material-symbols-outlined">payments</span></div>
                <div>
                    <h4 class="why-item-title">Budget Friendly</h4>
                    <p class="why-item-text">Find something amazing at any price point you set.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section">
      <button class="cta-btn" onclick="window.location.href='ocassion.php'">Try it Now</button>
        <p class="cta-text">Free to use. No credit card required.</p>
    </section>
</main>

<!-- ---------- FOOTER ---------- -->
<footer>
  <div class="footer-top">
    <div class="footer-brand">
      <img src="logo.png" alt="GIFTGENIA Logo" width="50">
      GiftGenia
    </div>
    <div class="footer-links">
      <a href="#">Privacy</a>
      <a href="#">Terms</a>
      <a href="#">Cookies</a>
    </div>
    <!-- <div class="footer-icons">
      <span class="material-symbols-outlined">volume_up</span>
      <span class="material-symbols-outlined">share</span>
    </div> -->
  </div>
  <div class="footer-bottom">
    © 2026 GiftGenia. All rights reserved.
  </div>
</footer>


</body>
</html>
