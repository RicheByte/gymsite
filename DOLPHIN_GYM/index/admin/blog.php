<?php
// Start the session to check if the admin is logged in
session_start();

// Redirect to the login page if the admin is not logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php?message=admin_dashboard_not_login');
    exit;
}

// Include the admin header and database connection
include_once 'components/admin_header.php';
include_once 'include/db.php';
include_once '../config/keys.php';
?>

<!-- Custom CSS for colorful and attractive design -->
<style>
    .gradient-bg {
        background: linear-gradient(135deg, #6a11cb, #2575fc);
        color: white;
    }
    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }
    .btn-custom-primary {
        background-color: #2575fc;
        border: none;
        transition: background-color 0.3s ease;
    }
    .btn-custom-primary:hover {
        background-color: #1a5bbf;
    }
    .btn-custom-danger {
        background-color: #ff4d4d;
        border: none;
        transition: background-color 0.3s ease;
    }
    .btn-custom-danger:hover {
        background-color: #cc0000;
    }
    .form-control:focus {
        border-color: #6a11cb;
        box-shadow: 0 0 5px rgba(106, 17, 203, 0.5);
    }
    .form-select:focus {
        border-color: #6a11cb;
        box-shadow: 0 0 5px rgba(106, 17, 203, 0.5);
    }
</style>


<!-- Include TinyMCE from CDN -->
<script src="https://cdn.tiny.cloud/1/<?php echo $tinyApiKey; ?>/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    // Initialize TinyMCE
    tinymce.init({
        selector: '#content', // Target the textarea with id="content"
        plugins: 'link lists', // Remove 'italic' (it's not a plugin)
        toolbar: 'bold italic underline strikethrough | bullist numlist | link', // Add 'italic' here
        menubar: false, // Disable the menubar
        height: 300, // Set the height of the editor
    });
</script>


<!-- Add New Blog Post Form -->
<div class="container mt-5">
    <h1 class="text-center mb-4 gradient-bg p-3 rounded">Add New Blog Post (Admin)</h1>
    <form action="include/add_blog.inc.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content" rows="5"></textarea>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select class="form-select" id="category" name="category" required>
                <option value="" disabled selected>Select a category</option>
                <option value="Workout Tips">Workout Tips</option>
                <option value="Nutrition">Nutrition</option>
                <option value="Weight Loss">Weight Loss</option>
                <option value="Muscle Building">Muscle Building</option>
                <option value="Cardio">Cardio</option>
                <option value="Yoga & Meditation">Yoga & Meditation</option>
                <option value="Healthy Recipes">Healthy Recipes</option>
                <option value="Fitness Gear">Fitness Gear</option>
                <option value="Mental Health">Mental Health</option>
                <option value="Injury Prevention">Injury Prevention</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="img" class="form-label">Upload Image</label>
            <input type="file" class="form-control" id="img" name="img">
        </div>
        <button type="submit" class="btn btn-custom-primary" name="addBlogBtn">Submit</button>
    </form>
</div>

<!-- Display All Posted Blogs -->
<div class="container mt-5">
    <h2 class="text-center mb-4 gradient-bg p-3 rounded">All Posted Blogs</h2>
    <?php
    // Fetch all posts from the database
    $query = "SELECT id, title, img, content, date, category, username, is_admin_post FROM blog ORDER BY date DESC";
    $result = $mysqli->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title text-primary">' . htmlspecialchars($row['title']) . '</h5>
                    <p class="card-text"><small class="text-muted">Posted by: ' . htmlspecialchars($row['username']) . ' | ' . date("F j, Y", strtotime($row['date'])) . ' | Category: ' . htmlspecialchars($row['category']) . '</small></p>
                    <p class="card-text">' . nl2br(substr($row['content'], 0, 200)) . '...</p>';

            // Display the image if it exists
            if (!empty($row['img'])) {
                $imgData = base64_encode($row['img']);
                echo '<img src="data:image/jpeg;base64,' . $imgData . '" alt="Post Image" class="img-fluid mb-3 rounded" style="max-width: 300px;">';
            }

            echo '
                    <a href="blog_post.php?id=' . $row['id'] . '" class="btn btn-custom-primary">Read More</a>
                    <form action="include/delete_blog.inc.php" method="POST" style="display: inline;">
                        <input type="hidden" name="post_id" value="' . $row['id'] . '">
                        <button type="submit" class="btn btn-custom-danger" name="deleteBlogBtn">Delete</button>
                    </form>
                </div>
            </div>';
        }
    } else {
        echo '<p class="text-center">No posts found.</p>';
    }

    // Close the database connection
    $mysqli->close();
    ?>
</div>

<?php
// Include admin footer
include_once 'components/admin_footer.php';
?>