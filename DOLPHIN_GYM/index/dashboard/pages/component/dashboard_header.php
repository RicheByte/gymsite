<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../css/leaderboard.css">
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #2C2C2C; padding: 0.5rem 1rem;">
    <a class="navbar-brand" href="home.php" style="font-weight: bold;">DOLPGIN GYM</a>
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