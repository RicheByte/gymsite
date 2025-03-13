<?php

// if(isset($_POST['dieatMeal'])){

// }else{
//     header("Location:../diet-tracker.php?error=unauthorizedAcess");
// }

session_start();
include_once 'db.php';


$totalCal = $_POST['totalCalories'];

$date = $_POST['date'];
$userID = $_SESSION['userid'];
$mealTime = $_POST['mealTime'];


$sql = "INSERT INTO calorie_log (user_id,mealTime,total_calories,date_logged) VALUES (?, ?, ?,?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('ssss', $userID, $mealTime, $totalCal, $date);


if ($stmt->execute()) {
  header("Location:../diet-tracker.php?message=menuSaved");
} else {
  header("Location:../diet-tracker.php?error=menuSavedFailed");
}
