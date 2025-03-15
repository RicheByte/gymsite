<?php

include_once '../include/db.php';


// Handle Remove from Cart
if (isset($_GET["remove"])) {
  $cart_id = intval($_GET["remove"]);
  $sql_remove = "DELETE FROM cart WHERE id = ?";
  $stmt_remove = $mysqli->prepare($sql_remove);
  $stmt_remove->bind_param("i", $cart_id);


  if(  $stmt_remove->execute()){
  // Refresh the cart page
       header('Location: cart.php?message=cartRemoved');
  }else{
    header('Location: cart.php?message=cartUnRemoved');
       
  }


}