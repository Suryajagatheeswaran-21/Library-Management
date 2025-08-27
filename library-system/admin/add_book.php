
<?php
session_start();
include '../db.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: ../login.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $isbn = $_POST['isbn'];
    $quantity = $_POST['quantity'];

    $sql = "INSERT INTO books (title, author, genre, isbn, quantity) VALUES ('$title', '$author', '$genre', '$isbn', $quantity)";
    if ($conn->query($sql)) {
        header('Location: manage_books.php');
    } else {
        $error = "Error adding book";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Add New Book</h2>
        <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
        <form method="POST">
            <div class="mb-3"><label>Title</label><input type="text" name="title" class="form-control" required></div>
            <div class="mb-3"><label>Author</label><input type="text" name="author" class="form-control" required></div>
            <div class="mb-3"><label>Genre</label><input type="text" name="genre" class="form-control" required></div>
            <div class="mb-3"><label>ISBN</label><input type="text" name="isbn" class="form-control" required></div>
            <div class="mb-3"><label>Quantity</label><input type="number" name="quantity" class="form-control" required></div>
            <button type="submit" class="btn btn-primary">Add Book</button>
        </form>
    </div>
</body>
</html><?php
// Add new book page
?>
