<?php
session_start();
require_once 'db.php';


$userName = $_POST['username'];
$password = $_POST['password'];

loginUser($mysqli,$userName,$password);

function loginUser($conn, $userName, $password){

    $sql = "SELECT id,username,password FROM admin WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $userName);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row && $row['username'] == $userName) {

       navigateLogin($row['password'],$password,$row['username'],$row['id']);

    } else {   //if user name not found
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
                <h2 style="font-size: 1.8rem; margin-bottom: 1rem; color:rgb(32, 32, 32);">Login Failed</h2>
                <p style="margin-bottom: 1.5rem; font-size: 1rem; color: #666;">User Name Not Found</p>
                <a href="../login.php"
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
}

function navigateLogin($dbPassword,$password,$username,$userID){
    
    if(password_verify($password,$dbPassword)){
         $_SESSION['admin_logged_in'] = true;
         $_SESSION['admin_username'] = $username;
         
          $_SESSION['admin_userid']=$userID;
          header("location: ../dashboard.php?message=admin_log_in"); 
         exit;
    }else{  //if password not matching
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
                <h2 style="font-size: 1.8rem; margin-bottom: 1rem; color:rgb(32, 32, 32);">Login Failed</h2>
                <p style="margin-bottom: 1.5rem; font-size: 1rem; color: #666;">Password Wrong.Try Again</p>
                <a href="../login.php"
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
}


