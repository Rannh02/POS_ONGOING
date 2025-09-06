<?php
require 'Database.php';
require 'Authorize.php';

$db = (new Database())->connect();
$auth = new Authorize($db);
$message = '';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Use PDO prepared statement with named parameters
    $stmt = $db->prepare("SELECT * FROM admin WHERE username = :username AND password = :password");
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':password', $password);
    $stmt->execute();
    $result = $stmt->fetch();

    if ($result) {
        header("Location: Register.php");
        exit();
    } else {
        $message = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link rel="stylesheet" href="style.css">

  
</head>
<body >
  <img  src=CoffeeShop.png alt="Coffee Cup" 
  style="
  position: fixed; 
  width: 100%; 
  height: 100%; 
  z-index: -1; 
  filter: blur(4px);">

  <div class="container">
    <div class="image-section">
      <img src="CoffeeCup.jpg" alt="Coffee Cup" style="width: 100%; height: 100%; object-fit: cover;">
    </div>
    <div class="login-section">
      <h2 style="text-align: center;">BerdeKopi POS</h2>
      <p style ="font-size:15px;">Admin User</p>
      <input style="font-size:15px;"type="email" placeholder="Admin">
      <p style ="font-size:15px;">Password</p>
      <input style = "font-size: 15px;"type="password" placeholder="Password">
      <p style="text-align:center; margin-top:5%;font-size:15px;">Sign as</p>
      <div class="button-group">
        <button>Admin</button>  
        <button>Cashier</button>
      </div>
    </div>
  </div>
</body>
</html>
