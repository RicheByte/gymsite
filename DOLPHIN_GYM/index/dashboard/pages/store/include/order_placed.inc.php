<?php

if (isset($_POST['confirm_order'])) {
     include_once '../../include/db.php';
     session_start();

     $shipping_address = $_POST['address'];
     $city = $_POST['city'];
     $state = $_POST['state'];
     $zip_code = $_POST['zip_code'];
   
     // Get payment details
     $card_number = $_POST['card_number'];
     $expiry_date = $_POST['expiry_date'];
     $cvv = $_POST['cvv'];
   
     // Fetch cart items
     $sql_cart = "SELECT * FROM cart";
     $result_cart = $mysqli->query($sql_cart);
   
     // Calculate total price
     $total_price = 0;
     while ($row = $result_cart->fetch_assoc()) {
       $total_price += $row["product_price"] * $row["quantity"];
     }
   
     // Insert order into the orders table
     $user_id = $_SESSION['userid']; // Assuming user ID is stored in the session
     $payment_method = "Credit Card"; // You can modify this based on the payment method
   
     $sql_order = "INSERT INTO orders (user_id, total_price, shipping_address, city, state, zip_code, payment_method) 
                     VALUES (?, ?, ?, ?, ?, ?, ?)";
     $stmt_order = $mysqli->prepare($sql_order);
     $stmt_order->bind_param("idsssss", $user_id, $total_price, $shipping_address, $city, $state, $zip_code, $payment_method);
     $stmt_order->execute();
   
     // Get the last inserted order ID
     $order_id = $stmt_order->insert_id;
   
     // Insert cart items into the order_items table
     $result_cart = $mysqli->query($sql_cart); // Re-fetch cart items
     while ($row = $result_cart->fetch_assoc()) {
       $product_id = $row["product_id"];
       $product_title = $row["product_title"];
       $product_price = $row["product_price"];
       $quantity = $row["quantity"];
   
       $sql_order_item = "INSERT INTO order_items (order_id, product_id, product_title, product_price, quantity) 
                              VALUES (?, ?, ?, ?, ?)";
       $stmt_order_item = $mysqli->prepare($sql_order_item);
       $stmt_order_item->bind_param("iisdi", $order_id, $product_id, $product_title, $product_price, $quantity);
       $stmt_order_item->execute();
     }
   
     // Clear the cart after the order is placed
     $sql_clear_cart = "DELETE FROM cart";
     $mysqli->query($sql_clear_cart);
   
     // Redirect to a success page
     header("Location: ../orders.php?message=orderPlacedSucess");
     exit;

  

} else {
    header("Location:../cart.php?error=unauthorizesAcess");
}
