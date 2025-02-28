<?php
session_start();
$conn = new mysqli("localhost", "root", "", "shop_cart");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch unique products from the database
$result = $conn->query("SELECT * FROM products ORDER BY name ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Products</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Header */
        .header {
            background: #007bff;
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            margin-left: 15px;
            transition: 0.3s;
        }

        .header a:hover {
            text-decoration: underline;
            opacity: 0.8;
        }

        /* Hero Section */
        .hero {
            background: url('products-banner.jpg') center/cover no-repeat;
            color: white;
            text-align: center;
            padding: 80px 20px;
            font-size: 28px;
            font-weight: bold;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
        }

        /* Products Grid */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 40px 20px;
        }

        .product-card {
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .product-card img {
            width: 100%;
            max-height: 160px;
            object-fit: contain;
            border-radius: 8px;
            padding: 10px;
            background: #fff;
        }

        .product-card h3 {
            font-size: 18px;
            margin: 10px 0;
        }

        .product-card .price {
            font-size: 16px;
            color: #28a745;
            font-weight: bold;
        }

        .product-card a {
            display: inline-block;
            background: #007bff;
            color: white;
            padding: 10px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            transition: 0.3s;
        }

        .product-card a:hover {
            background: #0056b3;
        }

        /* Footer */
        .footer {
            background: #333;
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 16px;
            margin-top: 40px;
        }
    </style>
</head>
<body>

<!-- Header -->
<div class="header">
    <div>🛍️ Our Products</div>
    <div>
        <a href="index.php">Home</a>
        <?php if (isset($_SESSION["user_id"])): ?>
            Hello, <?= htmlspecialchars($_SESSION["username"]) ?> | <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a> | <a href="register.php">Register</a>
        <?php endif; ?>
        <a href="cart.php">🛒 Cart</a>
    </div>
</div>

<!-- Hero Section -->
<div class="hero">
    <h1>Explore Our Exclusive Products</h1>
</div>

<!-- Product Showcase -->
<div class="container">
    <h2 style="text-align: center; margin-top: 40px;">Available Products</h2>
    <div class="products-grid">

        <!-- Laptop -->
        <div class="product-card">
            <img src="laptop.png" alt="Laptop">
            <h3>Laptop</h3>
            <p class="price">₱45,000</p>
            <a href="add_to_cart.php?product_id=1" class="btn">Add to Cart</a>
        </div>

        <!-- Smartphone -->
        <div class="product-card">
            <img src="smartphone.png" alt="Smartphone">
            <h3>Smartphone</h3>
            <p class="price">₱25,000</p>
            <a href="add_to_cart.php?product_id=2" class="btn">Add to Cart</a>
        </div>

        <!-- Headphones -->
        <div class="product-card">
            <img src="headphone.png" alt="Headphones">
            <h3>Headphones</h3>
            <p class="price">₱5,000</p>
            <a href="add_to_cart.php?product_id=3" class="btn">Add to Cart</a>
        </div>

        <!-- Smartwatch -->
        <div class="product-card">
            <img src="smartwatch.png" alt="Smartwatch">
            <h3>Smartwatch</h3>
            <p class="price">₱12,000</p>
            <a href="add_to_cart.php?product_id=4" class="btn">Add to Cart</a>
        </div>

        <!-- Tablet -->
        <div class="product-card">
            <img src="tablet.png" alt="Tablet">
            <h3>Tablet</h3>
            <p class="price">₱20,000</p>
            <a href="add_to_cart.php?product_id=5" class="btn">Add to Cart</a>
        </div>

        <!-- aircon -->
        <div class="product-card">
            <img src="aircon.png" alt="aircon">
            <h3>Aircon</h3>
            <p class="price">₱35,000</p>
            <a href="add_to_cart.php?product_id=6" class="btn">Add to Cart</a>
        </div>

        <!-- heater -->
        <div class="product-card">
            <img src="heater.png" alt="heater">
            <h3>Electric Heater</h3>
            <p class="price">₱1,000</p>
            <a href="add_to_cart.php?product_id=7" class="btn">Add to Cart</a>
        </div>

        <!-- tv -->
        <div class="product-card">
            <img src="tv.png" alt="tv">
            <h3>TV</h3>
            <p class="price">₱50,000</p>
            <a href="add_to_cart.php?product_id=8" class="btn">Add to Cart</a>
        </div>

        <!-- electric fan-->
        <div class="product-card">
            <img src="electricfan.png" alt="Electric Fan">
            <h3>Electric Fan</h3>
            <p class="price">₱1,500</p>
            <a href="add_to_cart.php?product_id=9" class="btn">Add to Cart</a>
        </div>

    </div>
</div>
<!-- Footer -->
<div class="footer">© 2025 Your Shop | All Rights Reserved</div>

</body>
</html>

<?php $conn->close(); ?>
