<?php
session_start();

// Store product from result.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['product'] = [
        'name'  => $_POST['name'],
        'price' => $_POST['price'],
        'image' => $_POST['image'],
        'qty'   => $_POST['qty']
    ];
}

$product = $_SESSION['product'] ?? null;

if (!$product) {
    echo "No product selected!";
    exit();
}

// Calculations
$subtotal = $product['price'] * $product['qty'];
$shipping = 49;
$tax = 0;
$total = $subtotal + $shipping + $tax;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Secure Checkout - GiftGenia</title>

<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet"/>

<link rel="stylesheet" href="payment.css">

<script>
function selectTab(method) {
  document.querySelectorAll(".tab").forEach(t=>t.classList.remove("selected"));
  document.getElementById("tab-"+method).classList.add("selected");

  document.querySelectorAll(".card-fields,.upi-fields,.cod-fields")
    .forEach(s=>s.classList.remove("show"));

  document.querySelector("."+method+"-fields").classList.add("show");
}
</script>

</head>

<body>

<header>
  <div class="header-inner">
    
    <div class="logo-area">
      <img src="logo.png" width="50">
      GiftGenia
    </div>

    <!-- RIGHT SIDE: Back + Secure -->
    <div style="display:flex;align-items:center;gap:10px;">
      
      <button onclick="history.back()" 
        style="width:auto;padding:8px 16px;font-size:13px;background:#a413ec;color:white;border:none;border-radius:20px;cursor:pointer;">
        ← Back
      </button>

      <div class="secure-badge">
        <span class="material-symbols-outlined" style="font-size:14px;">lock</span>
        Secure Checkout
      </div>

    </div>

  </div>
</header>

<main class="container">

  <!-- ORDER SUMMARY -->
  <aside class="aside-box">
    <div class="card">
      <h3>Order Summary</h3>

      <div class="order-item">
        <img src="<?= $product['image'] ?>">
        <div>
          <div class="order-name"><?= $product['name'] ?></div>
          <div style="font-size:12px;color:#6b7280;">Qty: <?= $product['qty'] ?></div>
          <div class="order-price">₹<?= number_format($product['price'],2) ?></div>
        </div>
      </div>

      <div class="summary-line">
        <span>Subtotal</span>
        <span>₹<?= number_format($subtotal,2) ?></span>
      </div>

      <div class="summary-line">
        <span>Shipping</span>
        <span>₹<?= number_format($shipping,2) ?></span>
      </div>

      <div class="summary-line">
        <span>Tax</span>
        <span>₹<?= number_format($tax,2) ?></span>
      </div>

      <div class="summary-total">
        <span style="font-size:18px;font-weight:700;">Total</span>
        <span>₹<?= number_format($total,2) ?></span>
      </div>
    </div>
  </aside>

  <!-- FORM -->
  <div class="form-area">
    <form>

      <!-- Shipping -->
      <div class="section">
        <h3>
          <span class="material-symbols-outlined" style="color:var(--primary);">location_on</span>
          Shipping Address
        </h3>

        <div class="field">
          <label>Full Name</label>
          <input type="text" required>
        </div>

        <div class="field">
          <label>Address Line 1</label>
          <input type="text" required>
        </div>

        <div class="field">
          <label>Address Line 2</label>
          <input type="text">
        </div>

        <div class="field-grid">
          <div class="field">
            <label>City</label>
            <input type="text" required>
          </div>

          <div class="field">
            <label>State</label>
            <input type="text" required>
          </div>
        </div>

        <div class="field">
          <label>ZIP Code</label>
          <input type="text" required>
        </div>
      </div>

      <!-- Payment -->
      <div class="section">
        <h3>
          <span class="material-symbols-outlined" style="color:var(--primary);">payments</span>
          Payment Details
        </h3>

        <div class="payment-tabs">
          <label id="tab-card" class="tab" onclick="selectTab('card')">
            <input type="radio" name="payment">
            <span class="material-symbols-outlined">credit_card</span>
            Card
          </label>

          <label id="tab-upi" class="tab selected" onclick="selectTab('upi')">
            <input type="radio" name="payment" checked>
            <span class="material-symbols-outlined">account_balance_wallet</span>
            UPI
          </label>

          <label id="tab-cod" class="tab" onclick="selectTab('cod')">
            <input type="radio" name="payment">
            <span class="material-symbols-outlined">local_shipping</span>
            COD
          </label>
        </div>

        <!-- Card -->
        <div class="card-fields">
          <div class="field">
            <label>Cardholder Name</label>
            <input type="text">
          </div>

          <div class="field">
            <label>Card Number</label>
            <input type="text">
          </div>
        </div>

        <!-- UPI -->
        <div class="upi-fields show">
          <div class="field">
            <label>UPI ID</label>
            <input type="text">
          </div>

          <div class="qr-box">
            <div style="font-size:10px;font-weight:700;margin-bottom:12px;">Scan & Pay</div>

          <?php
         $upi_id = "yourupi@okbank"; // change this
         $name = "GiftGenia";
         $amount = $total;

$qr_url = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=upi://pay?pa=$upi_id&pn=$name&am=$amount&cu=INR";
?>

<img src="<?= $qr_url ?>" width="120">

            <div style="margin-top:12px;font-size:11px;color:#6b7280;">
              Scan with any UPI app
            </div>
          </div>
        </div>

        <!-- COD -->
        <div class="cod-fields">
          <div style="display:flex;gap:12px;border-radius:12px;padding:16px;background:rgba(164,19,236,0.08);border:1px solid rgba(164,19,236,0.25);">
            <span class="material-symbols-outlined" style="color:var(--primary);">info</span>
            <div>
              <div style="font-weight:700;color:var(--primary);margin-bottom:4px;">Cash on Delivery</div>
              <div style="font-size:14px;color:#4b5563;">Pay on arrival</div>
            </div>
          </div>
        </div>

        <div style="margin-top:24px;">
          <button type="submit">
            Pay & Place Order
            <span class="material-symbols-outlined">local_shipping</span>
          </button>

          <div style="text-align:center;font-size:11px;color:#6b7280;margin-top:12px;">
            By clicking this button, you agree to our terms.
          </div>
        </div>

      </div>

    </form>
  </div>

</main>

<footer>
  <div class="footer-logos">
    <img src="https://via.placeholder.com/80">
    <img src="https://via.placeholder.com/80">
    <img src="https://via.placeholder.com/80">
  </div>

  <p>© 2026 GiftGenia.</p>
</footer>

</body>
</html>