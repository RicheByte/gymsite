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
    <title>Leaderboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/leaderboard.css">
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #2C2C2C; padding: 0.5rem 1rem;">
    <a class="navbar-brand" href="home.php" style="font-weight: bold;">FitLife Gym</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
            <li class="nav-item"><a class="nav-link active" href="leaderboard.php">Leaderboard</a></li>
            <li class="nav-item"><a class="nav-link" href="diet-tracker.php">Diet Tracker</a></li>
            <li class="nav-item"><a class="nav-link" href="ai-chat.php">AI Chat</a></li>
            <li class="nav-item"><a class="nav-link" href="live-trainer.php">Live Trainer</a></li>
            <li class="nav-item"><a class="nav-link" href="forum.php">Forum</a></li>
            <li class="nav-item"><a class="nav-link" href="support.php">Support</a></li>
            <li class="nav-item"><a class="nav-link" href="/DOLPHIN_GYM/index/store/shoppingcart/index.php">Store</a></li>
        </ul>
    </div>
    <a href="logout.php" 
       style="background: green; color: white; text-decoration: none; padding: 0.8rem 1.5rem; font-size: 1rem; border: none; border-radius: 5px; cursor: pointer; transition: background 0.3s ease; text-align: center; margin-left: auto;"
       onmouseover="this.style.background='yellow'; this.style.color='black';"
       onmouseout="this.style.background='green'; this.style.color='white';">
        Logout
    </a>
</nav>

<main class="container mt-5">
    <h1 class="text-center mb-4">Leaderboard</h1>

    <!-- Search Bar -->
    <div class="input-group mb-4">
        <input type="text" id="searchInput" class="form-control" placeholder="Search for a name..." onkeyup="filterLeaderboard()">
    </div>

    <!-- Leaderboard Table -->
    <div class="table-responsive">
        <table class="table table-striped table-dark text-center">
            <thead>
                <tr>
                    <th style="color: #FFFFFF;">Rank</th>
                    <th style="color: #FFFFFF;">Name</th>
                    <th style="color: #FFFFFF;">Points</th>
                    <th style="color: #FFFFFF;">Progress</th>
                </tr>
            </thead>
            <tbody id="leaderboardTable">
                <tr style="color: #FFFFFF;">
                    <td>1</td>
                    <td>John Doe</td>
                    <td>150</td>
                    <td>
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="150" aria-valuemin="0" aria-valuemax="150">150</div>
                        </div>
                    </td>
                </tr>
                <tr style="color: #FFFFFF;">
                    <td>2</td>
                    <td>Jane Smith</td>
                    <td>120</td>
                    <td>
                        <div class="progress">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 80%;" aria-valuenow="120" aria-valuemin="0" aria-valuemax="150">120</div>
                        </div>
                    </td>
                </tr>
                <tr class="table-warning" style="color: #333333;">
                    <td>3</td>
                    <td>You</td>
                    <td>100</td>
                    <td>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 67%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="150">100</div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</main>

<footer class="text-center mt-5 py-4" style="background-color: #2C2C2C; color: #D1D1D1;">
    <p>&copy; 2025 FitLife Gym. All Rights Reserved.</p>
</footer>

<script>
    // Filter leaderboard dynamically
    function filterLeaderboard() {
        const searchInput = document.getElementById("searchInput").value.toLowerCase();
        const tableRows = document.querySelectorAll("#leaderboardTable tr");

        tableRows.forEach(row => {
            const name = row.cells[1].textContent.toLowerCase();
            row.style.display = name.includes(searchInput) ? "" : "none";
        });
    }
</script>

</body>
</html>
