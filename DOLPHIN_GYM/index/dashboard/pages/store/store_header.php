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




<nav class="navbar navbar-shop navbar-expand-lg navbar-dark bg-dark py-3 shadow-sm">
    <div class="container">
        <!-- Brand Logo -->
        <a class="navbar-brand text-light fs-4 fw-bold" href="shop.php">
            <i class="fas fa-store me-2"></i>My Store
        </a>

        <!-- Toggle Button for Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            <ul class="navbar-nav text-center">
           
                <li class="nav-item mx-2">
                    <a class="nav-link fs-5 position-relative" href="cart.php">
                        <i class="fas fa-shopping-cart me-1"></i>Cart
                        <span class="nav-link-underline"></span>
                    </a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link fs-5 position-relative" href="orders.php">
                        Orders
                        <span class="nav-link-underline"></span>
                    </a>
                </li>
            </ul>

            <!-- Logout Button -->
            <div class="d-flex align-items-center">
                <button class="btn btn-logout" onclick="window.location.href='../home.php'">
                    <i class="fas fa-sign-out-alt me-2"></i>Back
                </button>
            </div>
        </div>
    </div>
</nav>

<!-- Custom CSS for Enhanced Styling -->
<style>
    /* Navbar Background */
    .navbar-shop {
        background-color: rgba(5, 8, 8, 0.9) !important;
    }

    /* Navbar Brand Icon */
    .navbar-brand i {
        color: #ffc107; /* Yellow color for the store icon */
    }

    /* Navbar Link Hover Effect */
    .nav-link {
        color: rgba(255, 255, 255, 0.8) !important;
        transition: color 0.3s ease, transform 0.3s ease;
        position: relative;
    }

    .nav-link:hover {
        color: #ffffff !important;
        transform: translateY(-2px);
    }

    /* Underline Animation */
    .nav-link-underline {
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 0;
        height: 2px;
        background-color: #ffc107; /* Yellow color for the underline */
        transition: width 0.3s ease;
    }

    .nav-link:hover .nav-link-underline {
        width: 100%;
    }

    /* Active Link Styling */
    .nav-link.active {
        color: #ffffff !important;
        font-weight: bold;
    }

    .nav-link.active .nav-link-underline {
        width: 100%;
    }

    /* Navbar Shadow */
    .navbar {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Logout Button Styling */
    .btn-logout {
        background-color: transparent;
        border: 2px solid #ffc107;
        color: #ffc107;
        padding: 0.5rem 1.5rem;
        font-size: 1rem;
        font-weight: 600;
        border-radius: 5px;
        transition: background-color 0.3s ease, color 0.3s ease, transform 0.3s ease;
    }

    .btn-logout:hover {
        background-color: #ffc107;
        color: #000;
        transform: translateY(-2px);
    }

    .btn-logout:active {
        transform: translateY(0);
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .navbar-collapse {
            flex-direction: column;
            align-items: flex-start;
        }

        .btn-logout {
            margin-top: 1rem;
            width: 100%;
            text-align: center;
        }
    }
</style>