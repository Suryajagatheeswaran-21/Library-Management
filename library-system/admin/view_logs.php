
<?php
session_start();
include '../db.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: ../login.php');
}

$logs = $conn->query("SELECT t.*, u.name as user_name, b.title as book_title FROM transactions t JOIN users u ON t.user_id=u.id JOIN books b ON t.book_id=b.id ORDER BY t.timestamp DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Logs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Transaction Logs</h2>
        <table class="table table-striped">
            <thead><tr><th>ID</th><th>User</th><th>Book</th><th>Action</th><th>Timestamp</th></tr></thead>
            <tbody>
                <?php while ($log = $logs->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $log['id']; ?></td>
                        <td><?php echo $log['user_name']; ?></td>
                        <td><?php echo $log['book_title']; ?></td>
                        <td><?php echo $log['action']; ?></td>
                        <td><?php echo $log['timestamp']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html><?php
// View transaction logs
?>
