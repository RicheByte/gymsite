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

// Fetch orders for the logged-in user
$user_id = $_SESSION['userid']; // Assuming user ID is stored in the session
$sql_orders = "SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC";
$stmt_orders = $mysqli->prepare($sql_orders);
$stmt_orders->bind_param("i", $user_id);
$stmt_orders->execute();
$result_orders = $stmt_orders->get_result();
?>

<!-- Custom CSS for modern styling -->
<style>
  .table {
    border-collapse: separate;
    border-spacing: 0 10px;
    width: 100%;
  }

  .table thead th {
    background-color: #007bff;
    color: white;
  }

  .table tbody tr {
    background-color: #f8f9fa;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .table tbody tr:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  .badge {
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 14px;
  }

  .badge-pending {
    background-color: #ffc107;
    color: #000;
  }

  .badge-shipped {
    background-color: #17a2b8;
    color: #fff;
  }

  .badge-delivered {
    background-color: #28a745;
    color: #fff;
  }
</style>

<!-- User Orders Section -->
<div class="container mt-5">
  <h2 class="text-center mb-4" style="color: #007bff; font-weight: bold;">Your Orders</h2>
  <table class="table table-bordered shadow">
    <thead>
      <tr>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Order ID</th>
        <th>Total Price</th>
        <th>Status</th>
        <th>Tracking Details</th>
        <th>Order Date</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($result_orders->num_rows > 0) {
          while ($row = $result_orders->fetch_assoc()) {
              $status_class = '';
              if ($row['status'] === 'Pending') {
                  $status_class = 'badge-pending';
              } elseif ($row['status'] === 'Shipped') {
                  $status_class = 'badge-shipped';
              } elseif ($row['status'] === 'Delivered') {
                  $status_class = 'badge-delivered';
              }

              // Fetch order items for this order
              $order_id = $row['id'];
              $sql_items = "SELECT * FROM order_items WHERE order_id = ?";
              $stmt_items = $mysqli->prepare($sql_items);
              $stmt_items->bind_param("i", $order_id);
              $stmt_items->execute();
              $result_items = $stmt_items->get_result();

              // Display order items
              if ($result_items->num_rows > 0) {
                  while ($item = $result_items->fetch_assoc()) {
                      echo '
                      <tr>
                          <td>' . htmlspecialchars($item['product_title']) . '</td>
                          <td>' . $item['quantity'] . '</td>
                          <td>' . $row['id'] . '</td>
                          <td>Rs:' . number_format($row['total_price'], 2) . '</td>
                          <td><span class="badge ' . $status_class . '">' . $row['status'] . '</span></td>
                          <td>' . ($row['tracking_details'] ? $row['tracking_details'] : 'No tracking details available') . '</td>
                          <td>' . $row['created_at'] . '</td>
                      </tr>';
                  }
              } else {
                  // If no items are found, display a single row with order details
                  echo '
                  <tr>
                      <td colspan="7" class="text-center">No items found for this order.</td>
                  </tr>';
              }
          }
      } else {
          echo '<tr><td colspan="7" class="text-center">No orders found.</td></tr>';
      }
      ?>
    </tbody>
  </table>
</div>

<?php
// Include dashboard footer
include_once "../component/dashboard_footer.php";
?>