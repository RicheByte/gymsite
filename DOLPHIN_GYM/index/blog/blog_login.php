<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Fonts for Material Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=arrow_back" />
    <!-- Google Fonts for Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Page Title -->
    <title>Fitness Blog Login</title>
    <!-- Inline CSS for Styling -->
    <style>
        /* General Body Styling */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1a2a6c, #b21f1f, #fdbb2d); /* Fitness-inspired gradient */
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }

        /* Glassmorphism Container for the Login Form */
        .login-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            padding: 2.5rem;
            width: 100%;
            max-width: 400px;
            text-align: center;
            box-sizing: border-box;
            position: relative;
            animation: fadeIn 0.8s ease-in-out;
        }

        /* Back Arrow Styling */
        .back-arrow {
            position: absolute;
            top: 1.5rem;
            left: 1.5rem;
            text-decoration: none;
            font-size: 1.5rem;
            color: #fff;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .back-arrow:hover {
            color: #fdbb2d; /* Fitness-inspired yellow color on hover */
            transform: translateX(-5px); /* Slight move left on hover */
        }

        /* Title Styling */
        .login-title {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            color: #fff;
            font-weight: 600;
        }

        /* Subtitle Styling */
        .login-subtitle {
            margin: 0.5rem 0 2rem;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.8);
        }

        /* Form Input Styling */
        .form-group {
            margin-bottom: 1.5rem;
            text-align: left;
        }

        .form-group label {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-group input {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            font-size: 1rem;
            box-sizing: border-box;
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-group input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .form-group input:focus {
            border-color: #fdbb2d; /* Fitness-inspired yellow focus color */
            outline: none;
            box-shadow: 0 0 10px rgba(253, 187, 45, 0.5);
        }

        /* Login Button Styling */
        .login-button {
            background: #fdbb2d; /* Fitness-inspired yellow */
            color: #000;
            padding: 0.8rem 1.5rem;
            font-size: 1rem;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            width: 100%;
            font-weight: 600;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .login-button:hover {
            background: #e6a800; /* Darker yellow on hover */
            transform: translateY(-2px); /* Slight lift effect */
        }

        .login-button:active {
            transform: translateY(0); /* Reset on click */
        }

        /* Register Link Styling */
        .register-link {
            margin-top: 1.5rem;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.8);
        }

        .register-link a {
            color: #fdbb2d; /* Fitness-inspired yellow */
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .register-link a:hover {
            color: #e6a800; /* Darker yellow on hover */
        }

        /* Fade-in Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Background Animation */
        @keyframes moveBackground {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        body {
            animation: moveBackground 10s ease infinite;
            background-size: 200% 200%;
        }
    </style>
</head>

<body>
    <!-- Login Container -->
    <div class="login-container">
        <!-- Back Arrow to Home Page -->
        <a href="/gymsite/DOLPHIN_GYM/index/" class="back-arrow">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>

        <!-- Login Title -->
        <h2 class="login-title">Welcome Back</h2>
        <!-- Login Subtitle -->
        <p class="login-subtitle">Log in to access exclusive fitness content</p>

        <!-- Login Form -->
        <form action="include/blog_login.inc.php" method="POST">
            <!-- Username Input -->
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required placeholder="Enter your username">
            </div>
            <!-- Password Input -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required placeholder="Enter your password">
            </div>
            <!-- Login Button -->
            <button type="submit" class="login-button">Login</button>
        </form>

    
    </div>
</body>

</html>
