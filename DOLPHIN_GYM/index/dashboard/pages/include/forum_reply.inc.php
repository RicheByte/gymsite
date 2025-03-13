<?php
if (isset($_POST['forumReplySubmitBtn'])) {
    session_start();
    include_once 'db.php';




    $forumID = intval($_POST['forumID']);
    $userID = $_SESSION['userid'];
    $message = trim($_POST['message']);

    if (empty($message)) {
        die("Reply message cannot be empty.");
    }

    $sql = "INSERT INTO forum_reply (forumID, userID, message,reply_date) VALUES (?, ?, ?,now())";
    $stmt = $mysqli->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("iis", $forumID, $userID, $message);
        if ($stmt->execute()) {
            header("Location: ../forum.php"); // Redirect to forum page after success
            exit();
        } else {
            die("Error submitting reply.");
        }
    } else {
        die("Database error.");
    }





} else {
header("Location:../forum.php?error=forumUnauthorizedAccess");
}
