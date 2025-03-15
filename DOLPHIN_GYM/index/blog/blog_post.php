<?php
// Start the session to check if the user is logged in
session_start();

// Redirect to the login page if the user is not logged in
if (!isset($_SESSION['logged_in'])) {
    header("Location: blog_login.php");
    exit;
}

// Include database connection and blog header
include 'include/db.php';

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $post_id = intval($_GET['id']); // Sanitize the input

    // Fetch the full post from the database
    $query = "SELECT title, img, content, date, category, username FROM blog WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $title = htmlspecialchars($row['title']);
        $content = $row['content'];
        $date = date("F j, Y", strtotime($row['date']));
        $img = $row['img'];
        $category = htmlspecialchars($row['category']); // Fetch category
        $username = htmlspecialchars($row['username']); // Fetch username
    } else {
        // If no post is found, redirect to the home page
        header("Location: index.php");
        exit;
    }
} else {
    // If no 'id' parameter is set, redirect to the home page
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS for modern styling -->
    <style>
        .post-container {
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .post-container h1 {
            color: #007bff;
            /* Bootstrap primary color */
            margin-bottom: 20px;
        }

        .post-container p {
            color: #555;
            line-height: 1.6;
        }

        .post-container img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            /* Bootstrap primary color */
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            /* Darker shade for hover effect */
        }

        .post-meta {
            font-size: 0.9em;
            color: #777;
            margin-bottom: 20px;
        }

        .post-meta span {
            margin-right: 15px;
        }
    </style>
</head>

<body>
    <!-- Full Post Content Section -->
    <div class="container post-container">
        <h1><?php echo $title; ?></h1>
        <div class="post-meta">
            <span><strong>Date:</strong> <?php echo $date; ?></span>
            <span><strong>Category:</strong> <?php echo $category; ?></span>
            <span><strong>Author:</strong> <?php echo $username; ?></span>
        </div>

        <?php
        // Display the image if it exists
        if (!empty($img)) {
            $imgData = base64_encode($img);
            echo "<img src='data:image/jpeg;base64,{$imgData}' alt='Post Image' class='img-fluid'>";
        }
        ?>

        <p><?php echo $content; ?></p>
        <a href="blog_home.php" class="btn btn-primary">Back to Home</a>
    </div>
</body>

</html>