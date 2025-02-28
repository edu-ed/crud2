<?php
session_start();

$conn = new mysqli("localhost", "root", "", "shop_cart");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle quantity update
if (isset($_GET['action']) && isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    if ($_GET['action'] === 'increase') {
        $_SESSION['cart'][$product_id]['quantity']++;
    } elseif ($_GET['action'] === 'decrease' && $_SESSION['cart'][$product_id]['quantity'] > 1) {
        $_SESSION['cart'][$product_id]['quantity']--;
    }

    header("Location: cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            color: #007bff;
            font-weight: 600;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 14px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }
        th {
            background: #007bff;
            color: white;
            font-weight: bold;
        }
        .quantity-controls {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .btn {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            margin: 4px;
            cursor: pointer;
            font-size: 18px;
            border-radius: 6px;
            text-decoration: none;
            display: inline-block;
            transition: background 0.3s ease;
        }
        .btn:hover {
            background: #0056b3;
        }
        .btn-remove {
            background: red;
        }
        .btn-remove:hover {
            background: darkred;
        }
        .checkout-btn {
            background: #28a745;
            font-size: 20px;
            font-weight: bold;
            padding: 12px 20px;
            margin-top: 20px;
        }
        .checkout-btn:hover {
            background: #218838;
        }
        .back-btn {
            background: #6c757d;
            width: 250px;
            padding: 12px;
            margin-top: 20px;
            font-size: 18px;
        }
        .back-btn:hover {
            background: #545b62;
        }
        .total-price {
            font-size: 24px;
            font-weight: bold;
            color: #28a745;
            margin-top: 20px;
        }
        @media (max-width: 768px) {
            body {
                height: auto;
                padding: 20px;
            }
            .btn {
                font-size: 16px;
                padding: 8px 12px;
            }
            .container {
                width: 100%;
                padding: 20px;
            }
            th, td {
                padding: 12px;
            }
            .checkout-btn, .back-btn {
                font-size: 16px;
                width: 200px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>🛒 Your Shopping Cart</h2>

    <?php if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>
        <table>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>

            <?php
            $total_price = 0;
            foreach ($_SESSION['cart'] as $product_id => $item):
                $total_price += $item['price'] * $item['quantity'];
            ?>
                <tr>
                    <td><?= htmlspecialchars($item['name']) ?></td>
                    <td>₱<?= number_format($item['price'], 2) ?></td>
                    <td class="quantity-controls">
                        <a href="cart.php?action=decrease&product_id=<?= $product_id ?>" class="btn">−</a>
                        <?= $item['quantity'] ?>
                        <a href="cart.php?action=increase&product_id=<?= $product_id ?>" class="btn">+</a>
                    </td>
                    <td>₱<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                    <td>
                        <a href="remove_from_cart.php?product_id=<?= $product_id ?>" class="btn btn-remove">Remove</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <div class="total-price">Total: ₱<?= number_format($total_price, 2) ?></div>
        <a href="checkout.php" class="btn checkout-btn">Proceed to Checkout</a>
    <?php endif; ?>

    <a href="products.php" class="btn back-btn">← Back to Products</a>
</div>

</body>
</html>

<?php $conn->close(); ?>
