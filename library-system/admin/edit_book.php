
<?php
session_start();
include '../db.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: ../login.php');
}

$id = $_GET['id'];
$book = $conn->query("SELECT * FROM books WHERE id=$id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $isbn = $_POST['isbn'];
    $quantity = $_POST['quantity'];

    $sql = "UPDATE books SET title='$title', author='$author', genre='$genre', isbn='$isbn', quantity=$quantity WHERE id=$id";
    if ($conn->query($sql)) {
        header('Location: manage_books.php');
    } else {
        $error = "Error updating book";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Book</h2>
        <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
        <form method="POST">
            <div class="mb-3"><label>Title</label><input type="text" name="title" value="<?php echo $book['title']; ?>" class="form-control" required></div>
            <div class="mb-3"><label>Author</label><input type="text" name="author" value="<?php echo $book['author']; ?>" class="form-control" required></div>
            <div class="mb-3"><label>Genre</label><input type="text" name="genre" value="<?php echo $book['genre']; ?>" class="form-control" required></div>
            <div class="mb-3"><label>ISBN</label><input type="text" name="isbn" value="<?php echo $book['isbn']; ?>" class="form-control" required></div>
            <div class="mb-3"><label>Quantity</label><input type="number" name="quantity" value="<?php echo $book['quantity']; ?>" class="form-control" required></div>
            <button type="submit" class="btn btn-primary">Update Book</button>
        </form>
    </div>
</body>
</html><?php
// Edit book details
?>
