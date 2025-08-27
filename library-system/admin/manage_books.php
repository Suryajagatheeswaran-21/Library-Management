
<?php
session_start();
include '../db.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: ../login.php');
}

$books = $conn->query("SELECT * FROM books");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Manage Books</h2>
        <a href="add_book.php" class="btn btn-primary mb-3">Add Book</a>
        <table class="table table-striped">
            <thead><tr><th>ID</th><th>Title</th><th>Author</th><th>Genre</th><th>ISBN</th><th>Quantity</th><th>Actions</th></tr></thead>
            <tbody>
                <?php while ($book = $books->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $book['id']; ?></td>
                        <td><?php echo $book['title']; ?></td>
                        <td><?php echo $book['author']; ?></td>
                        <td><?php echo $book['genre']; ?></td>
                        <td><?php echo $book['isbn']; ?></td>
                        <td><?php echo $book['quantity']; ?></td>
                        <td>
                            <a href="edit_book.php?id=<?php echo $book['id']; ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                            <a href="delete_book.php?id=<?php echo $book['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html><?php
// Manage books (CRUD)
?>
