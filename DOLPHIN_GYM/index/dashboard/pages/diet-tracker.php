<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['user_id']; // Assuming user_id is stored in the session

// Database connection
$conn = new mysqli('localhost', 'root', '', 'gym');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch foods from the database
$foods = [];
$result = $conn->query("SELECT * FROM foods");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $foods[] = $row;
    }
}

// Handle calorie submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['totalCalories'])) {
        $totalCalories = (int)$_POST['totalCalories'];
        $stmt = $conn->prepare("INSERT INTO calorie_log (user_id, total_calories) VALUES (?, ?)");
        $stmt->bind_param("ii", $userId, $totalCalories);
        if ($stmt->execute()) {
            $message = "Daily calories saved successfully!";
        } else {
            $message = "Error saving daily calories.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diet Tracker</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    

<div>
    <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #2C2C2C; padding: 0.5rem 1rem;">
    <a class="navbar-brand" href="home.html" style="font-weight: bold;">FitLife Gym</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="leaderboard.php">Leaderboard</a></li>
            <li class="nav-item"><a class="nav-link" href="diet-tracker.php">Diet Tracker</a></li>
            <li class="nav-item"><a class="nav-link" href="ai-chat.php">AI Chat</a></li>
            <li class="nav-item"><a class="nav-link" href="live-trainer.php">Live Trainer</a></li>
            <li class="nav-item"><a class="nav-link" href="forum.php">Forum</a></li>
            <li class="nav-item"><a class="nav-link" href="support.php">Support</a></li>
            <li class="nav-item"><a class="nav-link" href="/DOLPHIN_GYM/index/store/shoppingcart/index.php">Store</a></li>
        </ul>
    </div>
</div>


<div class="container mt-5">
    <h1 class="text-center">Diet Tracker</h1>

    <?php if (!empty($message)): ?>
        <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form id="foodForm" class="my-4">
        <label for="foodSelect">Select Food:</label>
        <select id="foodSelect" class="form-control">
            <option value="" disabled selected>-- Select Food --</option>
            <?php foreach ($foods as $food): ?>
                <option value="<?= $food['id'] ?>" data-calories="<?= $food['calories'] ?>">
                    <?= $food['food_name'] ?> (<?= $food['calories'] ?> cal)
                </option>
            <?php endforeach; ?>
        </select>
        <button type="button" id="addFoodBtn" class="btn btn-primary mt-3">Add Food</button>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Food Name</th>
                <th>Calories</th>
            </tr>
        </thead>
        <tbody id="foodTableBody"></tbody>
        <tfoot>
            <tr>
                <td><strong>Total Calories</strong></td>
                <td id="totalCalories">0</td>
            </tr>
        </tfoot>
    </table>

    <form method="POST" id="submitForm">
        <input type="hidden" name="totalCalories" id="hiddenTotalCalories" value="0">
        <button type="submit" class="btn btn-success mt-4">Submit Daily Calories</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    const foodSelect = $("#foodSelect");
    const foodTableBody = $("#foodTableBody");
    const totalCaloriesEl = $("#totalCalories");
    const hiddenTotalCalories = $("#hiddenTotalCalories");
    let totalCalories = 0;

    $("#addFoodBtn").click(function () {
        const selectedOption = foodSelect.find(":selected");
        const foodName = selectedOption.text();
        const calories = parseInt(selectedOption.data("calories"), 10);

        if (!foodName || isNaN(calories)) {
            alert("Please select a valid food item.");
            return;
        }

        const row = `<tr><td>${foodName}</td><td>${calories}</td></tr>`;
        foodTableBody.append(row);

        totalCalories += calories;
        totalCaloriesEl.text(totalCalories);
        hiddenTotalCalories.val(totalCalories);
    });
});
</script>
</body>
</html>
