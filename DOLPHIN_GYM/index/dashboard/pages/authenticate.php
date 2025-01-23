<?php
session_start();
require 'includes/db.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = :username";
$stmt = $pdo->prepare($sql);
$stmt->execute(['username' => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['logged_in'] = true;
    $_SESSION['username'] = $username;
    header("location: home.php"); // Redirect to ai-chat.php after login
    exit;
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Error</title>
    </head>
    <body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background: linear-gradient(135deg,rgb(34, 33, 34),rgb(97, 97, 97)); color: #fff; display: flex; justify-content: center; align-items: center; height: 100vh;">
        <div style="background: #ffffff; color: #333; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 2rem; width: 100%; max-width: 400px; text-align: center; box-sizing: border-box;">
            <h2 style="font-size: 1.8rem; margin-bottom: 1rem; color:rgb(32, 32, 32);">Login Failed</h2>
            <p style="margin-bottom: 1.5rem; font-size: 1rem; color: #666;">Invalid credentials. Please try again.</p>
            <a href="login.php" 
               style="display: inline-block; background:rgb(34, 34, 34); color: #fff; text-decoration: none; padding: 0.8rem 1.5rem; font-size: 1rem; border: none; border-radius: 5px; cursor: pointer; transition: background 0.3s ease;"
               onmouseover="this.style.background='yellow'; this.style.color='black';"
               onmouseout="this.style.background='rgb(34, 34, 34)'; this.style.color='white';">
                Try Again
            </a>
        </div>
    </body>
    </html>
    <?php
}
?>
