<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Page Title -->
    <title>Admin Dashboard</title>
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts for Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Inline CSS for Styling -->

    <style>
        /* General Body Styling */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: #f4f7f6;
            /* Light background for the page */
        }

        /* Header Styling */
        header {
            background: #2c3e50;
            /* Dark blue background */
            color: #fff;
            padding: 1rem 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Subtle shadow */
        }

        /* Content Wrapper for Centering */
        .content-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header Title Styling */
        header h1 {
            font-size: 1.8rem;
            font-weight: 600;
            margin: 0;
        }

        /* Navigation Links Styling */
        header nav {
            display: flex;
            gap: 1.5rem;
            /* Space between links */
        }

        header nav a {
            color: #fff;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 500;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        header nav a:hover {
            color: #ffcc00;
            /* Yellow color on hover */
            transform: translateY(-2px);
            /* Slight lift effect */
        }

        /* Icons and Log Out Button Styling */
        .link-icons {
            display: flex;
            gap: 1rem;
            /* Space between icons and button */
            align-items: center;
        }

        .link-icons a {
            color: #fff;
            text-decoration: none;
            font-size: 1.2rem;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .link-icons a:hover {
            color: #ffcc00;
            /* Yellow color on hover */
            transform: translateY(-2px);
            /* Slight lift effect */
        }

        .logout-btn {
            background: #e74c3c;
            /* Red background for the button */
            color: #fff;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .logout-btn:hover {
            background: #c0392b;
            /* Darker red on hover */
            transform: translateY(-2px);
            /* Slight lift effect */
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <header>
        <div class="content-wrapper">
            <!-- Header Title -->
            <h1>Admin Panel</h1>

            <!-- Navigation Links -->
            <nav>
                <a href="dashboard.php">Dashboard</a>
                <a href="products.php">Products</a>
                <a href="orders.php">Orders</a>
                <a href="users.php">Users</a>
                <a href="leaderboard.php">Leaderboard</a>
                <a href="liveTrain.php">Live Train</a>
                <a href="messages.php">Messages</a>
                <a href="blog.php">Blog</a> <!-- Added Blog link here -->
            </nav>

            <!-- Profile, Settings, and Log Out Button -->
            <div class="link-icons">

                <button class="logout-btn" onclick="window.location.href='logout.php'">Log Out</button>
            </div>
        </div>
    </header>