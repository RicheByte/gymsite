<?php

if (isset($_POST['saveWorkout'])) {

     include_once 'db.php';
     session_start();

    $type = $_POST['workoutType'];
    $name = $_POST['workoutName'];
    $date = $_POST['workoutDate'];
    $level = $_POST['intensity'];
    $duration = $_POST['workoutDuration'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $burnCaleroy = $_POST['burnCaleroy'];
    $userID=$_SESSION['userid'];

    

    $sql = "INSERT INTO workout(type,name,date,level,duration,weight,height,burnCalory,userID) VALUES (?,?,?,?,?,?,?,?,?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ssssiiiii', $type,$name,$date,$level,$duration,$weight,$height,$burnCaleroy,$userID); 
    if( $stmt->execute()){
          header("Location:../home.php?message=workoutSaved");
    }else{
        header("Location:../home.php?error=workoutNotSaved");
    }
   
} else {
    header("Location:../home.php?error=unauthorizesAcess");
}
