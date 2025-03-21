<?php
// Start the session to check if the user is logged in
session_start();

// Redirect to the login page if the user is not logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Include the dashboard header and database connection
include_once "component/dashboard_header.php";
include_once "include/db.php";

// Get the logged-in user's ID from the session
$user_id = $_SESSION['userid']; // Ensure this is set during login

// Fetch foods from the database
$foods = [];
$sql = "SELECT id, food_name, calories FROM foods;";
$stmt = $mysqli->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$foods = $result->fetch_all(MYSQLI_ASSOC);

// Fetch diet history from the database for the logged-in user
$dietHistory = [];
$sqlHistory = "SELECT * FROM calorie_log WHERE user_id = ? ORDER BY date_logged DESC;";
$stmtHistory = $mysqli->prepare($sqlHistory);
$stmtHistory->bind_param("i", $user_id); // Bind the user ID to the query
$stmtHistory->execute();
$resultHistory = $stmtHistory->get_result();
$dietHistory = $resultHistory->fetch_all(MYSQLI_ASSOC);
?>

<!-- Main Container -->
<div class="container mt-5">
    <!-- Page Heading -->
    <h1 class="text-center text-primary mb-4">Diet Tracker</h1>

    <!-- Button to trigger the diet history popup -->
    <button type="button" class="btn btn-info mt-3 float-end shadow" id="viewHistoryBtn">View Diet History</button>

    <br><br>

    <!-- Diet Form Section -->
    <div class="card shadow mb-4">
        <div class="card-body bg-light">
            <form id="dietForm" class="my-4">
                <!-- Meal Time Dropdown -->
                <div class="form-group">
                    <label for="mealTime" class="text-dark">Select Meal Time:</label>
                    <select name="meal_time" id="mealTime" class="form-control" required>
                        <option value="" disabled selected>-- Select Meal Time --</option>
                        <option value="Breakfast">Breakfast</option>
                        <option value="Lunch">Lunch</option>
                        <option value="Dinner">Dinner</option>
                        <option value="Snack">Snack</option>
                    </select>
                </div>
                <br>
                <!-- Food Selection Dropdown -->
                <div class="form-group">
                    <label for="foodSelect" class="text-dark">Select Food:</label>
                    <select name="food" id="foodSelect" class="form-control" required>
                        <option value="" disabled selected>-- Select Food --</option>
                        <?php foreach ($foods as $food): ?>
                            <option value="<?= htmlspecialchars($food['id']) ?>" data-calories="<?= htmlspecialchars($food['calories']) ?>">
                                <?= htmlspecialchars($food['food_name']) ?> (<?= htmlspecialchars($food['calories']) ?> cal)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- Add Food Button -->
                <button type="button" id="addFoodBtn" class="btn btn-primary mt-3 shadow">Add Food</button>
            </form>
        </div>
    </div>

    <!-- Food Table Section -->
    <div class="card shadow">
        <div class="card-body">
            <table class="table table-striped">
                <!-- Table Header -->
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Meal Time</th>
                        <th>Food Name</th>
                        <th>Calories</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <!-- Table Body (Dynamically Populated) -->
                <tbody id="foodTableBody"></tbody>
                <!-- Table Footer (Total Calories) -->
                <tfoot>
                    <tr class="bg-light">
                        <td colspan="2"><strong>Total Calories</strong></td>
                        <td id="totalCalories" class="text-success"><strong>0</strong></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Status Message Section -->
    <div id="statusMessage" class="mt-4 text-center"></div>

    <!-- Save Menu Button -->
    <div class="text-center mt-4">
        <form action="include/dietTracker.inc.php" method="POST">
            <!-- Hidden Inputs for Form Submission -->
            <input type="hidden" name="totalCalories" id="hiddenTotalCalories">
            <input type="hidden" name="foodMenu" id="hiddenFoodMenu">
            <input type="hidden" name="mealTime" id="hiddenMealTime">
            <input type="hidden" name="date" id="hiddenDate">
            <!-- Save Menu Button -->
            <button type="submit" id="saveMenuBtn" name="dietMeal" class="btn btn-success btn-lg shadow">Save My Menu</button>
        </form>
    </div>
</div>

<!-- Diet History Popup Modal -->
<div class="modal" id="dietHistoryModal" tabindex="-1" aria-labelledby="dietHistoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="dietHistoryModalLabel">Diet History</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <table class="table table-striped">
                    <!-- Table Header -->
                    <thead class="bg-info text-white">
                        <tr>
                            <th>Date</th>
                            <th>Meal Time</th>
                            <th>Calories</th>
                        </tr>
                    </thead>
                    <!-- Table Body (Populated with Diet History) -->
                    <tbody>
                        <?php foreach ($dietHistory as $record): ?>
                            <tr>
                                <td><?= htmlspecialchars($record['date_logged']) ?></td>
                                <td><?= htmlspecialchars($record['mealTime']) ?></td>
                                <td><?= htmlspecialchars($record['total_calories']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Dynamic Functionality -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        // DOM Elements
        const foodSelect = document.getElementById("foodSelect");
        const mealTimeSelect = document.getElementById("mealTime");
        const addFoodBtn = document.getElementById("addFoodBtn");
        const foodTableBody = document.getElementById("foodTableBody");
        const totalCaloriesEl = document.getElementById("totalCalories");
        const statusMessage = document.getElementById("statusMessage");
        const hiddenTotalCalories = document.getElementById("hiddenTotalCalories");
        const hiddenFoodMenu = document.getElementById("hiddenFoodMenu");
        const hiddenDate = document.getElementById("hiddenDate");
        const hiddenMealTime = document.getElementById("hiddenMealTime");

        let totalCalories = 0; // Track total calories
        let foodMenu = []; // Track selected foods

        // Add Food Button Click Event
        addFoodBtn.addEventListener("click", () => {
            const selectedFood = foodSelect.options[foodSelect.selectedIndex];
            const foodName = selectedFood.text;
            const calories = parseInt(selectedFood.getAttribute("data-calories"), 10);
            const mealTime = mealTimeSelect.value;

            // Validate selection
            if (!foodName || isNaN(calories) || !mealTime) {
                alert("Please select both a food item and a meal time.");
                return;
            }

            // Add row to the table
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${mealTime}</td>
                <td>${foodName}</td>
                <td>${calories}</td>
                <td><button type="button" class="btn btn-danger btn-sm removeBtn shadow">Remove</button></td>
            `;
            foodTableBody.appendChild(row);

            // Update total calories
            totalCalories += calories;
            totalCaloriesEl.textContent = totalCalories;

            // Add food to the menu
            foodMenu.push({
                mealTime,
                foodName,
                calories
            });

            // Clear the food selection dropdown
            foodSelect.selectedIndex = 0;

            // Remove Button Click Event
            row.querySelector(".removeBtn").addEventListener("click", () => {
                foodTableBody.removeChild(row);
                totalCalories -= calories;
                totalCaloriesEl.textContent = totalCalories;

                // Remove food from the menu
                foodMenu = foodMenu.filter(item => item.foodName !== foodName || item.mealTime !== mealTime);

                // Update status message
                checkCalorie(totalCalories);
            });

            // Update status message
            checkCalorie(totalCalories);
        });

        // Function to Check Calorie Intake
        function checkCalorie(totalCalories) {
            if (totalCalories < 500) {
                statusMessage.textContent = "Your calorie intake seems low. Consider adding more nutritious food.";
                statusMessage.className = "text-warning";
            } else if (totalCalories <= 1000) {
                statusMessage.textContent = "Your calorie intake is within a healthy range.";
                statusMessage.className = "text-success";
            } else {
                statusMessage.textContent = "Your calorie intake is high. Be mindful of overeating.";
                statusMessage.className = "text-danger";
            }
        }

        // View History Button Click Event
        document.getElementById("viewHistoryBtn").addEventListener("click", () => {
            const dietHistoryModal = new bootstrap.Modal(document.getElementById('dietHistoryModal'));
            dietHistoryModal.show();
        });

        // Save Menu Button Click Event
        document.getElementById("saveMenuBtn").addEventListener("click", (e) => {
            const currentDate = new Date();
            const formattedDate = `${currentDate.getFullYear()}-${String(currentDate.getMonth() + 1).padStart(2, '0')}-${String(currentDate.getDate()).padStart(2, '0')}`;

            // Set hidden input values
            hiddenTotalCalories.value = totalCalories;
            hiddenFoodMenu.value = JSON.stringify(foodMenu);
            hiddenDate.value = formattedDate;
            hiddenMealTime.value = mealTimeSelect.value;
        });
    });
</script>

<!-- Include Dashboard Footer -->
<?php include_once "component/dashboard_footer.php"; ?>