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
include_once 'include/db.php';

// Handle message submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['publish_message'])) {
    $message = trim($_POST['message']);
    $adminId = $_SESSION['admin_userid'];

    // Check if the message is not empty
    if (!empty($message)) {
        // Insert the message into the database
        $stmt = $mysqli->prepare("INSERT INTO admin_messages (admin_id, message, sent_at) VALUES (?, ?, NOW())");
        $stmt->bind_param("is", $adminId, $message);
        $stmt->execute();
        $stmt->close();
    }
}

// Handle message deletion
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);

    // Delete the message from the database
    $stmt = $mysqli->prepare("DELETE FROM admin_messages WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Fetch all messages from the database
$result = $mysqli->query("SELECT * FROM admin_messages;");
?>

<!-- Custom CSS for modern styling -->
<style>
    .form-control {
        border-radius: 5px;
        /* Rounded corners for input fields */
    }

    .btn-primary {
        background-color: #007bff;
        /* Bootstrap primary color */
        border: none;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        /* Darker shade for hover effect */
    }

    .btn-danger {
        background-color: #dc3545;
        /* Bootstrap danger color */
        border: none;
        transition: background-color 0.3s ease;
    }

    .btn-danger:hover {
        background-color: #c82333;
        /* Darker shade for hover effect */
    }

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
</style>

<!-- Admin Dashboard - Publish Messages Section -->
<div class="container mt-4">
    <h2 class="text-center mb-4" style="color: #007bff; font-weight: bold;">Admin Dashboard - Publish Messages</h2>

    <!-- Message Submission Form -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="message" class="form-label">Enter Message:</label>
                    <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                </div>
                <button type="submit" name="publish_message" class="btn btn-primary">Publish</button>
            </form>
        </div>
    </div>

    <hr>

    <!-- Previous Messages Section -->
    <h3 class="text-center mb-4" style="color: #28a745;">Previous Messages</h3>
    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>

                        <th>Message</th>
                        <th>Published On</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>

                            <td><?php echo htmlspecialchars($row['message']); ?></td>
                            <td><?php echo $row['sent_at']; ?></td>
                            <td>
                                <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
// Include admin footer
include_once 'components/admin_footer.php';
?>