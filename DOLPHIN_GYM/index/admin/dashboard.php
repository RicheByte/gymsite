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

// Fetch user count from the database
$user_query = "SELECT COUNT(*) as user_count FROM users";
$user_result = mysqli_query($mysqli, $user_query);
$user_count = mysqli_fetch_assoc($user_result)['user_count'];

// Fetch latest users (limit 5 for recent registrations)
$users_query = "SELECT first_name, last_name, email, username FROM users;";
$users_result = mysqli_query($mysqli, $users_query);
?>

<!-- Custom CSS for modern styling -->
<style>
    .stat-box {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .stat-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .stat-box h4 {
        color: #007bff;
        /* Bootstrap primary color */
    }

    .stat-box p {
        font-size: 24px;
        font-weight: bold;
        color: #28a745;
        /* Bootstrap success color */
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

<!-- Admin Dashboard Section -->
<div class="container mt-5">
    <h3 class="text-center mb-4" style="color: #007bff; font-weight: bold;">Welcome, <?php echo $_SESSION["admin_username"]; ?></h3>

    <!-- Stats Container -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="stat-box">
                <h4>Total Users</h4>
                <p><?php echo $user_count; ?></p>
            </div>
        </div>
        <!-- Add more stat boxes here if needed -->
    </div>

    <!-- Recent User Registrations Table -->
    <h4 class="text-center mb-4" style="color: #28a745;">Recent User Registrations</h4>
    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Username</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($user = mysqli_fetch_assoc($users_result)) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['first_name']); ?></td>
                            <td><?php echo htmlspecialchars($user['last_name']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
// Include admin footer
include_once 'components/admin_footer.php';
?>