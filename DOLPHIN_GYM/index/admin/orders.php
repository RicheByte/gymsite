<?php
// Start the session to check if the user is an admin
session_start();

// Redirect to the login page if the user is not logged in or not an admin
if (!isset($_SESSION['admin_logged_in'])) {
  header('Location: login.php?message=admin_dashboard_not_login');
  exit;
}

// Include the database connection and store header
include_once 'include/db.php';
include_once 'components/admin_header.php';

// Handle tracking details update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_tracking'])) {
  $order_id = intval($_POST['order_id']);
  $tracking_details = $_POST['tracking_details'];
  $status = $_POST['status'];

  $sql_update = "UPDATE orders SET tracking_details = ?, status = ? WHERE id = ?";
  $stmt_update = $mysqli->prepare($sql_update);
  $stmt_update->bind_param("ssi", $tracking_details, $status, $order_id);
  $stmt_update->execute();
}

// Fetch all orders with user, item, and address details
$sql_orders = "
    SELECT 
        orders.id AS order_id,
        orders.user_id,
        orders.total_price,
        orders.status,
        orders.tracking_details,
        orders.created_at,
        orders.shipping_address,
        orders.city,
        orders.state,
        orders.zip_code,
        users.username AS user_name,
        order_items.product_title AS item_name,
        order_items.quantity
    FROM orders
    INNER JOIN users ON orders.user_id = users.id
    INNER JOIN order_items ON orders.id = order_items.order_id
    ORDER BY orders.created_at DESC
";
$result_orders = $mysqli->query($sql_orders);
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

  .form-control {
    border-radius: 5px;
  }

  .btn-primary {
    background-color: #007bff;
    border: none;
    transition: background-color 0.3s ease;
  }

  .btn-primary:hover {
    background-color: #0056b3;
  }
</style>

<!-- Admin Orders Section -->
<div class="container mt-5">
  <h2 class="text-center mb-4" style="color: #007bff; font-weight: bold;">All Orders</h2>
  <table class="table table-bordered shadow">
    <thead>
      <tr>
        <th>Order ID</th>
        <th>User Name</th>
        <th>Item Name</th>
        <th>Quantity</th>
        <th>Total Price</th>
        <th>Status</th>
        <th>Tracking Details</th>
        <th>Order Date</th>
        <th>Shipping Address</th>
        <th>Action</th>
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

          // Format the shipping address
          $shipping_address = htmlspecialchars($row['shipping_address']) . ', ' .
            htmlspecialchars($row['city']) . ', ' .
            htmlspecialchars($row['state']) . ', ' .
            htmlspecialchars($row['zip_code']);

          echo '
              <tr>
                  <td>' . $row['order_id'] . '</td>
                  <td>' . htmlspecialchars($row['user_name']) . '</td>
                  <td>' . htmlspecialchars($row['item_name']) . '</td>
                  <td>' . $row['quantity'] . '</td>
                  <td>Rs:' . number_format($row['total_price'], 2) . '</td>
                  <td><span class="badge ' . $status_class . '">' . $row['status'] . '</span></td>
                  <td>' . ($row['tracking_details'] ? $row['tracking_details'] : 'No tracking details available') . '</td>
                  <td>' . $row['created_at'] . '</td>
                  <td>' . $shipping_address . '</td>
                  <td>
                      <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal' . $row['order_id'] . '">
                          Update Tracking
                      </button>
                  </td>
              </tr>

              <!-- Update Tracking Modal -->
              <div class="modal fade" id="updateModal' . $row['order_id'] . '" tabindex="-1" aria-labelledby="updateModalLabel' . $row['order_id'] . '" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="updateModalLabel' . $row['order_id'] . '">Update Tracking Details</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                              <form method="POST" action="orders.php">
                                  <input type="hidden" name="order_id" value="' . $row['order_id'] . '">
                                  <div class="mb-3">
                                      <label for="status' . $row['order_id'] . '" class="form-label">Status</label>
                                      <select class="form-control" id="status' . $row['order_id'] . '" name="status" required>
                                          <option value="Pending" ' . ($row['status'] === 'Pending' ? 'selected' : '') . '>Pending</option>
                                          <option value="Shipped" ' . ($row['status'] === 'Shipped' ? 'selected' : '') . '>Shipped</option>
                                          <option value="Delivered" ' . ($row['status'] === 'Delivered' ? 'selected' : '') . '>Delivered</option>
                                      </select>
                                  </div>
                                  <div class="mb-3">
                                      <label for="tracking_details' . $row['order_id'] . '" class="form-label">Tracking Details</label>
                                      <textarea class="form-control" id="tracking_details' . $row['order_id'] . '" name="tracking_details" rows="3">' . $row['tracking_details'] . '</textarea>
                                  </div>
                                  <button type="submit" name="update_tracking" class="btn btn-primary">Save Changes</button>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>';
        }
      } else {
        echo '<tr><td colspan="10" class="text-center">No orders found.</td></tr>';
      }
      ?>
    </tbody>
  </table>
</div>

<?php
// Include dashboard footer
include_once "components/admin_footer.php";
?>