<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - FitLife Gym</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        
    </style>
</head>
<body>
    <header>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #2C2C2C; padding: 0.5rem 1rem;">
            <a class="navbar-brand" href="home.php" style="font-weight: bold;">FitLife Gym</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="leaderboard.php">Leaderboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="diet-tracker.php">Diet Tracker</a></li>
                    <li class="nav-item"><a class="nav-link" href="ai-chat.php">AI Chat</a></li>
                    <li class="nav-item"><a class="nav-link" href="live-trainer.php">Live Trainer</a></li>
                    <li class="nav-item"><a class="nav-link" href="forum.php">Forum</a></li>
                    <li class="nav-item"><a class="nav-link" href="support.php">Support</a></li>
                    <li class="nav-item"><a class="nav-link" href="/DOLPHIN_GYM/index/store/shoppingcart/index.php">Store</a></li>
                </ul>
                <a href="logout.php" 
                   style="background: green; color: white; text-decoration: none; padding: 0.8rem 1.5rem; font-size: 1rem; border: none; border-radius: 5px; cursor: pointer; transition: background 0.3s ease; text-align: center;"
                   onmouseover="this.style.background='yellow'; this.style.color='black';"
                   onmouseout="this.style.background='green'; this.style.color='white';">
                    Logout
                </a>
            </div>
        </nav>
    </header>

    <main class="container mt-5">
        <!-- Welcome Banner -->
        <div class="jumbotron text-center">
            <h1>Welcome Back, [Username]!</h1>
            <p>Let’s crush your fitness goals today!</p>
        </div>

        <!-- Quick Access Section -->
        <div class="row text-center mb-4">
            <div class="col-md-4">
                <button class="btn btn-success btn-lg w-100 mb-3">Start a Workout</button>
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary btn-lg w-100 mb-3">Track Your Diet</button>
            </div>
            <div class="col-md-4">
                <button class="btn btn-warning btn-lg w-100 mb-3">Join Live Session</button>
            </div>
        </div>

        <!-- Dashboard Features -->
        <div class="row">
            <div class="col-md-6">
                <h3>Your Progress</h3>
                <canvas id="progressChart"></canvas>
            </div>
            <div class="col-md-6">
                <h3>Upcoming Sessions</h3>
                <ul class="list-group">
                    <li class="list-group-item">Session with Trainer John - 5 PM</li>
                    <li class="list-group-item">Yoga Class - Tomorrow at 8 AM</li>
                    <li class="list-group-item">Cardio Blast - Thursday at 6 PM</li>
                </ul>
            </div>
        </div>
    </main>

    <footer class="text-center mt-5 py-4" style="background-color: #2C2C2C; color: #D1D1D1;">
        <p>&copy; 2025 FitLife Gym. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Chart.js Configuration
        const ctx = document.getElementById('progressChart').getContext('2d');
        const progressChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5'],
                datasets: [{
                    label: 'Calories Burned',
                    data: [400, 450, 500, 550, 600],
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
                        min: 300, // Fixed minimum value
                        max: 700, // Fixed maximum value
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
    </script>
</body>
</html>
