
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

<?php
// Check to make sure the id parameter is specified in the URL
if (isset($_GET['id'])) {
    // Prepare statement and execute, prevents SQL injection
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if (!$product) {
        // Simple error to display if the id for the product doesn't exists (array is empty)
        exit('Product does not exist!');
    }
} else {
    // Simple error to display if the id wasn't specified
    exit('Product does not exist!');
}
?>
<?=template_header('Product')?>

<div class="product content-wrapper">
    <img src="imgs/<?=$product['img']?>" width="500" height="500" alt="<?=$product['title']?>">
    <div>
        <h1 class="name"><?=$product['title']?></h1>
        <span class="price">
            &dollar;<?=$product['price']?>
            <?php if ($product['rrp'] > 0): ?>
            <span class="rrp">&dollar;<?=$product['rrp']?></span>
            <?php endif; ?>
        </span>
        <form action="index.php?page=cart" method="post">
            <input type="number" name="quantity" value="1" min="1" max="<?=$product['quantity']?>" placeholder="Quantity" required>
            <input type="hidden" name="product_id" value="<?=$product['id']?>">
            <input type="submit" value="Add To Cart">
        </form>
        <div class="description">
            <?=$product['description']?>
        </div>
    </div>
</div>

<?=template_footer()?>