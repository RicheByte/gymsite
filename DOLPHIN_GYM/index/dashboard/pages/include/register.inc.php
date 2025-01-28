<?php

require_once 'db.php';
require_once 'register_validation.php';

$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$confirmPassword = $_POST['re-password'];

if (!checkUserName($mysqli, $username)) {
    if (checkPassword($password, $confirmPassword)) {
        $dbPassword = password_hash($password, PASSWORD_DEFAULT); //hash passwording
        createUser($mysqli, $firstName, $lastName, $email, $username, $dbPassword);
    } else {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Login Error</title>
        </head>

        <body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background: linear-gradient(135deg,rgb(34, 33, 34),rgb(97, 97, 97)); color: #fff; display: flex; justify-content: center; align-items: center; height: 100vh;">
            <div style="background: #ffffff; color: #333; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 2rem; width: 100%; max-width: 400px; text-align: center; box-sizing: border-box;">
                <h2 style="font-size: 1.8rem; margin-bottom: 1rem; color:rgb(32, 32, 32);">Account Created Failed</h2>
                <p style="margin-bottom: 1.5rem; font-size: 1rem; color: #666;">Password Not Maching. Please try again.</p>
                <a href="../register.php"
                    style="display: inline-block; background:rgb(34, 34, 34); color: #fff; text-decoration: none; padding: 0.8rem 1.5rem; font-size: 1rem; border: none; border-radius: 5px; cursor: pointer; transition: background 0.3s ease;"
                    onmouseover="this.style.background='yellow'; this.style.color='black';"
                    onmouseout="this.style.background='rgb(34, 34, 34)'; this.style.color='white';">
                    Try Again
                </a>
            </div>
        </body>

        </html>



<?php
        // header("Location:../login.php?error=Password-not-match");
    }
}else{
    ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Login Error</title>
        </head>

        <body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background: linear-gradient(135deg,rgb(34, 33, 34),rgb(97, 97, 97)); color: #fff; display: flex; justify-content: center; align-items: center; height: 100vh;">
            <div style="background: #ffffff; color: #333; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 2rem; width: 100%; max-width: 400px; text-align: center; box-sizing: border-box;">
                <h2 style="font-size: 1.8rem; margin-bottom: 1rem; color:rgb(32, 32, 32);">Account Created Failed</h2>
                <p style="margin-bottom: 1.5rem; font-size: 1rem; color: #666;">User Name Already Taken.Choose Another One</p>
                <a href="../register.php"
                    style="display: inline-block; background:rgb(34, 34, 34); color: #fff; text-decoration: none; padding: 0.8rem 1.5rem; font-size: 1rem; border: none; border-radius: 5px; cursor: pointer; transition: background 0.3s ease;"
                    onmouseover="this.style.background='yellow'; this.style.color='black';"
                    onmouseout="this.style.background='rgb(34, 34, 34)'; this.style.color='white';">
                    Try Again
                </a>
            </div>
        </body>

        </html>



<?php
}



function createUser($conn, $firstName, $lastName, $email, $username, $password)
{
    $sql = "INSERT INTO users (	first_name,last_name,email,username,password) VALUES (?, ?, ?,?,?)";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param('sssss', $firstName, $lastName, $email, $username, $password);

    if ($stmt->execute()) {
        header("Location:../login.php?message=User-Create-Sucessfully");
    } else {
        header("Location:../login.php?error=User-Create-Unsucessfully");
    }
}
