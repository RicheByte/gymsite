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


?>

<!-- Custom CSS for modern styling -->
<style>
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

  .btn-success {
    background-color: #28a745;
    border: none;
    transition: background-color 0.3s ease;
  }

  .btn-success:hover {
    background-color: #218838;
  }

  .card {
    border: none;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  }
</style>

<!-- Checkout Section -->
<div class="container mt-5">
  <h1 class="text-center mb-4" style="color: #007bff; font-weight: bold;">Checkout</h1>
  <div class="row">
    <!-- Shipping Address Section -->
    <div class="col-md-6 mb-4">
      <div class="card h-100 shadow">
        <div class="card-body">
          <h3 class="card-title" style="color: #007bff;">Shipping Address</h3>
          <form id="address-form" method="POST" action="include/order_placed.inc.php">
            <div class="mb-3">
              <label for="address" class="form-label">Address</label>
              <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="mb-3">
              <label for="city" class="form-label">City</label>
              <input type="text" class="form-control" id="city" name="city" required>
            </div>
            <div class="mb-3">
              <label for="province" class="form-label">Province</label>
              <select class="form-control" id="province" name="state" required>
                <option value="">Select a Province</option>
                <option value="Central">Central Province</option>
                <option value="Eastern">Eastern Province</option>
                <option value="North Central">North Central Province</option>
                <option value="Northern">Northern Province</option>
                <option value="North Western">North Western Province</option>
                <option value="Sabaragamuwa">Sabaragamuwa Province</option>
                <option value="Southern">Southern Province</option>
                <option value="Uva">Uva Province</option>
                <option value="Western">Western Province</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="zip_code" class="form-label">Zip Code</label>
              <input type="text" class="form-control" id="zip_code" name="zip_code" required>
            </div>
        </div>
      </div>
    </div>

    <!-- Payment Details Section -->
    <div class="col-md-6 mb-4">
      <div class="card h-100 shadow">
        <div class="card-body">
          <h3 class="card-title" style="color: #28a745;">Payment Details</h3>
          <form id="payment-form" method="POST" action="include/order_placed.inc.php">
            <div class="mb-3">
              <label for="card_number" class="form-label">Card Number</label>
              <input type="text" class="form-control" id="card_number" name="card_number" required>
            </div>
            <div class="mb-3">
              <label for="expiry_date" class="form-label">Expiry Date</label>
              <input type="text" class="form-control" id="expiry_date" name="expiry_date" required>
            </div>
            <div class="mb-3">
              <label for="cvv" class="form-label">CVV</label>
              <input type="text" class="form-control" id="cvv" name="cvv" required>
            </div>
            <button type="submit" name="confirm_order" class="btn btn-success w-100">Confirm Order</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
// Include dashboard footer
include_once "../component/dashboard_footer.php";
?>