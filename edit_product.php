<?php 
include 'config.php';

// Check if a product ID was passed
if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Fetch product details
    $query = "SELECT * FROM products WHERE ProductID = $productId";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) == 1) {
        $product = mysqli_fetch_assoc($result);
    } else {
        echo "Product not found.";
        exit;
    }
}

// Update the product in the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productId = $_POST['ProductID'];
    $productName = $_POST['ProductName'];
    $category = $_POST['Category'];
    $price = $_POST['Price'];
    $stockLevel = $_POST['StockLevel'];
    $reorderLevel = $_POST['ReorderLevel'];

    $updateQuery = "UPDATE products SET 
                    ProductName='$productName', 
                    Category='$category', 
                    Price='$price', 
                    StockLevel='$stockLevel', 
                    ReorderLevel='$reorderLevel' 
                    WHERE ProductID=$productId";

    if (mysqli_query($connection, $updateQuery)) {
        echo "<script>alert('Product updated successfully!');</script>";
        echo "<script>window.location.href = 'view_products.php';</script>";
    } else {
        echo "Error updating record: " . mysqli_error($connection);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
</head>
<body>

<h1>Edit Product</h1>

<form method="POST" action="">
    <input type="hidden" name="ProductID" value="<?php echo $product['ProductID']; ?>">

    <label for="ProductName">Product Name:</label>
    <input type="text" name="ProductName" id="ProductName" value="<?php echo htmlspecialchars($product['ProductName']); ?>" required><br><br>

    <label for="Category">Category:</label>
    <input type="text" name="Category" id="Category" value="<?php echo htmlspecialchars($product['Category']); ?>" required><br><br>

    <label for="Price">Price:</label>
    <input type="number" name="Price" id="Price" value="<?php echo htmlspecialchars($product['Price']); ?>" step="0.01" required><br><br>

    <label for="StockLevel">Stock Level:</label>
    <input type="number" name="StockLevel" id="StockLevel" value="<?php echo htmlspecialchars($product['Stocklevel']); ?>" required><br><br>
<!-- 
    <label for="ReorderLevel">Reorder Level:</label>
    <input type="number" name="ReorderLevel" id="ReorderLevel" value="<?php echo htmlspecialchars($product['ReorderLevel']); ?>" required><br><br> -->

    <button type="submit">Update Product</button>
</form>

</body>
</html>

<?php
// Close the database connection
mysqli_close($connection);
?>
