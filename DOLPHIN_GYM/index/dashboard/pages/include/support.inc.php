<?php
if (isset($_POST['supportSubmitBtn'])) {
    session_start();
    include_once 'db.php';

    $userID = $_SESSION['userid'];
    $message = $_POST['title'];
    $description = $_POST['desc'];
    $date = date('Y-m-d'); // Updated date format


    $sql = "INSERT INTO user_messages(user_id,message, description,submitted_at) VALUES (?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('isss', $userID, $message, $description, $date);

    if ($stmt->execute()) {
        header("Location:../support.php?message=messsageSent");
    } else {
        header("Location:../support.php?error=messageNotSent");
    }
} else {
    header("Location:../support.php?error=forumUnauthorizedAccess");
}
?>
