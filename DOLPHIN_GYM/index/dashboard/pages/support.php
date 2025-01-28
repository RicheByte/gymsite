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
    <h1>Support</h1>

    <div class="support-form">
        <h3>Submit a Support Ticket</h3>

        <!-- implement support form -->
        <form id="supportForm" action="include/support.inc.php" method="POST">
            <div class="form-group">
                <label for="issueTitle">Issue Title</label>
                <input type="text" name="title" id="issueTitle" class="form-control" placeholder="Enter the title of your issue" required>
            </div>
            <div class="form-group">
                <label for="issueDescription">Issue Description</label>
                <textarea id="issueDescription" name="desc" class="form-control" placeholder="Describe your issue in detail" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="supportSubmitBtn">Submit Ticket</button>
        </form>
    </div>

    <div class="tickets mt-5">
        <h3>Your Support Tickets</h3>
        <div id="ticketList">
        <?php 
            $sql = "SELECT * FROM user_messages";
            $stmt = $mysqli->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            
            foreach ($rows as $message) {
               
                echo '<div class="forum-post">';
                
                echo '<h4>' . htmlspecialchars($message['message']) . '</h4>';
                echo '<p>' . nl2br(htmlspecialchars($message['description'])) . '</p><br/>';
                echo '</div>';
            }
        ?>
        </div>
    </div>
</main>



<!-- <script src="../js/support.js"></script> -->

<?php
include_once "component/dashboard_footer.php";  //include dashboard footer
?>