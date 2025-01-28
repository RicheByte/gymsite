<?php

if (isset($_POST['saveSession'])) {
     include 'db.php';
     session_start();

    $type = $_POST['sessionType'];
    $trainer = $_POST['sessionTrainer'];
    $date = $_POST['sessionDate'];
    $time = $_POST['sessionTime'];
    $userID=$_SESSION['userid'];

    $sql = "INSERT INTO session(type,trainer,date,time,userID) VALUES (?,?,?,?,?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ssssi', $type,$trainer,$date,$time,$userID); 
    if( $stmt->execute()){
          header("Location:../home.php?message=workoutSaved");
    }else{
        header("Location:../home.php?error=workoutNotSaved");
    }

} else {
    header("Location:../home.php?error=unauthorizesAcess");
}
