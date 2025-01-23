<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background: linear-gradient(135deg, rgb(34, 33, 34), rgb(97, 97, 97)); color: #fff; display: flex; justify-content: center; align-items: center; height: 100vh;">
    <div style="background: #ffffff; color: #333; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 2rem; width: 100%; max-width: 400px; text-align: center; box-sizing: border-box;">
        <h2 style="font-size: 1.8rem; margin-bottom: 0.5rem; color: rgb(32, 32, 32);">Create Your Account</h2>
        <p style="margin: 0.5rem 0 1.5rem; font-size: 0.9rem; color: #666;">Sign up to get started</p>
        <form action="register_handler.php" method="POST">
            <div style="margin-bottom: 1.5rem; text-align: left;">
                <label for="username" style="font-size: 0.9rem; color: #555; margin-bottom: 0.3rem; display: block;">Username</label>
                <input type="text" name="username" id="username" required style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem; box-sizing: border-box;">
            </div>
            <div style="margin-bottom: 1.5rem; text-align: left;">
                <label for="password" style="font-size: 0.9rem; color: #555; margin-bottom: 0.3rem; display: block;">Password</label>
                <input type="password" name="password" id="password" required style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem; box-sizing: border-box;">
            </div>
            <button type="submit" style="background: rgb(34, 34, 34); color: #fff; padding: 0.8rem 1.5rem; font-size: 1rem; border: none; border-radius: 5px; cursor: pointer; width: 100%; transition: background 0.3s ease;">Register</button>
        </form>
        <p style="margin-top: 1.5rem; font-size: 0.9rem;">Already have an account? <a href="login.php" style="color: rgb(13, 69, 167); text-decoration: none; font-weight: bold;">Login</a></p>
    </div>
</body>
</html>
