<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dolphin Fitness Club-Blog</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS for Navbar -->
    <style>
        .navbar {
            background-color: #000;
            /* Black background */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Add shadow for depth */
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: white !important;
            /* White text for the brand */
        }

        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            /* Semi-transparent white text */
            font-weight: 500;
            margin: 0 10px;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: white !important;
            /* Fully white on hover */
        }

        .navbar-toggler {
            border: none;
            /* Remove border from toggler */
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3e%3cpath stroke='rgba(255, 255, 255, 0.8)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .dropdown-menu {
            background-color: #000;
            /* Match navbar background */
            border: none;
            /* Remove border */
        }

        .dropdown-item {
            color: rgba(255, 255, 255, 0.8) !important;
            /* Semi-transparent white text */
            font-weight: 500;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            /* Light hover effect */
            color: white !important;
            /* Fully white on hover */
        }

        .search-form {
            margin-left: auto;
            /* Push search bar to the right */
            margin-right: 10px;
            /* Add spacing */
        }

        .search-form .form-control {
            background-color: rgba(255, 255, 255, 0.1);
            /* Semi-transparent background */
            border: none;
            /* Remove border */
            color: white;
            /* White text */
        }

        .search-form .form-control::placeholder {
            color: rgba(255, 255, 255, 0.6);
            /* Semi-transparent placeholder */
        }

        .search-form .btn {
            background-color: #007bff;
            /* Bootstrap primary color */
            border: none;
            /* Remove border */
            color: white;
            /* White text */
        }

        .search-form .btn:hover {
            background-color: #0056b3;
            /* Darker shade on hover */
        }

        .logout-btn {
            background-color: #dc3545;
            /* Bootstrap danger color */
            border: none;
            /* Remove border */
            color: white;
            /* White text */
            padding: 8px 16px;
            /* Add padding */
            border-radius: 5px;
            /* Rounded corners */
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #c82333;
            /* Darker shade on hover */
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <!-- Brand/Logo -->
            <a class="navbar-brand" href="#">Dolphin Fitness Club Blog</a>

            <!-- Toggler for Mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
              

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="blog_home.php">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="blog_my_blog.php">MY Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="blog_about.php">About</a>

                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../dashboard/pages/home.php">User Dashboard</a>
                    </li>


                    <!-- Logout Button -->
                    <li class="nav-item">
                        <a class="nav-link logout-btn" href="blog_logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>