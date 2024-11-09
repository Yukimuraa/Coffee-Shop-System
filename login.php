<?php
session_start(); // Start the session
include 'config.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['Email'];
    $password = $_POST['Password'];

    // Query to check if the email exists and fetch the hashed password
    $query = "SELECT CustomerID, Password, Name FROM customers WHERE Email = '$email'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $user['Password'])) {
            // Set session variables
            $_SESSION['CustomerID'] = $user['CustomerID'];
            $_SESSION['Name'] = $user['Name'];
            echo "<script>alert('Login successful');</script>";
            // Redirect to a dashboard or home page
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<script>alert('Invalid password');</script>";
        }
    } else {
        echo "<script>alert('No account found with that email');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
        <div class="box">
            
            <form action="" method="post">
            <h2>Login</h2>
                <!-- <label for="email">Email</label> -->
                <input type="email" name="Email" required placeholder="Enter your email">
                
                <!-- <label for="password">Password</label> -->
                <input type="password" name="Password" required placeholder="Enter your password">
                
                <button type="submit">Login</button>
                <p>Don't have an account?<a href="registration.php"> Sign up</a></p>
            </form>
        </div>
    </div>
</body>
</html>
