<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php?message=admin_dashboard_not_login');
    exit;
}


require_once 'db.php';





if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message_id'], $_POST['admin_reply'])) {
    $message_id = intval($_POST['message_id']);
    $admin_reply = $mysqli->real_escape_string($_POST['admin_reply']);

    $query = "UPDATE user_messages SET admin_reply = '$admin_reply' WHERE id = $message_id";
    
    if ($mysqli->query($query)) {
        header("Location: ../users.php?message=reply_sent");
    } else {
        header("Location:../users.php?message=reply_failed");
    }
}
?>
