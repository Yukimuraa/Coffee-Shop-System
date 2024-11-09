<?php
session_start();
// Check if user is logged in
if (!isset($_SESSION['CustomerID'])) {
    header('Location: login.php');
    exit();
}

// Include database connection
include 'config.php';

if(isset($_GET['logout'])){
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css"> <!-- Link to external CSS -->
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <h1>Dashboard</h1>
        
        <div class="user-profile">
            <p>Welcome, <?php echo $_SESSION['Name']; ?></p>
            <!-- <a href="?logout=1">Logout</a> -->
        </div>
    </header>
    
    <div class="container">
        <aside class="sidebar">
            <nav>
                <h2>Inventory</h2>
                <ul>
                    <li><a href="view_products.php"><i class="fas fa-box"></i> View Products</a></li>
                    <li><a href="add_product.php"><i class="fas fa-plus"></i> Add Product</a></li>
                    <li><a href="manage_categories.php"><i class="fas fa-tags"></i> Manage Categories</a></li>
                    <li><a href="inventory_report.php"><i class="fas fa-chart-line"></i> Inventory Reports</a></li>
                </ul>
                <h2>Point Of Sale</h2>
                <ul>
                    <li><a href="view_cart.php"><i class="fas fa-shopping-cart"></i> View Cart</a></li>
                    <li><a href="place_order.php"><i class="fas fa-receipt"></i> Place Order</a></li>
                    <li><a href="order_history.php"><i class="fas fa-history"></i> Order History</a></li>
                    <li><a href="customer_management.php"><i class="fas fa-users"></i> Customer Management</a></li>
                    <a href="?logout=1" class="Logout">Logout</a>
                </ul>
            </nav>
        </aside>

        <main class="content">
        <section class="ordering-section">
            <h3>Select Your Coffee</h3>
            <div class="product-grid">
                <!-- Static coffee items -->
                <div class="product-item">
                    <img src="image/Espresso-coffee-Coffee-Culture-Thailand.webp" alt="Espresso">
                    <h4>Espresso</h4>
                    <p>Price: ₱59.00</p>
                    <button class="add-to-cart" data-name="Espresso" data-price="3.00">Add to Cart</button>
                </div>
                <div class="product-item">
                    <img src="image/Cappuccino.jpg" alt="">
                    <h4>Cappuccino</h4>
                    <p>Price: ₱69.00</p>
                    <button class="add-to-cart" data-name="Cappuccino" data-price="3.50">Add to Cart</button>
                </div>
                <div class="product-item">
                    <img src="image/close-up-tasty-cappuccino-with-milk.jpg" alt="Latte">
                    <h4>Latte</h4>
                    <p>Price: ₱59.00</p>
                    <button class="add-to-cart" data-name="Latte" data-price="4.00">Add to Cart</button>
                </div>
                <div class="product-item">
                    <img src="image/cappuccino-756490_1280.jpg" alt="Latte">
                    <h4>Great Taste White</h4>
                    <p>Price: ₱79.00</p>
                    <button class="add-to-cart" data-name="Latte" data-price="4.00">Add to Cart</button>
                </div>
                <div class="product-item">
                    <img src="image/nescafe-coffee-cup-black-with-pot-18Prko3-600.jpg" alt="Latte">
                    <h4>Nescafe classic</h4>
                    <p>Price: ₱20.00</p>
                    <button class="add-to-cart" data-name="Latte" data-price="4.00">Add to Cart</button>
                </div>
                <!-- Add more coffee items as needed -->
            </div>
        </section>

        <!-- Cart Section -->
        <!-- <section class="cart-section">
            <h3>Your Order</h3>
            <div id="cart-items"></div>
            <button id="place-order">Place Order</button>
        </section> -->
    </main>
    </div>

</body>
</html>
