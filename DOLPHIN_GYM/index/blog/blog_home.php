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
include_once 'component/blog_header.php';
?>

<!-- Custom CSS for additional styling -->
<style>
  .blog-container {
    padding: 20px;
  }

  .post {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .post:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  }

  .post img {
    width: 100%;
    height: 300px;
    object-fit: cover;
    border-radius: 10px;
    margin-bottom: 15px;
  }

  .post h2 {
    color: #007bff;
    /* Bootstrap primary color */
  }

  .post p {
    color: #555;
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

  .search-bar {
    margin-bottom: 20px;
  }
</style>

<!-- Blog Content Section -->
<div class="container blog-container">
  <h1 class="text-center my-4" style="color: #007bff; font-weight: bold;">Welcome to My Fitness Blog</h1>

  <!-- Search Bar -->
  <div class="search-bar">
    <form action="" method="GET">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search posts..." name="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
        <div class="input-group-append">
          <button class="btn btn-primary" type="submit">Search</button>
        </div>
      </div>
    </form>
  </div>

  <?php
  // Fetch posts based on search query
  $search = isset($_GET['search']) ? $_GET['search'] : '';
  $query = "SELECT id, title, img, content, date, is_admin_post, username, category FROM blog WHERE title LIKE ? OR content LIKE ? ORDER BY date DESC";
  $stmt = $mysqli->prepare($query);
  $searchTerm = '%' . $search . '%';
  $stmt->bind_param('ss', $searchTerm, $searchTerm);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result) {
    if ($result->num_rows > 0) {
      // Separate admin and user posts
      $adminPosts = [];
      $userPosts = [];

      while ($row = $result->fetch_assoc()) {
        if ($row['is_admin_post']) {
          $adminPosts[] = $row;
        } else {
          $userPosts[] = $row;
        }
      }

      // Display Admin Posts
      if (!empty($adminPosts)) {
        echo '<h2 class="my-4 text-primary">Admin Blog</h2>';
        foreach ($adminPosts as $post) {
          displayPost($post);
        }
      }

      // Display User Posts
      if (!empty($userPosts)) {
        echo '<h2 class="my-4 text-success">Member Blog</h2>';
        foreach ($userPosts as $post) {
          displayPost($post);
        }
      }
    } else {
      echo '<p class="text-center text-danger">No posts found.</p>';
    }
  } else {
    echo '<p class="text-center text-danger">Error fetching posts: ' . $mysqli->error . '</p>';
  }

  // Function to display a post
  function displayPost($post)
  {
    echo '
      <div class="post">
          <h2>' . htmlspecialchars($post['title']) . '</h2>
          <p><small>Posted by: ' . htmlspecialchars($post['username']) . ' | Category: ' . htmlspecialchars($post['category']) . ' | ' . date("F j, Y", strtotime($post['date'])) . '</small></p>';

    // Display the image if it exists
    if (!empty($post['img'])) {
      $imgData = base64_encode($post['img']);
      echo '<img src="data:image/jpeg;base64,' . $imgData . '" alt="Post Image" class="img-fluid">';
    }

    echo '
          <p>' . nl2br(substr($post['content'], 0, 150)) . '...</p>
          <a href="blog_post.php?id=' . $post['id'] . '" class="btn btn-primary">Read More</a>
      </div>';
  }

  // Close the database connection
  $stmt->close();
  $mysqli->close();
  ?>
</div>

<?php
// Include blog footer
include_once 'component/blog_footer.php';
?>