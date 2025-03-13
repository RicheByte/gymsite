<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php?message=admin_dashboard_not_login');
    exit;
}

include 'db.php';

if (isset($_POST['deleteBlogBtn'])) {
    $post_id = $_POST['post_id'];

    // Delete the post from the database
    $query = "DELETE FROM blog WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $post_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: ../blog.php?delete=success");
    } else {
        header("Location: ../blog.php?delete=error");
    }

    $stmt->close();
    $mysqli->close();
}
?>