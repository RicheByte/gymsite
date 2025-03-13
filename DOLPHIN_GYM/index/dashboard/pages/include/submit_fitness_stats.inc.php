<?php
if (isset($_POST['fitness_stats'])) {
    session_start();
    include_once 'db.php';


     // Get form data
     $user_id = $_SESSION['userid']; // You should retrieve the logged-in member ID dynamically
     $weight_loss = $_POST['weight_loss'];
     $bmi_improvement = $_POST['bmi_improvement'];
     $workouts = $_POST['workouts'];
     $steps = $_POST['steps'];
     $strength_gain = $_POST['strength_gain'];
     $status='pending';
 
     // Insert into fitness_stats table
     $sql = "INSERT INTO fitness_stats (user_id, weight_loss, bmi_improvement, workouts, steps, strength_gain,status) 
             VALUES (?, ?, ?, ?, ?, ?,?)";
 
     if ($stmt = $mysqli->prepare($sql)) {
         $stmt->bind_param("iiiiiis", $user_id, $weight_loss, $bmi_improvement, $workouts, $steps, $strength_gain,$status);
         $stmt->execute();
         header("Location:../leaderboard.php?message=fitnessStatsSaved");
     } else {
         echo "Error: " . $conn->error;
     }

 
} else {
    header("Location:../leaderboard.php?error=forumUnauthorizedAccess");
}
?>