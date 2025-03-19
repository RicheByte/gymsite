<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dolphin Fitness Club-User Dashboard</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        /* Navbar Background */
        .navbar-custom {
            background-color: #2C2C2C;
            padding: 0.75rem 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Navbar Brand */
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: #ffffff !important;
            transition: color 0.3s ease;
        }

        .navbar-brand:hover {
            color: #ffc107 !important;
        }

        /* Navbar Links */
        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            font-size: 1rem;
            margin: 0 0.75rem;
            padding: 0.5rem 1rem;
            position: relative;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #ffffff !important;
            transform: translateY(-2px);
        }

        /* Active Link */
        .navbar-nav .nav-link.active {
            color: #ffffff !important;
            font-weight: bold;
        }

        /* Underline Animation */
        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: #ffc107;
            transition: width 0.3s ease;
        }

        .navbar-nav .nav-link:hover::after {
            width: 100%;
        }

        /* Logout Button */
        .btn-logout {
            background-color: #28a745;
            color: #ffffff;
            padding: 0.5rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-logout:hover {
            background-color: #218838;
            transform: translateY(-2px);
        }

        .btn-logout:active {
            transform: translateY(0);
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .navbar-nav {
                margin-top: 1rem;
            }

            .navbar-nav .nav-link {
                margin: 0.5rem 0;
                padding: 0.5rem;
            }

            .btn-logout {
                width: 100%;
                margin-top: 1rem;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <!-- Brand Logo -->
            <a class="navbar-brand" href="home.php">
                <i class="fas fa-dumbbell me-2"></i>Dolphin Fitness
            </a>

            <!-- Toggle Button for Mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="leaderboard.php">Leaderboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="diet-tracker.php">Diet Tracker</a></li>
                    <li class="nav-item"><a class="nav-link" href="ai-chat.php">AI Chat</a></li>
                    <li class="nav-item"><a class="nav-link" href="live-trainer.php">Live Trainer</a></li>
                    <li class="nav-item"><a class="nav-link" href="forum.php">Forum</a></li>
                    <li class="nav-item"><a class="nav-link" href="support.php">Support</a></li>
                    <li class="nav-item"><a class="nav-link" href="../../blog/blog_home.php">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="store/shop.php">Store</a></li>
                </ul>

                <!-- Logout Button -->
                <button class="btn btn-logout ms-3" onclick="window.location.href='logout.php'">
                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                </button>
            </div>
        </div>
    </nav>

    <!-- Bootstrap 5 JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>