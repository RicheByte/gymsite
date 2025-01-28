<?php
if (isset($_POST['forumSubmitBtn'])) {
    session_start();
    include_once 'db.php';

    $userID = $_SESSION['userid'];
    $title = $_POST['title'];
    $description = $_POST['desc'];
    $date = date('Y-m-d'); // Updated date format
    $time = date('H:i:s'); // Updated time format

    $sql = "INSERT INTO forum (userID, title, description, publish_date, publish_time) VALUES (?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('issss', $userID, $title, $description, $date, $time);

    if ($stmt->execute()) {
        header("Location:../forum.php?message=forumPosted");
    } else {
        header("Location:../forum.php?error=forumNotPosted");
    }
} else {
    header("Location:../forum.php?error=forumUnauthorizedAccess");
}
?>
