
<?php
session_start();
include '../db.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: ../login.php');
}

$total_books = $conn->query("SELECT COUNT(*) as count FROM books")->fetch_assoc()['count'];
$total_users = $conn->query("SELECT COUNT(*) as count FROM users WHERE role='user'")->fetch_assoc()['count'];
$books_issued = $conn->query("SELECT COUNT(*) as count FROM transactions WHERE action='issue'")->fetch_assoc()['count'];
$books_returned = $conn->query("SELECT COUNT(*) as count FROM transactions WHERE action='return'")->fetch_assoc()['count'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Admin Dashboard</h1>
        <div class="row">
            <div class="col-md-3"><div class="card"><div class="card-body"><h5>Total Books</h5><p><?php echo $total_books; ?></p></div></div></div>
            <div class="col-md-3"><div class="card"><div class="card-body"><h5>Total Users</h5><p><?php echo $total_users; ?></p></div></div></div>
            <div class="col-md-3"><div class="card"><div class="card-body"><h5>Books Issued</h5><p><?php echo $books_issued; ?></p></div></div></div>
            <div class="col-md-3"><div class="card"><div class="card-body"><h5>Books Returned</h5><p><?php echo $books_returned; ?></p></div></div></div>
        </div>
        <div class="mt-4">
            <a href="add_book.php" class="btn btn-primary"><i class="fas fa-plus"></i> Add Book</a>
            <a href="manage_books.php" class="btn btn-secondary"><i class="fas fa-book"></i> Manage Books</a>
            <a href="manage_users.php" class="btn btn-secondary"><i class="fas fa-users"></i> Manage Users</a>
            <a href="view_logs.php" class="btn btn-secondary"><i class="fas fa-history"></i> View Logs</a>
            <a href="../logout.php" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>
</body>
</html><?php
// Admin dashboard
?>
