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
include_once 'include/db.php';
?>

<main class="container mt-5">
    <!-- Welcome Banner -->
    <div class="jumbotron jumbotron-fluid bg-primary text-white text-center py-5 shadow">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">Welcome Back, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
            <p class="lead mb-4">Let’s crush your fitness goals today!</p>
        </div>
    </div>
    <br>

    <!-- Quick Access Section -->
    <div class="row text-center mb-4">
        <div class="col-md-4">
            <button class="btn btn-success btn-lg w-100 mb-3 shadow" data-bs-toggle="modal" data-bs-target="#workoutModal">Save a Workout</button>
        </div>
        <div class="col-md-4">
            <button class="btn btn-warning btn-lg w-100 mb-3 shadow" data-bs-toggle="modal" data-bs-target="#appointmentModal">Join Live Session</button>
        </div>
        <div class="col-md-4">
            <button class="btn btn-info btn-lg w-100 mb-3 shadow" data-bs-toggle="modal" data-bs-target="#previousWorkoutsModal">View Previous Workouts</button>
        </div>
    </div>

    <!-- Dashboard Features -->
    <div class="row">
        <!-- Calories Chart -->
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h3 class="card-title text-primary">Calorie Chart</h3>
                    <canvas id="caloriesChart"></canvas>
                </div>
            </div>
        </div>
        <!-- BMI Chart -->
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h3 class="card-title text-primary">BMI Chart</h3>
                    <canvas id="bmiChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Admin Messages Section -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="card-title text-primary mb-4">Admin Messages</h3>
                    <ul class="list-group" id="adminMessages">
                        <?php
                        // Fetch admin messages from the database
                        $sql = "SELECT message, sent_at FROM admin_messages ORDER BY sent_at DESC;";
                        $stmt = $mysqli->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $rows = $result->fetch_all(MYSQLI_ASSOC);

                        if (count($rows) > 0) {
                            foreach ($rows as $message) {
                                echo '<li class="list-group-item d-flex flex-wrap align-items-center p-3 mb-2 shadow-sm rounded">';
                                echo '<span class="fw-bold me-2">' . htmlspecialchars($message['message']) . '</span>';
                                echo '<span class="text-muted me-2">' . htmlspecialchars($message['sent_at']) . '</span>';
                                echo '</li>';
                            }
                        } else {
                            echo '<li class="list-group-item">No messages found.</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Upcoming Sessions Section -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="card-title text-primary mb-4">Upcoming Sessions</h3>
                    <ul class="list-group" id="previousWorkouts">
                        <?php
                        // Fetch upcoming sessions from the database
                        $sql = "SELECT * FROM session;";
                        $stmt = $mysqli->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $rows = $result->fetch_all(MYSQLI_ASSOC);

                        foreach ($rows as $session) {
                            echo '<li class="list-group-item d-flex flex-wrap align-items-center p-3 mb-2 shadow-sm rounded">';
                            echo '<span class="fw-bold text-primary me-2">' . htmlspecialchars($session['type']) . '</span>';
                            echo '<span class="text-muted me-2">with</span>';
                            echo '<span class="fw-bold text-dark me-2">' . htmlspecialchars($session['trainer']) . '</span>';
                            echo '<span class="text-muted me-2">on</span>';
                            echo '<span class="fw-bold text-dark me-2">' . htmlspecialchars($session['date']) . '</span>';
                            echo '<span class="text-muted me-2">at</span>';
                            echo '<span class="fw-bold text-dark">' . htmlspecialchars($session['time']) . '</span>';
                            echo '</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>


<!-- ///////////////////////////////////////////////////////////////// work out save detail form /////////////////////////////////////////////////-->
<div class="modal fade" id="workoutModal" tabindex="-1" aria-labelledby="workoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="workoutModalLabel">Save a New Workout</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Workout Form -->
                <form id="workoutForm" action="include/saveWorkout.inc.php" method="POST">
                    <!-- Workout Type Dropdown -->
                    <div class="mb-3">
                        <label for="workoutType" class="form-label">Workout Type</label>
                        <select class="form-select" id="workoutType" name="workoutType" required>
                            <option value="Cardio">Cardio</option>
                            <option value="Yoga">Yoga</option>
                            <option value="Strength Training">Strength Training</option>
                            <option value="HIIT">HIIT</option>
                            <option value="Pilates">Pilates</option>
                        </select>
                    </div>

                    <!-- Workout Name Input -->
                    <div class="mb-3">
                        <label for="workoutName" class="form-label">Workout Name</label>
                        <input type="text" class="form-control" name="workoutName" id="workoutName" placeholder="e.g., Morning Run" required>
                    </div>

                    <!-- Workout Date Input -->
                    <div class="mb-3">
                        <label for="workoutDate" class="form-label">Date</label>
                        <input type="date" name="workoutDate" class="form-control" id="workoutDate" required>
                    </div>

                    <!-- Workout Intensity Radio Buttons -->
                    <div class="mb-3">
                        <label class="form-label">Workout Intensity</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="intensity" id="intensityLow" value="Low" required>
                                <label class="form-check-label" for="intensityLow">Low</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="intensity" id="intensityMedium" value="Medium" required>
                                <label class="form-check-label" for="intensityMedium">Medium</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="intensity" id="intensityHigh" value="High" required>
                                <label class="form-check-label" for="intensityHigh">High</label>
                            </div>
                        </div>
                    </div>

                    <!-- Workout Duration Input -->
                    <div class="mb-3">
                        <label for="workoutDuration" class="form-label">Duration (in minutes)</label>
                        <input type="number" class="form-control" name="workoutDuration" id="workoutDuration" placeholder="e.g., 30" required>
                    </div>

                    <!-- Workout Weight Input -->
                    <div class="mb-3">
                        <label for="workoutWeight" class="form-label">Weight (kg)</label>
                        <input type="number" class="form-control" name="weight" id="workoutWeight" placeholder="e.g., 70" required>
                    </div>

                    <!-- Workout Height Input -->
                    <div class="mb-3">
                        <label for="workoutHeight" class="form-label">Height (cm)</label>
                        <input type="number" class="form-control" name="height" id="workoutHeight" placeholder="e.g., 170" required>
                    </div>

                    <!-- Calories Burned Input -->
                    <div class="mb-3">
                        <label for="caloriesBurned" class="form-label">Calories Burned</label>
                        <input type="number" class="form-control" name="burnCaleroy" id="caloriesBurned" placeholder="e.g., 400" required>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-success w-100" name="saveWorkout">Save Workout</button>
                </form>
            </div>
        </div>
    </div>
</div>



<!--//////////////////////////////////////////////////////////////// Set Appoinment details /////////////////////////////////////////////// -->
<div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="appointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="appointmentModalLabel">Book a Live Session</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Session Booking Form -->
                <form id="appointmentForm" action="include/makeSession.inc.php" method="POST">
                    <!-- Workout Type Dropdown -->
                    <div class="mb-3">
                        <label for="workoutType" class="form-label">Workout Type</label>
                        <select class="form-select" id="workoutType" name="sessionType">
                            <option value="Cardio">Cardio</option>
                            <option value="Yoga">Yoga</option>
                            <option value="Strength Training">Strength Training</option>
                            <option value="HIIT">HIIT</option>
                            <option value="Pilates">Pilates</option>
                        </select>
                    </div>
                    <!-- Trainer Name Input -->
                    <div class="mb-3">
                        <label for="sessionTrainer" class="form-label">Trainer Name</label>
                        <input type="text" name="sessionTrainer" class="form-control" id="sessionTrainer">
                    </div>
                    <!-- Date Input -->
                    <div class="mb-3">
                        <label for="sessionDate" class="form-label">Date</label>
                        <input type="date" name="sessionDate" class="form-control" id="sessionDate">
                    </div>
                    <!-- Time Input -->
                    <div class="mb-3">
                        <label for="sessionTime" class="form-label">Time</label>
                        <input type="time" name="sessionTime" class="form-control" id="sessionTime">
                    </div>
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-success w-100" name="saveSession">Book Session</button>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- /////////////////////////////////////////////Previous Workouts table///////////////////////////////////////////////////////////// -->
<div class="modal fade" id="previousWorkoutsModal" tabindex="-1" aria-labelledby="previousWorkoutsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="previousWorkoutsModalLabel">Previous Workouts</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <table class="table table-bordered table-hover shadow-sm">
                    <!-- Table Header -->
                    <thead class="bg-info text-white">
                        <tr>
                            <th>Workout Type</th>
                            <th>Workout Name</th>
                            <th>Date</th>
                            <th>Calories Burned</th>
                            <th>Weight</th>
                            <th>Height</th>
                            <th>Level</th>
                            <th>Duration (min)</th>
                        </tr>
                    </thead>
                    <!-- Table Body -->
                    <tbody id="previousWorkoutsTableBody">
                        <?php
                        // Fetch all previous workout data from the database
                        $sql = "SELECT * FROM workout;";
                        $stmt = $mysqli->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $rows = $result->fetch_all(MYSQLI_ASSOC);

                        // Loop through the data and display it in the table
                        foreach ($rows as $workout) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($workout['type']) . "</td>";
                            echo "<td>" . htmlspecialchars($workout['name']) . "</td>";
                            echo "<td>" . htmlspecialchars($workout['date']) . "</td>";
                            echo "<td>" . htmlspecialchars($workout['burnCalory']) . "</td>";
                            echo "<td>" . htmlspecialchars($workout['weight']) . "</td>";
                            echo "<td>" . htmlspecialchars($workout['height']) . "</td>";
                            echo "<td>" . htmlspecialchars($workout['level']) . "</td>";
                            echo "<td>" . htmlspecialchars($workout['duration']) . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- ///////////////////////////////////////////////// for to draw chart get data from database //////////////////////////////////////////////////////////// -->
<?php
$sql = "SELECT date,burnCalory,height,weight FROM workout;";
$result = $mysqli->query($sql);

// Prepare data for Chart.js
$labels = [];
$data = [];
$bmiData = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $labels[] = $row['date'];
        $data[] = $row['burnCalory'];

        // Calculate BMI: weight (kg) / (height (m) * height (m))
        $heightInMeters = $row['height'] / 100; // Convert height to meters
        $bmi = $row['weight'] / ($heightInMeters * $heightInMeters);
        $bmiData[] = round($bmi, 2); // Round to 2 decimal places
    }
}

// Encode data to JSON
$labelsJson = json_encode($labels);
$dataJson = json_encode($data);
$bmiDataJson = json_encode($bmiData);
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Display previous workouts in the modal when the button is clicked
    // document.getElementById("previousWorkoutsModal").addEventListener("show.bs.modal", displayPreviousWorkoutsTable);



    // Chart.js calerory chart Configuration

    document.addEventListener("DOMContentLoaded", function() {
        // PHP Data for Chart.js
        const labels = <?php echo $labelsJson; ?>;
        const data = <?php echo $dataJson; ?>;

        // Initialize Chart.js
        const ctx = document.getElementById('caloriesChart').getContext('2d');
        const caloriesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Calories Burned',
                    data: data,
                    borderColor: 'rgba(0, 128, 0, 1)',
                    backgroundColor: 'rgba(0, 128, 0, 0.2)',
                    pointBackgroundColor: 'yellow',
                    pointBorderColor: 'darkgreen',
                    tension: 0.3 // Smooth line curve
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true, // Maintain aspect ratio
                scales: {
                    y: {
                        beginAtZero: true,
                        // min: 300, // Fixed minimum value
                        // max: 700, // Fixed maximum value
                        ticks: {
                            stepSize: 50
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: 'black'
                        }
                    }
                }
            }
        });
    });

    // implement bmi chart
    document.addEventListener("DOMContentLoaded", function() {
        // PHP Data for Chart.js
        const labels = <?php echo $labelsJson; ?>;
        const bmiData = <?php echo $bmiDataJson; ?>;

        // Function to determine BMI category
        function getBMICategory(bmi) {
            if (bmi < 18.5) {
                return 'Underweight';
            } else if (bmi >= 18.5 && bmi < 24.9) {
                return 'Normal weight';
            } else if (bmi >= 25 && bmi < 29.9) {
                return 'Overweight';
            } else {
                return 'Obesity';
            }
        }

        // Function to determine color based on BMI category
        function getBMICategoryColor(bmi) {
            if (bmi < 18.5) {
                return 'red'; // Underweight
            } else if (bmi >= 18.5 && bmi < 24.9) {
                return 'green'; // Normal weight
            } else if (bmi >= 25 && bmi < 29.9) {
                return 'orange'; // Overweight
            } else {
                return 'purple'; // Obesity
            }
        }

        // Add BMI categories and colors to the data points
        const pointColors = bmiData.map(bmi => getBMICategoryColor(bmi));

        // Initialize Chart.js
        const ctx = document.getElementById('bmiChart').getContext('2d');
        const bmiChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'BMI',
                    data: bmiData,
                    borderColor: 'rgba(0, 0, 255, 1)',
                    backgroundColor: 'rgba(0, 0, 255, 0.2)',
                    pointBackgroundColor: pointColors, // Use dynamic colors for points
                    pointBorderColor: pointColors,
                    tension: 0.3 // Smooth line curve
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true, // Maintain aspect ratio
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 5
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: 'black'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const bmi = context.raw;
                                const category = getBMICategory(bmi);
                                return `BMI: ${bmi} (${category})`;
                            }
                        }
                    }
                }
            }
        });
    });
</script>

<?php
include_once "component/dashboard_footer.php";  // Include dashboard footer
?>