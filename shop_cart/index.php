<?php
session_start();
$conn = new mysqli("localhost", "root", "", "shop_cart");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$is_logged_in = isset($_SESSION["user_id"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart | Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Header -->
<div class="header">
    <div class="header-title">🛍️ Welcome to Our Store</div>
    <div class="header-right">
        <?php if ($is_logged_in): ?>
            Hello, <?= $_SESSION["username"] ?> | <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a> | <a href="register.php">Register</a>
        <?php endif; ?>
    </div>
</div>

<!-- Hero Section -->
<div class="hero">
    <h1>Discover Amazing Products</h1>
    <p>Shop the latest trends and get the best deals.</p>
    <a href="products.php" class="shop-btn">Shop Now</a>
</div>

<!-- Product Showcase -->
<div class="container">
    <h2 style="text-align: center; margin-top: 40px;">Featured Products</h2>
    <div class="products">
        <div class="product-card">
            <img src="smartphone.png" alt="smartphone" class="product-image">
            <h3>Smartphone</h3>
            <p class="price">₱25,000</p>
            
        </div>
        <div class="product-card">
            <img src="laptop.png" alt="laptop" class="product-image">
            <h3>Laptop</h3>
            <p class="price">₱45,000</p>
            
        </div>
        <div class="product-card">
            <img src="headphone.png" alt="headphone" class="product-image">
            <h3>Headphones</h3>
            <p class="price">₱5,000</p>
            
        </div>
    </div>
</div>

<!-- Cart Link -->
<div class="cart-link">
    <a href="cart.php">🛒 View Cart</a>
</div>

<!-- Footer -->
<div class="footer">© 2025 Your Shop | All Rights Reserved</div>

</body>
</html>

<?php $conn->close(); ?>
