<!-- Establishing database connection -->
<?php
$conn = new mysqli("localhost","root","","giftgenia");

if ($conn->connect_error) {
    die("DB Connection Failed: " . $conn->connect_error);
}

// Get user-selected filters from URL (GET request)
$gender   = $_GET['gender'] ?? '';
$age      = $_GET['age'] ?? '';
$occasion = $_GET['occasion'] ?? '';
$budget   = $_GET['budget'] ?? 0;

/* // Converting selected budget into SQL price condition */
if($budget == 500){
    $price = "price <= 500";
}elseif($budget == 1000){
    $price = "price BETWEEN 500 AND 1000";
}elseif($budget == 2500){
    $price = "price BETWEEN 1000 AND 2500";
}elseif($budget == 5000){
    $price = "price BETWEEN 2500 AND 5000";
}elseif($budget == 10000){
    $price = "price >= 5000";
}else{
    $price = "price >= 0";
}

// Building dynamic conditions array based on selected filters
$conditions = [];

// Apply filters only if selected

if($gender != ''){
    $conditions[] = "gender = '$gender'";  // Apply gender filter (exact match)
}

if($age != ''){
    $conditions[] = "CONCAT(',', age_range, ',') LIKE '%,$age,%'"; // Apply age filter using exact token matching to prevent incorrect partial matches
}

if($occasion != ''){
   $conditions[] = "CONCAT(',', occasion, ',') LIKE '%,$occasion,%'"; //Apply occasion filter using same safe matching logic
}

// Always apply price filter
$conditions[] = $price;

// Combine all conditions into a single WHERE clause using AND 
$where = implode(" AND ", $conditions);

//Check if user has not applied any filters
$noFilter = ($gender == '' && $age == '' && $occasion == '' && $budget == 0);

// Build SQL query dynamically based on applied filters to fetch relevant gift results
// If no filters, select random gifts within price range. If filters applied, select gifts matching all criteria.
if($noFilter){
    $sql = "SELECT MIN(id) as id, gift_name, description, price, image 
            FROM gifts
            WHERE $price
            GROUP BY gift_name
            ORDER BY RAND()";
}else{
    $sql = "SELECT * FROM gifts 
            WHERE $where
            GROUP BY gift_name
            ORDER BY RAND()";
}

$result = $conn->query($sql);

// Handle query failure
if(!$result){
    die("Query Failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Gift Results</title>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="ocassion.css">
<link rel="stylesheet" href="result.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<!-- HERO FILTER AREA -->
<div class="hero">
    <h1>Filter Gifts</h1>
    <form method="get" action="result.php">
        <div class="filters">

            <!-- Gender -->
            <select name="gender">
                <option value="">Gender</option>
                <option value="Male" <?= $gender=='Male'?'selected':'' ?>>Male</option>
                <option value="Female" <?= $gender=='Female'?'selected':'' ?>>Female</option>
                <option value="Non-Binary" <?= $gender=='Non-Binary'?'selected':'' ?>>Non-Binary</option>
            </select>

            <!-- Age Range -->
            <select name="age">
                <option value="">Age Range</option>
                <option value="0-5" <?= $age=='0-5'?'selected':'' ?>>0-5 Years</option>
                <option value="6-12" <?= $age=='6-12'?'selected':'' ?>>6-12 Years</option>
                <option value="13-19" <?= $age=='13-19'?'selected':'' ?>>13-19 Years</option>
                <option value="20-40" <?= $age=='20-40'?'selected':'' ?>>20-40 Years</option>
                <option value="40-50+" <?= $age=='40-50+'?'selected':'' ?>>40-50+ Years</option>
            </select>

            <!-- Occasion -->
            <select name="occasion">
                <option value="">Occasion</option>
                <option value="Birthday" <?= $occasion=='Birthday'?'selected':'' ?>>Birthday</option>
                <option value="Anniversary" <?= $occasion=='Anniversary'?'selected':'' ?>>Anniversary</option>
                <option value="Wedding" <?= $occasion=='Wedding'?'selected':'' ?>>Wedding</option>
                <option value="Baby Shower" <?= $occasion=='Baby Shower'?'selected':'' ?>>Baby Shower</option>
                <option value="Housewarming" <?= $occasion=='Housewarming'?'selected':'' ?>>Housewarming</option>
            </select>

            <!-- Budget -->
            <select name="budget">
                <option value="0">Budget</option>
                <option value="500" <?= $budget==500?'selected':'' ?>>Under ₹500</option>
                <option value="1000" <?= $budget==1000?'selected':'' ?>>₹500 - ₹1000</option>
                <option value="2500" <?= $budget==2500?'selected':'' ?>>₹1000 - ₹2500</option>
                <option value="5000" <?= $budget==5000?'selected':'' ?>>₹2500+</option>
            </select>

            <button type="submit" class="primary-btn">Find Gifts!</button>
        </div>
    </form>
</div>

<h2>Gift Results</h2>

<div class="grid">
<?php
if($result && $result->num_rows > 0){
    while($row = $result->fetch_assoc()){
?>
<div class="card">
    <div class="card-img">
        <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['gift_name']; ?>">
    </div>
    <div class="card-body">
        <h3><?php echo $row['gift_name']; ?></h3>
        <p><?php echo $row['description']; ?></p>
        <div class="price">₹<?php echo $row['price']; ?></div>
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
}else{
  echo "<h3 style='text-align:center;'>No gifts found 😢</h3>";
}
?>
</div>

<footer>
<div class="logo">  
  <img src="logo.png" alt="GIFTGENIA Logo" width="50">
  <h2>GiftGenia</h2>
</div>
<div class="links">
<a href="#">Privacy Policy</a>
<a href="#">Terms of Service</a>
<a href="#">Contact Us</a>
</div>
<p>© 2026 GiftGenia Inc. Boutique Gifting Experience.</p>
</footer>

</body>
</html>