<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- Include Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        /* General Styles */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        .container {
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
            animation: fadeIn 0.5s ease-in-out;
            position: relative; /* Added for positioning the back arrow */
        }

        h2 {
            margin-bottom: 1.5rem;
            font-size: 2rem;
            color: #2575fc;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            text-align: left;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #555;
        }

        input {
            padding: 0.75rem;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        input:focus {
            border-color: #2575fc;
            outline: none;
            box-shadow: 0 0 5px rgba(37, 117, 252, 0.5);
        }

        button {
            padding: 0.75rem;
            background: #2575fc;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background: #1a5bbf;
            transform: translateY(-2px);
        }

        button:active {
            transform: translateY(0);
        }

        /* Back Arrow Styling */
        .back-arrow {
            position: absolute;
            top: 1rem;
            left: 1rem;
            color: #2575fc;
            font-size: 1.5rem;
            cursor: pointer;
            transition: color 0.3s ease, transform 0.2s ease;
        }

        .back-arrow:hover {
            color: #1a5bbf;
            transform: translateX(-5px);
        }

        /* Animation */
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

        /* Responsive Design */
        @media (max-width: 480px) {
            .container {
                padding: 1.5rem;
            }

            h2 {
                font-size: 1.75rem;
            }

            input, button {
                padding: 0.5rem;
                font-size: 0.9rem;
            }

            .back-arrow {
                font-size: 1.2rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Back Arrow -->
        <div class="back-arrow" onclick="window.location.href='../index.html'">
            <i class="fas fa-arrow-left"></i>
        </div>

        <h2><i class="fas fa-user-shield"></i> Admin Login</h2>
        <form method="POST" action="include/login.inc.php">
            <label for="username"><i class="fas fa-user"></i> Username:</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" required>

            <label for="password"><i class="fas fa-lock"></i> Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>

            <button type="submit"><i class="fas fa-sign-in-alt"></i> Login</button>
        </form>
    </div>
</body>

</html>