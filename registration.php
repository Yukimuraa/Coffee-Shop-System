<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['Name'];
    $email = $_POST['Email'];
    $phonenumber = $_POST['PhoneNumber'];
    $password = password_hash($_POST['Password'], PASSWORD_DEFAULT);
    $loyaltyPoints = 0; // Default value for loyalty points upon registration

    // Prepare the SQL statement to prevent SQL injection
    $sql = "INSERT INTO customers (Name, Email, PhoneNumber, Password, LoyaltyPoints) VALUES ('$username', '$email', '$phonenumber', '$password', '$loyaltyPoints')";
    
    if (mysqli_query($connection, $sql)) {
        echo "<script>alert('Registration successful');</script>";
        // Optionally redirect to a login page or another page
        // header("Location: login.php");
        // exit();
    } else {
        echo "Error: " . mysqli_error($connection);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="registration.css">
</head>
<body>
    <div class="container">
        <div class="box">
            <h1>Sign up now</h1>
            <form action="" method="post">
                <!-- <label for="name">Name</label> -->
                <input type="text" name="Name" required placeholder="Enter your Name">
                
                <!-- <label for="email">Email</label> -->
                <input type="email" name="Email" required placeholder="Enter your Email">
                
                <!-- <label for="phonenumber">Phone Number</label> -->
                <input type="number" name="PhoneNumber" required placeholder="Enter your PhoneNumber">
                
                <!-- <label for="password">Password</label> -->
                <input type="password" name="Password" required placeholder="Enter your Password">
                
                <!-- <label for="loyaltypoints">Loyalty Points</label> -->
                <!-- <input type="hidden" name="Loyaltypoints" value="0"> Default loyalty points -->
                
                <button type="submit">Register</button>
                <p>Already have an account?<a href="login.php"> Login</a></p>
            </form>
        </div>
    </div>
</body>
</html>
