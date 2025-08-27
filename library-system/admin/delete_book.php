
<?php
session_start();
include '../db.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: ../login.php');
}

$id = $_GET['id'];
$conn->query("DELETE FROM books WHERE id=$id");
header('Location: manage_books.php');
?><?php
// Delete book
?>
