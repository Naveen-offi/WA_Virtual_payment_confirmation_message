<?php

session_start();

// Check if the user is already logged in, if yes, redirect to home page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../pages/home.php");
    exit;
}
?>
<?php include_once '../includes/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../css/login_style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">

</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <!-- <img src="C:\xampp\htdocs\sks\Whatsapp_pay_V3.0.0\img\pic1.png" alt="" srcset=""> -->
        <div class="shape"></div>
    </div>
    <form action="../actions/process_login.php" method="post">
        <h3>Login Here</h3>

        <label for="username">Username</label>
        <input type="text" name="username" placeholder="Username" id="username" required>

        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Password" id="password" required>

        <button type="submit" >Log In</button>
    </form>
    <?php include_once '../includes/footer.php'; ?>
</body>
</html>
