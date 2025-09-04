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
  <title>|Admin Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <div class="image-section"></div>
    <div class="login-section">
      <h2>Login</h2>
      <p>Admin Login</p>
      <input type="email" placeholder="Email@gmail.com" >
      <input type="password" placeholder="Password">
      <p>Sign as</p>
      <div class="button-group">
        <button>Admin</button>  
        <button>Cashier</button>
      </div>
      
    </div>
  </div>
</body>
</html>
