
<?php
session_start();
include '../db.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header('Location: ../login.php');
}

$book_id = $_GET['book_id'];
$user_id = $_SESSION['user_id'];

$book = $conn->query("SELECT * FROM books WHERE id=$book_id")->fetch_assoc();
if ($book['quantity'] > 0) {
    $conn->query("INSERT INTO transactions (user_id, book_id, action) VALUES ($user_id, $book_id, 'issue')");
    $conn->query("UPDATE books SET quantity = quantity - 1 WHERE id=$book_id");
}
header('Location: user_dashboard.php');
?><?php
// Issue book functionality
?>
