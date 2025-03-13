<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header("Location: blog_login.php");
    exit;
}

include 'db.php';

if (isset($_POST['deleteBlogBtn'])) {
    $post_id = $_POST['post_id'];
    $username = $_SESSION['username'];

    // Verify that the post belongs to the logged-in user
    $query = "DELETE FROM blog WHERE id = ? AND username = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('is', $post_id, $username);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: ../blog_my_blog.php?delete=success");
    } else {
        header("Location: ../blog_my_blog.php?delete=error");
    }

    $stmt->close();
    $mysqli->close();
}
