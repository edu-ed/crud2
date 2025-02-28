<?php
session_start();

if (isset($_GET['product_id'])) {
    $product_id = intval($_GET['product_id']);

    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
}

// Redirect back to the cart page
header("Location: cart.php");
exit;
?>
