<?php
if (isset($_POST['addBlogBtn'])) {
    session_start();
    include_once 'db.php';


    $title = $_POST['title'];
    $content = $_POST['content'];

    $category = $_POST['category'];
    $image = file_get_contents($_FILES['img']['tmp_name']);

    // Insert the new post into the database
    $query = "INSERT INTO blog (title,img,content,category,date,is_admin_post,username) VALUES (?, ?,?, ?, now(), 1,?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('sbsss', $title, $null,  $content, $category, $_SESSION['admin_username']);
    // Send image data separately
    $stmt->send_long_data(1, $image);

    if ($stmt->execute()) {
        header('Location:../blog.php?message=blogSaved');
    } else {
        header('Location:../blog.php?error=blogNotSaved');
    }

    $stmt->close();
} else {
    header("Location:../blog.php?error=addBlogUnauthorizedAccess");
}
