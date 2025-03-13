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
  .card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: none; /* Remove default border */
  }
  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
  }
  .search-bar {
    max-width: 500px;
    margin: 20px auto;
  }
  .carousel-item img {
    height: 400px;
    object-fit: cover;
  }
  .card-img-top {
    height: 250px;
    object-fit: cover;
  }
  .btn-primary {
    background-color: #007bff; /* Bootstrap primary color */
    border: none;
  }
  .btn-primary:hover {
    background-color: #0056b3; /* Darker shade for hover effect */
  }
</style>

<!-- Banner Section -->
<div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <!-- First Carousel Item -->
    <div class="carousel-item active">
      <img src="https://img.freepik.com/free-vector/flat-design-personal-trainer-facebook-cover_23-2149431903.jpg?semt=ais_hybrid" class="d-block w-100" alt="Special Offers">
    </div>
    <!-- Second Carousel Item -->
    <div class="carousel-item">
      <img src="https://img.freepik.com/free-vector/gradient-neon-gym-training-sale-banner_23-2149609481.jpg?semt=ais_hybrid" class="d-block w-100" alt="New Arrivals">
    </div>
  </div>
  <!-- Carousel Controls -->
  <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>

<!-- Search Bar -->
<div class="container mt-4">
  <form method="GET" action="" class="search-bar">
    <div class="input-group mb-3">
      <input type="text" class="form-control" name="search" placeholder="Search products by title or category..." aria-label="Search">
      <button class="btn btn-primary" type="submit">Search</button>
    </div>
  </form>
</div>

<!-- Product Grid -->
<div class="container mt-5">
  <h1 class="text-center mb-4" style="font-weight: bold; font-style: italic; color: #007bff;">Fitness Products</h1>
  <div class="row">

    <?php
    // Fetch products from the database based on search term
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $sql = "SELECT * FROM products WHERE title LIKE ? OR category LIKE ?";
    $searchTerm = "%$search%";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if there are products
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        // Convert BLOB data to base64 string for image display
        $imageData = base64_encode($row["img"]);
        $imageSrc = 'data:image/jpeg;base64,' . $imageData;

        // Display product card
        echo '
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow">
                <img src="' . $imageSrc . '" class=" img-fluid" alt="' . htmlspecialchars($row["title"]) . '">
                <div class="card-body text-center">
                    <h5 class="card-title">' . htmlspecialchars($row["title"]) . '</h5>
                    <p class="card-text"><strong>Category:</strong> ' . htmlspecialchars($row["category"]) . '</p>
                    <p class="card-text"><strong>Price:</strong> Rs:' . htmlspecialchars($row["price"]) . '</p>
                    <form method="post" action="cart.php">
                        <input type="hidden" name="product_id" value="' . htmlspecialchars($row["id"]) . '">
                        <input type="hidden" name="product_title" value="' . htmlspecialchars($row["title"]) . '">
                        <input type="hidden" name="product_price" value="' . htmlspecialchars($row["price"]) . '">
                        <input type="hidden" name="product_category" value="' . htmlspecialchars($row["category"]) . '">
                        <button type="submit" name="add_to_cart" class="btn btn-primary">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>';
      }
    } else {
      // Display message if no products are found
      echo '<p class="text-center">No products found.</p>';
    }
    ?>

  </div>
</div>

<!-- Bootstrap JS and Custom JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>

<?php
// Include dashboard footer
include_once "../component/dashboard_footer.php";
?>