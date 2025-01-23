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
    <title>AI Chat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/ai-chat.css">
</head>
<body>
    <!-- Navbar -->
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
    <a href="logout.php" 
       style="background: green; color: white; text-decoration: none; padding: 0.8rem 1.5rem; font-size: 1rem; border: none; border-radius: 5px; cursor: pointer; transition: background 0.3s ease; text-align: center; margin-left: auto;"
       onmouseover="this.style.background='yellow'; this.style.color='black';"
       onmouseout="this.style.background='green'; this.style.color='white';">
        Logout
    </a>
</nav>


    <main class="container mt-5">
        <h1>AI Chat</h1>
        <div class="chat-container">
            <div class="chat-box">
                <div class="chat-message bot-message">
                    Hello! How can I assist you with your fitness journey today?
                </div>
            </div>
            <div class="input-container">
                <input type="text" id="userInput" class="form-control" placeholder="Ask me anything...">
                <button class="btn btn-primary" id="sendBtn">Send</button>
            </div>
        </div>
    </main>

    <footer class="text-center mt-5 py-4" style="background-color: #2C2C2C; color: #D1D1D1;">
        <p>&copy; 2025 FitLife Gym. All Rights Reserved.</p>
    </footer>

    <script src="../js/ai-chat.js"></script>
</body>
</html>
