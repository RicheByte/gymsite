<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

// Example of user count (Replace with actual database queries)
$user_count = 50; // Placeholder
$users = [
    ['name' => 'User 1', 'email' => 'user1@example.com', 'registered' => '2024-01-01'],
    ['name' => 'User 2', 'email' => 'user2@example.com', 'registered' => '2024-02-01'],
    // Add more users as needed
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="content-wrapper">
            <h1>Admin Panel</h1>
            <nav>
                <a href="../DOLPHIN_GYM/index/blog/dashboard.php">Dashboard</a>
                <a href="../DOLPHIN_GYM/index/blog/products.php">Products</a>
                <a href="../DOLPHIN_GYM/index/blog/orders.php">Orders</a>
                <a href="../DOLPHIN_GYM/index/blog/users.php">Users</a>
                <a href="blog.php">Blog</a> <!-- Added Blog link here -->
            </nav>
            <div class="link-icons">
                <a href="profile.php">
                    <i class="fas fa-user"></i>
                </a>
                <a href="settings.php">
                    <i class="fas fa-cogs"></i>
                </a>
            </div>
        </div>
    </header>

    <div class="container dashboard">
        <h3>Welcome, Admin</h3>
        <p><a href="logout.php" class="logout-btn">Logout</a></p>

        <h4>User Details</h4>
        <p>Total Users: <?php echo $user_count; ?></p>

        <h4>User List</h4>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Registration Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) { ?>
                    <tr>
                        <td><?php echo $user['name']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['registered']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
