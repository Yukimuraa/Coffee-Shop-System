<?php
session_start();
include 'config.php';

if (!isset($_SESSION['CustomerID'])) {
    header("Location: ../login.php"); // Redirect to login if not logged in
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerId = $_SESSION['CustomerID'];
    $productId = $_POST['ProductID'];
    $quantity = $_POST['Quantity'];

    // Fetch product price and current stock level
    $productQuery = "SELECT Price, StockLevel FROM products WHERE ProductID = '$productId'";
    $productResult = mysqli_query($connection, $productQuery);
    $product = mysqli_fetch_assoc($productResult);

    if ($product && $product['StockLevel'] >= $quantity) {
        $price = $product['Price'];
        $totalAmount = $price * $quantity;

        // Insert order into orders table
        $orderQuery = "INSERT INTO orders (CustomerID, TotalAmount, PaymentMethod) VALUES ('$customerId', '$totalAmount', 'Credit Card')";
        if (mysqli_query($connection, $orderQuery)) {
            $orderId = mysqli_insert_id($connection); // Get the last inserted order ID

            // Insert into order_details
            $orderDetailsQuery = "INSERT INTO order_details (OrderID, ProductID, Quantity, Price) VALUES ('$orderId', '$productId', '$quantity', '$price')";
            mysqli_query($connection, $orderDetailsQuery);

            // Update inventory stock level
            $newStockLevel = $product['StockLevel'] - $quantity;
            $updateStockQuery = "UPDATE products SET StockLevel = '$newStockLevel' WHERE ProductID = '$productId'";
            mysqli_query($connection, $updateStockQuery);

            // (Optional) Update loyalty points
            $loyaltyPoints = round($totalAmount); // Example: 1 point per dollar spent
            $updatePointsQuery = "UPDATE customers SET LoyaltyPoints = LoyaltyPoints + '$loyaltyPoints' WHERE CustomerID = '$customerId'";
            mysqli_query($connection, $updatePointsQuery);

            // Confirmation message
            echo "<script>alert('Order placed successfully! Your order ID is: $orderId'); window.location.href='place_order.php';</script>";
        } else {
            echo "Error: " . mysqli_error($connection);
        }
    } else {
        echo "<script>alert('Insufficient stock available!'); window.location.href='place_order.php';</script>";
    }
} else {
    header("Location: place_order.php");
}
?>
