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

    .btn-success {
        background-color: #28a745;
        /* Bootstrap success color */
        border: none;
        transition: background-color 0.3s ease;
    }

    .btn-success:hover {
        background-color: #218838;
        /* Darker shade for hover effect */
    }

    textarea.form-control {
        resize: none;
        /* Disable resizing of textarea */
    }
</style>

<!-- User Messages Section -->
<div class="container mt-5">
    <h2 class="text-center mb-4" style="color: #007bff; font-weight: bold;">User Messages</h2>
    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Reply</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch all user messages from the database
                    $query = "SELECT user_messages.id, users.username, users.email, user_messages.submitted_at, 
                           user_messages.message, user_messages.admin_reply
                    FROM user_messages
                    JOIN users ON user_messages.user_id = users.id 
                    ORDER BY user_messages.id DESC";
                    $result = $mysqli->query($query);

                    // Loop through the messages and display them
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $row['submitted_at']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['message']; ?></td>
                            <td>
                                <?php if ($row['admin_reply']) { ?>
                                    <!-- Display admin reply if it exists -->
                                    <p class="text-success"><?php echo $row['admin_reply']; ?></p>
                                <?php } else { ?>
                                    <!-- Form to send a reply -->
                                    <form action="include/admin_reply_handler.inc.php" method="POST">
                                        <input type="hidden" name="message_id" value="<?php echo $row['id']; ?>">
                                        <textarea name="admin_reply" class="form-control" rows="3" required></textarea>
                                        <button type="submit" class="btn btn-success mt-2">Send Reply</button>
                                    </form>
                                <?php } ?>
                            </td>
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