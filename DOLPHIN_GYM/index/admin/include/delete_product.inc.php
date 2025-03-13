<?php
session_start();
require_once 'db.php';

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    $sql = "DELETE FROM products WHERE id=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $product_id);

    if ($stmt->execute()) {
        header('Location: ../products.php?message=product_deleted');
    } else {
        header('Location: ../products.php?message=delete_failed');
    }
}
