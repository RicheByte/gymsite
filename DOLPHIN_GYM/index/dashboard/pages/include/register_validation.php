<?php
require_once "db.php";

function checkUserName($conn, $userName)
{
    $result=False; 

    $sql = "SELECT username FROM users WHERE username=?;";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $userName);
    $stmt->execute();
    $result = $stmt->get_result();
    $row=$result->fetch_assoc();
    
    if($row && $userName==$row['username']){
     return True;
    }else{
        return False;
    }
   

}








function checkPassword($password, $rePassword)
{

    if ($password == $rePassword) {
        return true;
    } else {
        return false;
    }
}
