<?php
session_start();
include_once "component/dashboard_header.php";  
include_once "include/db.php";  // Database connection file

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Get logged-in user's ID
$user_id = $_SESSION['userid'];

// Fetch user's total points, rank, and name
$query = "SELECT users.username, leaderboard.total_points, leaderboard.rank 
          FROM leaderboard
          JOIN users ON leaderboard.user_id = users.id 
          WHERE leaderboard.user_id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user_data = $result->fetch_assoc();
$total_points = $user_data['total_points'] ?? 0;
$user_rank = $user_data['rank'] ?? "Unranked";
$username = $user_data['username'] ?? "Unknown";

// Fetch all users' ranking data
$query = "SELECT users.username, leaderboard.total_points, leaderboard.rank 
          FROM leaderboard 
          JOIN users ON leaderboard.user_id = users.id 
          ORDER BY leaderboard.total_points DESC";
$result = $mysqli->query($query);
$rank_data = [];
while ($row = $result->fetch_assoc()) {
    $rank_data[] = $row;
}

?>

<div class="container mt-4">
    <h1 class="text-center">Fitness Progress</h1>

    <!-- Display user's total points and rank -->
    <div class="card p-3 mb-4 text-center">
        <h3>Welcome, <strong><?php echo $username; ?></strong></h3>
        <h3>Your Rank: <strong>#<?php echo $user_rank; ?></strong></h3>
        <h4>Total Points: <strong><?php echo $total_points; ?></strong></h4>
        <button class="btn btn-success mt-3" id="openFormBtn">Enter Fitness Stats</button>
    </div>

    <!-- Other users' ranking -->
    <h2 class="text-center">Leaderboard</h2>
    <div class="list-group">
        <?php foreach ($rank_data as $index => $user) { 
            $progress = ($user['total_points'] / max(array_column($rank_data, 'total_points'))) * 100; // Normalize progress bar
        ?>
            <div class="list-group-item">
                <h5>#<?php echo $user['rank']; ?> - <?php echo htmlspecialchars($user['username']); ?></h5>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: <?php echo $progress; ?>%;" 
                         aria-valuenow="<?php echo $user['total_points']; ?>" aria-valuemin="0" 
                         aria-valuemax="100">
                        <?php echo $user['total_points']; ?> Points
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<!-- Popup Form for Fitness Stats -->
<div id="fitnessFormPopup" class="popup">
    <div class="popup-content">
        <span class="close-btn">&times;</span>
        <h2>Enter Your Fitness Data</h2>
        <form action="include/submit_fitness_stats.inc.php" method="POST">
            <div class="form-group">
                <label for="weight_loss">Weight Loss (kg):</label>
                <input type="number" class="form-control" id="weight_loss" name="weight_loss" required>
            </div>
            <div class="form-group">
                <label for="bmi_improvement">BMI Improvement:</label>
                <input type="number" class="form-control" id="bmi_improvement" name="bmi_improvement" required>
            </div>
            <div class="form-group">
                <label for="workouts">Workouts per Week:</label>
                <input type="number" class="form-control" id="workouts" name="workouts" required>
            </div>
            <div class="form-group">
                <label for="steps">Steps Walked (per day):</label>
                <input type="number" class="form-control" id="steps" name="steps" required>
            </div>
            <div class="form-group">
                <label for="strength_gain">Strength Gain (kg):</label>
                <input type="number" class="form-control" id="strength_gain" name="strength_gain" required>
            </div>
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            <button type="submit" class="btn btn-primary" name="fitness_stats">Submit Data</button>
        </form>
    </div>
</div>

<!-- JavaScript for Popup -->
<script>
document.getElementById("openFormBtn").addEventListener("click", function() {
    document.getElementById("fitnessFormPopup").style.display = "block";
});
document.querySelector(".close-btn").addEventListener("click", function() {
    document.getElementById("fitnessFormPopup").style.display = "none";
});
</script>

<style>
/* Popup styles */
.popup {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 400px;
    background: white;
    padding: 20px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}
.popup-content {
    position: relative;
}
.close-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
    font-size: 20px;
    color: red;
}
</style>

<?php
include_once "component/dashboard_footer.php";
?>

