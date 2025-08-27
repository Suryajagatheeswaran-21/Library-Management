
<?php
session_start();
include '../db.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header('Location: ../login.php');
}

$book_id = $_GET['book_id'];
$user_id = $_SESSION['user_id'];

// Check if user has borrowed this book (borrowed_count > 0)
$borrowed_count = $conn->query("SELECT 
    (SELECT COUNT(*) FROM transactions WHERE book_id = $book_id AND user_id = $user_id AND action='issue') - 
    (SELECT COUNT(*) FROM transactions WHERE book_id = $book_id AND user_id = $user_id AND action='return') as count")->fetch_assoc()['count'];

if ($borrowed_count > 0) {
    $conn->query("INSERT INTO transactions (user_id, book_id, action) VALUES ($user_id, $book_id, 'return')");
    $conn->query("UPDATE books SET quantity = quantity + 1 WHERE id=$book_id");
}
header('Location: user_dashboard.php');
?><?php
// Return book functionality
?>
