<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../../pages/login.php"); // Going two levels up from store to login page
    exit;
}
?>

<?php
// Get the 4 most recently added products
$stmt = $pdo->prepare('SELECT * FROM products ORDER BY date_added DESC LIMIT 4');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="DOLPHIN_GYM/index/dashboard/css/support.css">
</head>

 <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #2C2C2C; padding: 0.5rem 1rem;">
    <a class="navbar-brand" href="home.html" style="font-weight: bold;">FitLife Gym</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="/DOLPHIN_GYM/index/dashboard/pages/home.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="/DOLPHIN_GYM/index/dashboard/pages/leaderboard.php">Leaderboard</a></li>
            <li class="nav-item"><a class="nav-link" href="/DOLPHIN_GYM/index/dashboard/pages/diet-tracker.php">Diet Tracker</a></li>
            <li class="nav-item"><a class="nav-link" href="/DOLPHIN_GYM/index/dashboard/pages/ai-chat.php">AI Chat</a></li>
            <li class="nav-item"><a class="nav-link" href="/DOLPHIN_GYM/index/dashboard/pages/live-trainer.php">Live Trainer</a></li>
            <li class="nav-item"><a class="nav-link" href="/DOLPHIN_GYM/index/dashboard/pages/forum.php">Forum</a></li>
            <li class="nav-item"><a class="nav-link" href="/DOLPHIN_GYM/index/dashboard/pages/support.php">Support</a></li>
            <li class="nav-item"><a class="nav-link" href="/DOLPHIN_GYM/index/store/shoppingcart/index.php">Store</a></li>
        </ul>
    </div>
    <a href="/DOLPHIN_GYM/index/dashboard/pages/logout.php" 
       style="background: green; color: white; text-decoration: none; padding: 0.8rem 1.5rem; font-size: 1rem; border: none; border-radius: 5px; cursor: pointer; transition: background 0.3s ease; text-align: center; margin-left: auto;"
       onmouseover="this.style.background='yellow'; this.style.color='black';"
       onmouseout="this.style.background='green'; this.style.color='white';">
        Logout
    </a>
</nav>

<?=template_header('Home')?>

<div class="featured">
    <h2>Gadgets</h2>
    <p>Essential gadgets for everyday use</p>
</div>
<div class="recentlyadded content-wrapper">
    <h2>Recently Added Products</h2>
    <div class="products">
        <?php foreach ($recently_added_products as $product): ?>
        <a href="index.php?page=product&id=<?=$product['id']?>" class="product">
            <img src="imgs/<?=$product['img']?>" width="200" height="200" alt="<?=$product['title']?>">
            <span class="name"><?=$product['title']?></span>
            <span class="price">
                &dollar;<?=$product['price']?>
                <?php if ($product['rrp'] > 0): ?>
                <span class="rrp">&dollar;<?=$product['rrp']?></span>
                <?php endif; ?>
            </span>
        </a>
        <?php endforeach; ?>
    </div>
</div>

<?=template_footer()?>