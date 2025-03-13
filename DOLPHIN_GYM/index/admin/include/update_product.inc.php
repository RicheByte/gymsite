<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $quantity = $_POST['quantity'];
    $category = $_POST['category'];
    $product_desc = $_POST['product_desc'];

    // Handle image upload if a new image is provided
    if ($_FILES['product_image']['name']) {
        $image = file_get_contents($_FILES['product_image']['tmp_name']);
        $sql = "UPDATE products SET title=?, price=?, quantity=?, category=?, description=?, img=? WHERE id=?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("sdisssi", $product_name, $product_price, $quantity, $category, $product_desc, $image, $product_id);
    } else {
        $sql = "UPDATE products SET title=?, price=?, quantity=?, category=?, description=? WHERE id=?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("sdissi", $product_name, $product_price, $quantity, $category, $product_desc, $product_id);
    }

    if ($stmt->execute()) {
        header('Location: ../products.php?message=product_updated');
    } else {
        header('Location: ../products.php?message=update_failed');
    }
}
?>