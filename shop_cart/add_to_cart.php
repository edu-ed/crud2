<?php
session_start();
$conn = new mysqli("localhost", "root", "", "shop_cart");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if product ID is provided
if (!isset($_GET['product_id']) || empty($_GET['product_id'])) {
    die("Product ID is missing.");
}

$product_id = intval($_GET['product_id']);

// Fetch product details from the database
$result = $conn->query("SELECT * FROM products WHERE id = $product_id");

if ($result->num_rows === 0) {
    die("Product not found.");
}

$product = $result->fetch_assoc();

// Initialize cart session if not already set
if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Add product to cart or update quantity if it already exists
if (isset($_SESSION['cart'][$product_id])) {
    $_SESSION['cart'][$product_id]['quantity']++;
} else {
    $_SESSION['cart'][$product_id] = [
        'id' => $product['id'],
        'name' => $product['name'],
        'price' => $product['price'],
        'quantity' => 1
    ];
}

// Redirect to cart page
header("Location: cart.php");
exit;
?>
