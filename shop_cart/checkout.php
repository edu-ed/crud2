<?php
session_start();

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .container {
            width: 50%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            font-size: 16px;
            background: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover {
            background: #218838;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Checkout</h2>
    <p>Your order summary:</p>

    <table border="1" width="100%">
        <tr>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>

        <?php
        $total_price = 0;
        foreach ($_SESSION['cart'] as $item):
            $total_price += $item['price'] * $item['quantity'];
        ?>
            <tr>
                <td><?= htmlspecialchars($item['name']) ?></td>
                <td>₱<?= number_format($item['price'], 2) ?></td>
                <td><?= $item['quantity'] ?></td>
                <td>₱<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h3>Total Price: ₱<?= number_format($total_price, 2) ?></h3>

    <a href="process_order.php" class="btn">Place Order</a>
    <br><br>
    <a href="cart.php" class="btn" style="background: #007bff;">Back to Cart</a>
</div>

</body>
</html>
