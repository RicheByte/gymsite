<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}
include_once 'include/db.php';
include_once "component/dashboard_header.php";   //include dashboard header
?>


    <main class="container mt-5">
        <h1>Forum</h1>
        <div class="post-section">
            <h3>Ask a Question</h3>

            <!-- forum support form -->
            <form id="postForm" action="include/forum.inc.php" method="POST">
                <div class="form-group">
                    <label for="postTitle">Post Title</label>
                    <input type="text" id="postTitle" name="title" class="form-control" placeholder="Enter your question title" required>
                </div>
                <div class="form-group">
                    <label for="postContent">Post Content</label>
                    <textarea id="postContent" name="desc" class="form-control" placeholder="Enter your question details" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="forumSubmitBtn">Submit Question</button>
            </form>
        </div>


         
        <!-- here display all forum from database -->
        <div class="forum-posts mt-5">
    <h3>Forum Topics</h3>
    <div id="forumPostList">
        <?php 
            $sql = "SELECT f.*, u.username FROM forum f, users u WHERE f.userID = u.id";
            $stmt = $mysqli->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            
            foreach ($rows as $post) {
               
                echo '<div class="forum-post">';
                echo '<p><strong>Published by ' . htmlspecialchars($post['username']) . '</strong> on ' . $post['publish_date'] . ' at ' . $post['publish_Time'] . '</p>';
                echo '<h4>' . htmlspecialchars($post['title']) . '</h4>';
                echo '<p>' . nl2br(htmlspecialchars($post['description'])) . '</p><br/>';
                echo '</div>';
            }
        ?>
    </div>
</div>

    </main>



    <!-- <script src="../js/forum.js"></script> -->



    
<?php
   include_once "component/dashboard_footer.php";  //include dashboard footer
?>