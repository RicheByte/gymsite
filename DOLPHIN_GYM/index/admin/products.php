<?php
// Start the session to check if the admin is logged in
session_start();

// Redirect to the login page if the admin is not logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php?message=admin_dashboard_not_login');
    exit;
}

// Include the admin header and database connection
include_once 'components/admin_header.php';
require_once 'include/db.php';
?>

<!-- Custom CSS for modern styling -->
<style>
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
        transition: background-color 0.3s ease;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .btn-success {
        background-color: #28a745;
        border: none;
        transition: background-color 0.3s ease;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .product-card img {
        height: 200px;
        object-fit: cover;
    }
</style>

<!-- Admin Product Management Section -->
<div class="container mt-5">
    <h2 class="text-center mb-4" style="color: #007bff; font-weight: bold;">Manage Products</h2>

    <!-- Add New Product Form -->
    <div class="card shadow mb-5">
        <div class="card-body">
            <h3 class="card-title" style="color: #28a745;">Add New Product</h3>
            <form action="include/add_product.inc.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <input type="text" name="product_name" class="form-control" placeholder="Product Name" required>
                </div>
                <div class="mb-3">
                    <input type="number" name="product_price" class="form-control" placeholder="Price" required>
                </div>
                <div class="mb-3">
                    <input type="number" name="quantity" class="form-control" placeholder="Quantity" required>
                </div>
                <div class="mb-3">
                    <select name="category" class="form-control" required>
                        <option value="Treadmills">Treadmills</option>
                        <option value="CrossTrainers">Cross Trainers</option>
                        <option value="ExerciseBikes">Exercise Bikes</option>
                        <option value="Benches">Benches</option>
                        <option value="HomeGym">Home Gym</option>
                    </select>
                </div>
                <div class="mb-3">
                    <input type="file" name="product_image" class="form-control" required>
                </div>
                <div class="mb-3">
                    <textarea name="product_desc" class="form-control" placeholder="Product Description" required></textarea>
                </div>
                <button type="submit" class="btn btn-success w-100">Add Product</button>
            </form>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="row mb-4">
        <div class="col-md-8">
            <input type="text" id="search" class="form-control" placeholder="Search Products">
        </div>
        <div class="col-md-4">
            <select id="categoryFilter" class="form-control">
                <option value="">All Categories</option>
                <option value="Treadmills">Treadmills</option>
                <option value="CrossTrainers">Cross Trainers</option>
                <option value="ExerciseBikes">Exercise Bikes</option>
                <option value="Benches">Benches</option>
                <option value="HomeGym">Home Gym</option>
            </select>
        </div>
    </div>

    <!-- Display All Products -->
    <div class="row" id="product-list">
        <?php
        // Fetch all products from the database
        $sql = "SELECT * FROM products";
        $stmt = $mysqli->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $imageData = base64_encode($row["img"]);
                $imageSrc = 'data:image/jpeg;base64,' . $imageData;

                echo '
            <div class="col-md-4 mb-4">
                <div class="card product-card shadow">
                    <img src="' . htmlspecialchars($imageSrc) . '" class="card-img-top" alt="Product Image">
                    <div class="card-body">
                        <h4 class="card-title">' . htmlspecialchars($row['title']) . '</h4>
                        <p class="card-text">Price: Rs:' . htmlspecialchars($row['price']) . '</p>
                        <p class="card-text">' . htmlspecialchars($row['description']) . '</p>
                        <button onclick="openEditModal(
                            ' . htmlspecialchars($row['id']) . ',
                            \'' . htmlspecialchars($row['title']) . '\',
                            ' . htmlspecialchars($row['price']) . ',
                            ' . htmlspecialchars($row['quantity']) . ',
                            \'' . htmlspecialchars($row['category']) . '\',
                            \'' . htmlspecialchars($row['description']) . '\'
                        )" class="btn btn-primary">Edit</button>
                        <button onclick="deleteProduct(' . htmlspecialchars($row['id']) . ')" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>';
            }
        } else {
            echo '<p class="text-center">No products found.</p>';
        }
        ?>
    </div>
</div>

<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editProductForm" action="include/update_product.inc.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="product_id" id="editProductId">
                    <div class="mb-3">
                        <input type="text" name="product_name" id="editProductName" class="form-control" placeholder="Product Name" required>
                    </div>
                    <div class="mb-3">
                        <input type="number" name="product_price" id="editProductPrice" class="form-control" placeholder="Price" required>
                    </div>
                    <div class="mb-3">
                        <input type="number" name="quantity" id="editProductQuantity" class="form-control" placeholder="Quantity" required>
                    </div>
                    <div class="mb-3">
                        <select name="category" id="editProductCategory" class="form-control" required>
                            <option value="Treadmills">Treadmills</option>
                            <option value="CrossTrainers">Cross Trainers</option>
                            <option value="ExerciseBikes">Exercise Bikes</option>
                            <option value="Benches">Benches</option>
                            <option value="HomeGym">Home Gym</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="file" name="product_image" class="form-control">
                    </div>
                    <div class="mb-3">
                        <textarea name="product_desc" id="editProductDesc" class="form-control" placeholder="Product Description" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Update Product</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Search, Edit, and Delete -->
<script>
    // Search Functionality
    document.getElementById("search").addEventListener("input", function() {
        let filter = this.value.toLowerCase();
        let products = document.querySelectorAll(".product-card");
        products.forEach(product => {
            let name = product.querySelector("h4").innerText.toLowerCase();
            product.style.display = name.includes(filter) ? "block" : "none";
        });
    });

    // Function to open the edit modal and pre-fill the form
    function openEditModal(id, name, price, quantity, category, description) {
        document.getElementById('editProductId').value = id;
        document.getElementById('editProductName').value = name;
        document.getElementById('editProductPrice').value = price;
        document.getElementById('editProductQuantity').value = quantity;
        document.getElementById('editProductCategory').value = category;
        document.getElementById('editProductDesc').value = description;

        // Show the modal
        var editModal = new bootstrap.Modal(document.getElementById('editProductModal'), {
            keyboard: false
        });
        editModal.show();
    }

    // Delete Product Function
    function deleteProduct(id) {
        if (confirm("Are you sure you want to delete this product?")) {
            window.location.href = "include/delete_product.inc.php?id=" + id;
        }
    }
</script>

<?php
// Include admin footer
include_once 'components/admin_footer.php';
?>