<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

include_once "component/dashboard_header.php";
include_once "include/db.php";

// Fetch foods from the database
$foods = [];
$sql = "SELECT id, food_name, calories FROM foods;";
$stmt = $mysqli->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$foods = $result->fetch_all(MYSQLI_ASSOC);

// Fetch diet history from the database for popup
$dietHistory = [];
$sqlHistory = "SELECT * FROM calorie_log;";
$stmtHistory = $mysqli->prepare($sqlHistory);
$stmtHistory->execute();
$resultHistory = $stmtHistory->get_result();
$dietHistory = $resultHistory->fetch_all(MYSQLI_ASSOC);
?>

<div class="container mt-5">
    <h1 class="text-center">Diet Tracker</h1>
    <!-- Button to trigger the popup diet history -->
    <button type="button" class="btn btn-info mt-3 float-end" id="viewHistoryBtn">View Diet History</button>


    <br><br>
    <form id="dietForm" class="my-4">
        <label for="mealTime" class="mt-3">Select Meal Time:</label>
        <select name="meal_time" id="mealTime" class="form-control" required>
            <option value="" disabled selected>-- Select Meal Time --</option>
            <option value="Breakfast">Breakfast</option>
            <option value="Lunch">Lunch</option>
            <option value="Dinner">Dinner</option>
            <option value="Snack">Snack</option>
        </select>
        <br>
        <label for="foodSelect">Select Food:</label>
        <select name="food" id="foodSelect" class="form-control" required>
            <option value="" disabled selected>-- Select Food --</option>
            <?php foreach ($foods as $food): ?>
                <option value="<?= htmlspecialchars($food['id']) ?>" data-calories="<?= htmlspecialchars($food['calories']) ?>">
                    <?= htmlspecialchars($food['food_name']) ?> (<?= htmlspecialchars($food['calories']) ?> cal)
                </option>
            <?php endforeach; ?>
        </select>

        <button type="button" id="addFoodBtn" class="btn btn-primary mt-3">Add Food</button>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Meal Time</th>
                <th>Food Name</th>
                <th>Calories</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="foodTableBody"></tbody>
        <tfoot>
            <tr>
                <td colspan="2"><strong>Total Calories</strong></td>
                <td id="totalCalories">0</td>
                <td></td>
            </tr>
        </tfoot>
    </table>

    <div id="statusMessage" class="mt-4"></div>

    <form action="include/dietTracker.inc.php" method="POST">
        <input type="hidden" name="totalCalories" id="hiddenTotalCalories">
        <input type="hidden" name="foodMenu" id="hiddenFoodMenu">
        <input type="hidden" name="mealTime" id="hiddenMealTime">
        <input type="hidden" name="date" id="hiddenDate">

        <button type="submit" id="saveMenuBtn" name="dietMeal" class="btn btn-outline-success mt-3">Save My Menu</button>
    </form>


</div>

<!-- //////////////////////////////////////////////Popup for Diet History///////////////////////////////////////////////// -->
<div class="modal" id="dietHistoryModal" tabindex="-1" aria-labelledby="dietHistoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dietHistoryModalLabel">Diet History</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Meal Time</th>
                            <th>Calories</th>

                        </tr>
                    </thead>
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

<script>
    document.addEventListener("DOMContentLoaded", () => {
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

        let totalCalories = 0;
        let foodMenu = [];

        addFoodBtn.addEventListener("click", () => {
            const selectedFood = foodSelect.options[foodSelect.selectedIndex];
            const foodName = selectedFood.text;
            const calories = parseInt(selectedFood.getAttribute("data-calories"), 10);
            const mealTime = mealTimeSelect.value;

            if (!foodName || isNaN(calories) || !mealTime) {
                alert("Please select both a food item and a meal time.");
                return;
            }

            const row = document.createElement("tr");
            row.innerHTML = `
            <td>${mealTime}</td>
            <td>${foodName}</td>
            <td>${calories}</td>
            <td><button type="button" class="btn btn-danger btn-sm removeBtn">Remove</button></td>
        `;
            foodTableBody.appendChild(row);

            totalCalories += calories;
            totalCaloriesEl.textContent = totalCalories;

            foodMenu.push({
                mealTime,
                foodName,
                calories
            });

            row.querySelector(".removeBtn").addEventListener("click", () => {
                foodTableBody.removeChild(row);
                totalCalories -= calories;
                totalCaloriesEl.textContent = totalCalories;

                foodMenu = foodMenu.filter(item => item.foodName !== foodName || item.mealTime !== mealTime);

                checkCalorie(totalCalories);
            });

            checkCalorie(totalCalories);

            function checkCalorie(totalCalories) {
                if (totalCalories < 1500) {
                    statusMessage.textContent = "Your calorie intake seems low. Consider adding more nutritious food.";
                    statusMessage.className = "text-warning";
                } else if (totalCalories <= 2500) {
                    statusMessage.textContent = "Your calorie intake is within a healthy range.";
                    statusMessage.className = "text-success";
                } else {
                    statusMessage.textContent = "Your calorie intake is high. Be mindful of overeating.";
                    statusMessage.className = "text-danger";
                }
            }
        });

        document.getElementById("viewHistoryBtn").addEventListener("click", () => {
            const dietHistoryModal = new bootstrap.Modal(document.getElementById('dietHistoryModal'));
            dietHistoryModal.show();
        });

        document.getElementById("saveMenuBtn").addEventListener("click", (e) => {
            const currentDate = new Date();
            const formattedDate = `${currentDate.getFullYear()}-${String(currentDate.getMonth() + 1).padStart(2, '0')}-${String(currentDate.getDate()).padStart(2, '0')}`;

            hiddenTotalCalories.value = totalCalories;
            hiddenFoodMenu.value = JSON.stringify(foodMenu);
            hiddenDate.value = formattedDate;
            hiddenMealTime.value = mealTimeSelect.value;
        });

    });
</script>

<?php include_once "component/dashboard_footer.php"; ?>