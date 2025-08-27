
<?php
session_start();
include '../db.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: ../login.php');
}

$id = $_GET['id'];
$conn->query("DELETE FROM users WHERE id=$id");
header('Location: manage_users.php');
?><?php
// Delete user
?>
