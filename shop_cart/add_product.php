<?php
session_start();
$conn = new mysqli("localhost", "root", "", "shop_cart");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $price = $_POST["price"];
    
    // Handle Image Upload
    $image = "default.jpg"; // Default image
    if (!empty($_FILES["image"]["name"])) {
        $target_dir = "images/";
        $image = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image;

        // Upload image to the server
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Successfully uploaded
        } else {
            $image = "default.jpg"; // Use default if upload fails
        }
    }

    // Insert product into the database
    $stmt = $conn->prepare("INSERT INTO products (name, price, image) VALUES (?, ?, ?)");
    $stmt->bind_param("sds", $name, $price, $image);

    if ($stmt->execute()) {
        echo "<p style='color:green;'>Product added successfully!</p>";
    } else {
        echo "<p style='color:red;'>Failed to add product.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
</head>
<body>
    <h2>Add a New Product</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Product Name:</label>
        <input type="text" name="name" required>
        <br>
        <label>Price:</label>
        <input type="number" step="0.01" name="price" required>
        <br>
        <label>Product Image:</label>
        <input type="file" name="image" accept="image/*">
        <br>
        <button type="submit">Add Product</button>
    </form>
</body>
</html>
