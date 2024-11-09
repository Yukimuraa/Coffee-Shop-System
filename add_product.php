<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product_name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock_level = $_POST['stock_level'];
    $reorder_level = $_POST['reorder_level'];

    $sql = "INSERT INTO products (ProductName, Category, Price, StockLevel, ReorderLevel) 
            VALUES ('$product_name', '$category', $price, $stock_level, $reorder_level)";
    
    if (mysqli_query($connection, $sql)) {
        echo "Product added successfully!";
    } else {
        echo "Error: " . mysqli_error($connection);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Product</title>
    <link rel="stylesheet" href="add_product.css">
</head>
<body>
    <a href="dashboard.php" class="Back">Back to Dashboard</a>
    <h2>Add Product</h2>
    <div class="container">
    <div class="box">
    <form method="POST" action="">
        Product Name: <input type="text" name="product_name" required><br>
        Category: <input type="text" name="category"><br>
        Price: <input type="number" step="0.01" name="price" required><br>
        Stock Level: <input type="number" name="stock_level" required><br>
        <!-- Reorder Level: <input type="number" name="reorder_level" required><br> -->
        <input type="submit" value="Add Product">
    </form>
    </div>
    </div>
</body>
</html>
