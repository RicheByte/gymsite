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
    <title>Register</title>
    <!-- Inline CSS for Styling -->
    <style>
        /* General Body Styling */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: flex-start; /* Changed to flex-start for scrollable content */
            min-height: 100vh; /* Ensure body takes at least the full viewport height */
            padding: 20px; /* Added padding for better spacing */
        }

        /* Glassmorphism Container for the Register Form */
        .register-container {
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
            margin-top: 20px; /* Added margin for better spacing */
            margin-bottom: 20px; /* Added margin for better spacing */
        }

        /* Title Styling */
        .register-title {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            color: #fff;
            font-weight: 600;
        }

        /* Subtitle Styling */
        .register-subtitle {
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
            border-color: #ffcc00;
            outline: none;
            box-shadow: 0 0 10px rgba(255, 204, 0, 0.5);
        }

        /* Register Button Styling */
        .register-button {
            background: #ffcc00;
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

        .register-button:hover {
            background: #e6b800; /* Darker yellow on hover */
            transform: translateY(-2px); /* Slight lift effect */
        }

        .register-button:active {
            transform: translateY(0); /* Reset on click */
        }

        /* Login Link Styling */
        .login-link {
            margin-top: 1.5rem;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.8);
        }

        .login-link a {
            color: #ffcc00;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .login-link a:hover {
            color: #e6b800; /* Darker yellow on hover */
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
    <!-- Register Container -->
    <div class="register-container">
        <!-- Register Title -->
        <h2 class="register-title">Create Your Account</h2>
        <!-- Register Subtitle -->
        <p class="register-subtitle">Sign up to get started</p>

        <!-- Register Form -->
        <form action="include/register.inc.php" method="POST">
            <!-- First Name -->
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" required placeholder="Enter your first name">
            </div>
            <!-- Last Name -->
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" required placeholder="Enter your last name">
            </div>
            <!-- Email -->
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" required placeholder="Enter your email">
            </div>
            <!-- Username -->
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required placeholder="Enter your username">
            </div>
            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required placeholder="Enter your password">
            </div>
            <!-- Confirm Password -->
            <div class="form-group">
                <label for="re-password">Confirm Password</label>
                <input type="password" name="re-password" id="re-password" required placeholder="Confirm your password">
            </div>
            <!-- Register Button -->
            <button type="submit" class="register-button">Register</button>
        </form>

        <!-- Login Link -->
        <p class="login-link">Already have an account? <a href="login.php">Login</a></p>
    </div>
</body>

</html>