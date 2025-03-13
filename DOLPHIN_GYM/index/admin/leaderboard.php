<?php
// Start the session to check if the admin is logged in
session_start();

// Redirect to the login page if the admin is not logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php?message=admin_dashboard_not_login');
    exit;
}

// Include the admin header and database connection
include_once 'components/admin_header.php';
require_once 'include/db.php';

// Fetch all user fitness stats that need to be reviewed
$query = "SELECT fitness_stats.id, fitness_stats.user_id, users.username, fitness_stats.weight_loss, 
                 fitness_stats.bmi_improvement, fitness_stats.workouts, fitness_stats.steps, 
                 fitness_stats.strength_gain 
          FROM fitness_stats 
          JOIN users ON fitness_stats.user_id = users.id 
          WHERE fitness_stats.status = 'pending'";
$result = $mysqli->query($query);

// Function to calculate points
function calculatePoints($weight_loss, $bmi_improvement, $workouts, $steps, $strength_gain)
{
    return ($weight_loss * 2) + ($bmi_improvement * 3) + ($workouts * 5) + ($steps / 1000) + ($strength_gain * 4);
}

// Handle points assignment
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['assign_points'])) {
    $fitness_id = $_POST['fitness_id'];
    $user_id = $_POST['user_id'];

    // Get submitted fitness stats
    $query = "SELECT * FROM fitness_stats WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $fitness_id);
    $stmt->execute();
    $stats = $stmt->get_result()->fetch_assoc();

    if ($stats) {
        // Calculate points
        $total_points = calculatePoints($stats['weight_loss'], $stats['bmi_improvement'], $stats['workouts'], $stats['steps'], $stats['strength_gain']);

        // Update or insert points in rank table
        $query = "INSERT INTO leaderboard (user_id, total_points) 
                  VALUES (?, ?) 
                  ON DUPLICATE KEY UPDATE total_points = total_points + ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("iii", $user_id, $total_points, $total_points);
        $stmt->execute();

        // Mark fitness stat as reviewed
        $query = "UPDATE fitness_stats SET status = 'reviewed' WHERE id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $fitness_id);
        $stmt->execute();

        // Update rankings based on points
        $mysqli->query("SET @rank = 0");
        $mysqli->query("UPDATE leaderboard SET rank = (@rank := @rank + 1) ORDER BY total_points DESC");

        header("Location: leaderboard.php?message=points_updated");
        exit;
    }
}

// Fetch updated ranking list
$ranking_query = "SELECT users.username, leaderboard.total_points, leaderboard.rank 
                  FROM leaderboard
                  JOIN users ON leaderboard.user_id = users.id 
                  ORDER BY leaderboard.total_points DESC";
$rank_result = $mysqli->query($ranking_query);
?>

<!-- Custom CSS for modern styling -->
<style>
    .table {
        border-collapse: separate;
        border-spacing: 0 10px;
        /* Add spacing between rows */
    }

    .table thead th {
        background-color: #007bff;
        /* Bootstrap primary color */
        color: white;
    }

    .table tbody tr {
        background-color: #f8f9fa;
        /* Light gray background for rows */
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .table tbody tr:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
        background-color: #007bff;
        /* Bootstrap primary color */
        border: none;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        /* Darker shade for hover effect */
    }

    .progress-bar {
        background-color: #28a745;
        /* Bootstrap success color */
    }

    .list-group-item {
        margin-bottom: 10px;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
</style>

<!-- Admin Panel - Fitness Stats Review Section -->
<div class="container mt-4">
    <h1 class="text-center mb-4" style="color: #007bff; font-weight: bold;">Admin Panel - Fitness Stats Review</h1>

    <!-- Pending Fitness Stats Table -->
    <h3 class="mb-3" style="color: #28a745;">Pending Fitness Stats</h3>
    <div class="card shadow mb-5">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Weight Loss</th>
                        <th>BMI Improvement</th>
                        <th>Workouts</th>
                        <th>Steps</th>
                        <th>Strength Gain</th>
                        <th>Assign Points</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            <td><?php echo $row['weight_loss']; ?></td>
                            <td><?php echo $row['bmi_improvement']; ?></td>
                            <td><?php echo $row['workouts']; ?></td>
                            <td><?php echo $row['steps']; ?></td>
                            <td><?php echo $row['strength_gain']; ?></td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="fitness_id" value="<?php echo $row['id']; ?>">
                                    <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                                    <button type="submit" name="assign_points" class="btn btn-primary">Assign Points</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- User Rankings Section -->
    <h3 class="mt-5 mb-3" style="color: #28a745;">User Rankings</h3>
    <div class="card shadow">
        <div class="card-body">
            <div class="list-group">
                <?php while ($rank = $rank_result->fetch_assoc()) {
                    $progress = ($rank['total_points'] / max(array_column($rank_result->fetch_all(MYSQLI_ASSOC), 'total_points'))) * 100;
                ?>
                    <div class="list-group-item">
                        <h5>#<?php echo $rank['rank']; ?> - <?php echo htmlspecialchars($rank['username']); ?></h5>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: <?php echo $progress; ?>%;"
                                aria-valuenow="<?php echo $rank['total_points']; ?>" aria-valuemin="0"
                                aria-valuemax="100">
                                <?php echo $rank['total_points']; ?> Points
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php
// Include admin footer
include_once 'components/admin_footer.php';
?>