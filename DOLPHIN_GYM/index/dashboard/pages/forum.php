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
    <h1 class="text-center text-primary mb-4">Forum</h1>
    <div class="post-section bg-light p-4 rounded shadow mb-5">
        <h3 class="text-success mb-4">Ask a Question</h3>

        <!-- forum support form -->
        <form id="postForm" action="include/forum.inc.php" method="POST">
            <div class="form-group">
                <label for="postTitle" class="text-dark">Post Title</label>
                <input type="text" id="postTitle" name="title" class="form-control" placeholder="Enter your question title" required>
            </div>
            <div class="form-group">
                <label for="postContent" class="text-dark">Post Content</label>
                <textarea id="postContent" name="desc" class="form-control" placeholder="Enter your question details" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-success btn-block" name="forumSubmitBtn">Submit Question</button>
        </form>
    </div>


    <!-- /////////////////////////////////////// previous forum date   ////////////////////////////////////////// -->
    <div class="forum-posts mt-5">
        <h3 class="text-center text-primary mb-4">Forum Topics</h3>
        <div id="forumPostList">
            <?php
            // Fetch forum topics along with the username of the poster
            $sql = "SELECT f.*, u.username FROM forum f JOIN users u ON f.userID = u.id ORDER BY f.publish_date DESC, f.publish_Time DESC";
            $stmt = $mysqli->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            $rows = $result->fetch_all(MYSQLI_ASSOC);

            foreach ($rows as $post) {
                echo '<div class="forum-post card mb-4 border-primary">';
                echo '<div class="card-body">';
                echo '<p class="card-text text-muted"><small>Published by <strong class="text-info">' . htmlspecialchars($post['username']) . '</strong> on ' . $post['publish_date'] . ' at ' . $post['publish_Time'] . '</small></p>';
                echo '<h4 class="card-title text-dark">' . htmlspecialchars($post['title']) . '</h4>';
                echo '<p class="card-text text-secondary">' . nl2br(htmlspecialchars($post['description'])) . '</p>';

                // Fetch replies for each forum post
                $reply_sql = "SELECT r.*, u.username FROM forum_reply r JOIN users u ON r.userID = u.id WHERE r.forumID = ?;";
                $reply_stmt = $mysqli->prepare($reply_sql);
                $reply_stmt->bind_param("i", $post['id']);
                $reply_stmt->execute();
                $reply_result = $reply_stmt->get_result();
                $replies = $reply_result->fetch_all(MYSQLI_ASSOC);

                if (!empty($replies)) {
                    echo '<div class="forum-replies mt-4">';
                    echo '<h5 class="text-warning mb-3">Replies:</h5>';
                    foreach ($replies as $reply) {
                        echo '<div class="reply card mb-2 border-warning">';
                        echo '<div class="card-body">';
                        echo '<p class="card-text text-muted"><small><strong class="text-danger">' . htmlspecialchars($reply['username']) . '</strong> replied on ' . $reply['reply_date'] . '</small></p>';
                        echo '<p class="card-text text-dark">' . nl2br(htmlspecialchars($reply['message'])) . '</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                    echo '</div>';
                }

                // Reply form
                echo '<div class="reply-form mt-4">';
                echo '<form method="post" action="include/forum_reply.inc.php">';
                echo '<input type="hidden" name="forumID" value="' . $post['id'] . '" />';
                echo '<div class="form-group">';
                echo '<textarea class="form-control" name="message" required placeholder="Write a reply..." rows="3"></textarea>';
                echo '</div>';
                echo '<button type="submit" class="btn btn-info btn-block" name="forumReplySubmitBtn">Reply</button>';
                echo '</form>';
                echo '</div>';

                echo '</div>'; // Close card-body
                echo '</div>'; // Close forum-post card
            }
            ?>
        </div>
    </div>

</main>