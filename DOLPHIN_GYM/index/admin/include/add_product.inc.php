<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php?message=admin_dashboard_not_login');
    exit;
}

require_once 'db.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $category = $_POST['category'];
    $product_desc = $_POST['product_desc'];
    $product_quantity = $_POST['quantity'];
    $adminId = $_SESSION['admin_userid'];

    // Read the image file as binary data
    $image = file_get_contents($_FILES['product_image']['tmp_name']);

    // Insert product into the database
    $sql = "INSERT INTO products (title, description, price, quantity, img, category, admin_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);

    if (!$stmt) {
        die("Error preparing statement: " . $mysqli->error);
    }

    // Bind parameters (image as a BLOB requires "b")
    $stmt->bind_param("ssdibsi", $product_name, $product_desc, $product_price, $product_quantity, $null, $category, $adminId);

    // Send image data separately
    $stmt->send_long_data(4, $image);

    // Execute the statement
    if ($stmt->execute()) {
        header('Location: ../dashboard.php?message=product_added');
        exit;
    } else {
        die("Error adding product: " . $stmt->error);
    }
} else {
    header('Location: ../dashboard.php');
    exit;
}
