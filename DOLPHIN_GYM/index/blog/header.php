<?php
require_once 'functions.php';
require_once 'config.php';

if (!empty(SITE_ROOT)){
    $url_path = "/".SITE_ROOT."/";
} else{
    $url_path = "/";
}

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" ,initial-scale=1">
    <title>PHP Blog</title>
    <link rel="stylesheet" href="http://localhost/index/blog/assets/styles.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.19.1/ui/trumbowyg.min.css">
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg" style="background-color: #1F1F1F; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
    <div class="container" style="padding: 10px 20px;">
        <!-- Brand Logo -->
        <a class="navbar-brand" href="#" style="color: #FFFFFF; font-size: 24px; font-weight: bold; text-transform: uppercase;">FitLife Gym</a>
        <!-- Mobile Menu Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="border: none; background: transparent;">
            <span class="navbar-toggler-icon" style="color: white;"></span>
        </button>
        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto" style="gap: 20px;">
                <li class="nav-item">
                    <a class="nav-link" href="#home" style="color: #FFFFFF; font-size: 16px; transition: color 0.3s ease;">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about" style="color: #FFFFFF; font-size: 16px; transition: color 0.3s ease;">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#offers" style="color: #FFFFFF; font-size: 16px; transition: color 0.3s ease;">Offers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#membership" style="color: #FFFFFF; font-size: 16px; transition: color 0.3s ease;">Membership</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#store" style="color: #FFFFFF; font-size: 16px; transition: color 0.3s ease;">Store</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact" style="color: #FFFFFF; font-size: 16px; transition: color 0.3s ease;">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="blog/" style="color: #FFFFFF; font-size: 16px; transition: color 0.3s ease;">Blog</a>
                </li>
            </ul>
            <!-- Vertical Line Separator -->
            <div style="border-left: 1px solid #FFFFFF; height: 30px; margin-left: 10px; margin-right: 20px;"></div>
            <!-- Login Button -->
            <a href="/DOLPHIN_GYM/index/dashboard/pages/login.php" class="btn btn-login" style="background-color: #28A745; color: #FFFFFF; font-size: 16px; padding: 10px 20px; border-radius: 5px; text-transform: uppercase; font-weight: bold; text-decoration: none; transition: background-color 0.3s ease;">Login</a>
        </div>
    </div>
</nav>

<!-- Style Enhancements -->
<style>
    .navbar .nav-link:hover {
        color: #28A745 !important; /* Green hover effect for links */
    }

    .navbar .btn-login:hover {
        background-color: #1C7A3A !important; /* Darker green hover effect for the login button */
    }

    .navbar a.nav-link {
        text-decoration: none; /* Removes underline */
    }

    .navbar .nav-link, .navbar-brand {
        font-family: 'Arial', sans-serif; /* Modern font for a professional look */
        white-space: nowrap; /* Ensures text doesn't wrap to the next line */
    }

    .navbar-nav {
        display: flex; /* Keeps all nav items in a single row */
        align-items: center; /* Vertically centers nav items */
    }
</style>

<!-- Style Enhancements -->
<style>
    .navbar .nav-link:hover {
        color: #28A745 !important; /* Green hover effect for links */
    }

    .navbar .btn-login:hover {
        background-color: #1C7A3A !important; /* Darker green hover effect for the login button */
    }

    .navbar a.nav-link {
        text-decoration: none; /* Removes underline */
    }

    .navbar .nav-link, .navbar-brand {
        font-family: 'Arial', sans-serif; /* Modern font for a professional look */
    }
</style>

<!-- Style Enhancements -->
<style>
    .navbar .nav-link:hover {
        color: #28A745 !important; /* Green hover effect for links */
    }

    .navbar .btn-login:hover {
        background-color: #1C7A3A !important; /* Darker green hover effect for the login button */
    }

    .navbar a.nav-link {
        text-decoration: none; /* Removes underline */
    }

    .navbar .nav-link, .navbar-brand {
        font-family: 'Arial', sans-serif; /* Modern font for a professional look */
    }
</style>
<!-- Style Enhancements -->
<style>
    .navbar .nav-link:hover {
        color: #28A745 !important; /* Green hover effect for links */
    }

    .navbar .btn-login:hover {
        background-color: #1C7A3A !important; /* Darker green hover effect for the login button */
    }

    .navbar a.nav-link {
        text-decoration: none; /* Removes underline */
    }

    .navbar .nav-link, .navbar-brand {
        font-family: 'Arial', sans-serif; /* Modern font for a professional look */
    }
</style>

<!-- Content Wrapper -->
<div style="margin-left: 250px; padding: 20px;">
    <h1>Welcome to FitLife Gym!</h1>
    <p>Start exploring our website using the vertical navigation bar.</p>
</div>

<style>
    .navbar .nav-link:hover {
        color: #28A745 !important; /* Green hover effect for links */
    }

    .navbar .btn-login:hover {
        background-color: #1C7A3A !important; /* Darker green hover effect for the login button */
    }

    .navbar a.nav-link {
        text-decoration: none; /* Removes underline */
    }

    .navbar .nav-link, .navbar-brand {
        font-family: 'Arial', sans-serif; /* Modern font for a professional look */
    }
</style>

<style>
    .navbar .nav-link:hover {
        color: #28A745 !important; /* Green hover effect for links */
    }

    .navbar .btn-login:hover {
        background-color: #1C7A3A !important; /* Darker green hover effect for the login button */
    }

    .navbar a.nav-link {
        text-decoration: none; /* Removes underline */
    }

    .navbar .nav-link, .navbar-brand {
        font-family: 'Arial', sans-serif; /* Modern font for a professional look */
    }
</style>


<header class="w3-container w3-teal">
    <h1>PHP Blog</h1>
</header>

<div class="w3-bar w3-border">
    <?php
    if (isset($_SESSION['username'])) {
        echo "<a href='".$url_path ."../DOLPHIN_GYM/index/blog/new.php' class='w3-bar-item w3-btn'>New Post</a>";
        echo "<a href='".$url_path ."../DOLPHIN_GYM/index/blog/admin.php' class='w3-bar-item w3-btn'>Admin Panel</a>";
        echo "<a href='".$url_path ."../DOLPHIN_GYM/index/blog/logout.php' class='w3-bar-item w3-btn'>Logout</a>";
    } else {
        echo "<a href='".$url_path ."../DOLPHIN_GYM/index/blog/login.php' class='w3-bar-item w3-pale-red' >Login</a>";
    }
    ?>
</div>

<div class="w3-container">
    <form action="<?=$url_path?>search.php" method="GET" class="w3-container">
        <p>
            <input type="text" name="q" class="w3-input w3-border" placeholder="Search for anything" required>
        </p>
        <p>
        <input type="submit" class="w3-btn w3-teal w3-round" value="Search">
        </p>
    </form>
</div>
    