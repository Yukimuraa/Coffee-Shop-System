<?php
session_start();
include 'config.php';

if (!isset($_SESSION['CustomerID'])) {
    header("Location: ../login.php"); // Redirect to login if not logged in
    exit();
}

// Fetch products for the order form
$sql = "SELECT * FROM products";
$result = mysqli_query($connection, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order</title>
    <link rel="stylesheet" href="place_order.css">
</head>
<body>
    <a href="dashboard.php" class="Back">Back to Dashboard</a>
    <h1>Place Order</h1>
    <div class="box">

   
    <form action="submit_order.php" method="post">
        <label for="product">Select Product:</label>
        <select name="ProductID" required>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <option value="<?php echo $row['ProductID']; ?>"><?php echo $row['ProductName']; ?></option>
            <?php } ?>
        </select>
        <label for="quantity">Quantity:</label>
        <input type="number" name="Quantity" required>
        <button type="submit">Place Order</button>
    </form>
    </div>
</body>
</html>
