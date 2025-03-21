<?php
// Start the session to check if the user is logged in
session_start();

// Redirect to the login page if the user is not logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  header("Location: login.php");
  exit;
}

// Include the database connection and store header
include_once '../include/db.php';
include_once 'store_header.php';

// Add item to the cart
if (isset($_POST["add_to_cart"])) {
  $product_id = intval($_POST["product_id"]);
  $product_title = $_POST["product_title"];
  $product_price = floatval($_POST["product_price"]);
  $user_id = $_SESSION['userid']; // Assuming you store the user ID in the session

  // Check if item already exists in the cart for this user
  $sql_check = "SELECT * FROM cart WHERE product_id = ? AND user_id = ?";
  $stmt_check = $mysqli->prepare($sql_check);
  $stmt_check->bind_param("ii", $product_id, $user_id);
  $stmt_check->execute();
  $result_check = $stmt_check->get_result();

  if ($result_check->num_rows > 0) {
    // If product exists, update quantity
    $sql_update = "UPDATE cart SET quantity = quantity + 1 WHERE product_id = ? AND user_id = ?";
    $stmt_update = $mysqli->prepare($sql_update);
    $stmt_update->bind_param("ii", $product_id, $user_id);
    $stmt_update->execute();
  } else {
    // Insert new product into the cart
    $sql_insert = "INSERT INTO cart (product_id, product_title, product_price, quantity, user_id) VALUES (?, ?, ?, 1, ?)";
    $stmt_insert = $mysqli->prepare($sql_insert);
    $stmt_insert->bind_param("isdi", $product_id, $product_title, $product_price, $user_id);
    $stmt_insert->execute();
  }
}

// Update cart quantity
if (isset($_POST['update_quantity'])) {
  $cart_id = intval($_POST['cart_id']);
  $new_quantity = intval($_POST['quantity']);
  $user_id = $_SESSION['userid']; // Assuming you store the user ID in the session

  if ($new_quantity > 0) {
    $sql_update_quantity = "UPDATE cart SET quantity = ? WHERE id = ? AND user_id = ?";
    $stmt_update_quantity = $mysqli->prepare($sql_update_quantity);
    $stmt_update_quantity->bind_param("iii", $new_quantity, $cart_id, $user_id);
    $stmt_update_quantity->execute();
  }
}

// Fetch all cart items for the logged-in user
$user_id = $_SESSION['userid']; // Assuming you store the user ID in the session
$sql_cart = "SELECT * FROM cart WHERE user_id = ?";
$stmt_cart = $mysqli->prepare($sql_cart);
$stmt_cart->bind_param("i", $user_id);
$stmt_cart->execute();
$result_cart = $stmt_cart->get_result();
?>

<!-- Custom CSS for modern styling -->
<style>
  .table {
    border-collapse: separate;
    border-spacing: 0 10px;
    /* Add spacing between rows */
  }

  .table thead th {
    background-color: #007bff;
    /* Bootstrap primary color */
    color: white;
  }

  .table tbody tr {
    background-color: #f8f9fa;
    /* Light gray background for rows */
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .table tbody tr:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  .btn-warning {
    background-color: #ffc107;
    /* Bootstrap warning color */
    border: none;
  }

  .btn-warning:hover {
    background-color: #e0a800;
    /* Darker shade for hover effect */
  }

  .btn-danger {
    background-color: #dc3545;
    /* Bootstrap danger color */
    border: none;
  }

  .btn-danger:hover {
    background-color: #c82333;
    /* Darker shade for hover effect */
  }

  .btn-success {
    background-color: #28a745;
    /* Bootstrap success color */
    border: none;
  }

  .btn-success:hover {
    background-color: #218838;
    /* Darker shade for hover effect */
  }
</style>

<!-- Shopping Cart Section -->
<div class="container mt-5">
  <h2 class="text-center mb-4" style="color: #007bff; font-weight: bold;">Shopping Cart</h2>
  <table class="table table-bordered shadow">
    <thead>
      <tr>
        <th>Product</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $total_price = 0;

      // Loop through cart items and display them
      while ($row = $result_cart->fetch_assoc()) {
        $total = $row["product_price"] * $row["quantity"];
        $total_price += $total;
        echo '
          <tr>
              <td>' . htmlspecialchars($row["product_title"]) . '</td>
              <td>Rs:' . number_format($row["product_price"], 2) . '</td>
              <td>
                  <form action="cart.php" method="POST">
                      <input type="hidden" name="cart_id" value="' . $row["id"] . '">
                      <input type="number" name="quantity" value="' . $row["quantity"] . '" min="1" class="form-control" style="width: 100px;">
                      <button type="submit" name="update_quantity" class="btn btn-warning btn-sm mt-1">Update</button>
                  </form>
              </td>
              <td>Rs:' . number_format($total, 2) . '</td>
              <td>
                  <a href="remove_cartItem.php?remove=' . $row["id"] . '" class="btn btn-danger btn-sm">Remove</a>
              </td>
          </tr>';
      }
      ?>
    </tbody>
  </table>
  <!-- Total Price and Checkout Button -->
  <h4 class="text-end mt-4" style="color: #28a745;">Total Price: Rs:<?= number_format($total_price, 2) ?></h4>
  <div class="text-end">
    <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
  </div>
</div>

<?php
// Include dashboard footer
include_once "../component/dashboard_footer.php";
?>