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
    <h1 class="text-center text-primary mb-4">Support Center</h1>

    <!-- Support Form Section -->
    <div class="support-form bg-light p-4 rounded shadow mb-5">
        <h3 class="text-success mb-4">Submit a Support Ticket</h3>

        <!-- Support Form -->
        <form id="supportForm" action="include/support.inc.php" method="POST">
            <div class="form-group">
                <label for="issueTitle" class="text-dark">Issue Title</label>
                <input type="text" name="title" id="issueTitle" class="form-control" placeholder="Enter the title of your issue" required>
            </div>
            <div class="form-group">
                <label for="issueDescription" class="text-dark">Issue Description</label>
                <textarea id="issueDescription" name="desc" class="form-control" placeholder="Describe your issue in detail" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-success btn-block" name="supportSubmitBtn">Submit Ticket</button>
        </form>
    </div>

    <!-- Tickets Section -->
    <div class="tickets mt-5">
        <h3 class="text-center text-primary mb-4">Your Support Tickets</h3>
        <div id="ticketList">
            <?php 
                $sql = "SELECT * FROM user_messages ORDER BY submitted_at DESC";
                $stmt = $mysqli->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();
                $rows = $result->fetch_all(MYSQLI_ASSOC);
                
                if (count($rows) > 0) {
                    foreach ($rows as $message) {
                        echo '<div class="ticket card mb-4 border-primary shadow">';
                        echo '<div class="card-body">';
                        echo '<h4 class="card-title text-dark">' . htmlspecialchars($message['message']) . '</h4>';
                        echo '<small class="text-muted">Submitted on: ' . date("F j, Y, g:i a", strtotime($message['submitted_at'])) . '</small>';
                        echo '<p class="card-text text-secondary mt-2">' . nl2br(htmlspecialchars($message['description'])) . '</p>';
                        
                        // Check if admin replied
                        if (!empty($message['admin_reply'])) {
                            echo '<div class="admin-reply bg-light p-3 mt-3 border-left border-success">';
                            echo '<strong class="text-success">Admin Reply:</strong> ' . nl2br(htmlspecialchars($message['admin_reply']));
                            echo '</div>';
                        } else {
                            echo '<p class="text-muted mt-3">No reply from admin yet.</p>';
                        }

                        echo '</div>'; // Close card-body
                        echo '</div>'; // Close ticket card
                    }
                } else {
                    echo '<div class="alert alert-info text-center">No support tickets found.</div>';
                }
            ?>
        </div>
    </div>
</main>

<?php
include_once "component/dashboard_footer.php";  //include dashboard footer
?>