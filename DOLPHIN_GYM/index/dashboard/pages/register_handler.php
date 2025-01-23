<?php
require 'includes/db.php';

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
$stmt = $pdo->prepare($sql);

try {
    $stmt->execute(['username' => $username, 'password' => $password]);
    header("Location: login.php?message=Registration successful! Please log in.");
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
