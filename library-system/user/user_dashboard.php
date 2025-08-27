
<?php
session_start();
include '../db.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header('Location: ../login.php');
}

$user_id = $_SESSION['user_id'];
$search = isset($_GET['search']) ? $_GET['search'] : '';
$filter_available = isset($_GET['available']) ? 'AND quantity > 0' : '';

$books_sql = "SELECT * FROM books WHERE (title LIKE '%$search%' OR author LIKE '%$search%' OR genre LIKE '%$search%') $filter_available";
$books = $conn->query($books_sql);

// Current issued books
$issued_sql = "SELECT b.*, 
               (SELECT COUNT(*) FROM transactions WHERE book_id = b.id AND user_id = $user_id AND action='issue') - 
               (SELECT COUNT(*) FROM transactions WHERE book_id = b.id AND user_id = $user_id AND action='return') as borrowed_count
               FROM books b HAVING borrowed_count > 0";
$issued_books = $conn->query($issued_sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>User Dashboard</h1>
        <a href="../logout.php" class="btn btn-danger mb-3"><i class="fas fa-sign-out-alt"></i> Logout</a>
        
        <h3>Available Books</h3>
        <form method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" value="<?php echo $search; ?>" placeholder="Search by title, author, genre" class="form-control">
                <div class="form-check ms-2">
                    <input type="checkbox" name="available" <?php if(isset($_GET['available'])) echo 'checked'; ?> class="form-check-input">
                    <label>Available only</label>
                </div>
                <button type="submit" class="btn btn-primary ms-2">Search</button>
            </div>
        </form>
        <table class="table table-striped">
            <thead><tr><th>Title</th><th>Author</th><th>Genre</th><th>Quantity</th><th>Action</th></tr></thead>
            <tbody>
                <?php while ($book = $books->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $book['title']; ?></td>
                        <td><?php echo $book['author']; ?></td>
                        <td><?php echo $book['genre']; ?></td>
                        <td><?php echo $book['quantity']; ?></td>
                        <td>
                            <?php if ($book['quantity'] > 0) { ?>
                                <a href="issue_book.php?book_id=<?php echo $book['id']; ?>" class="btn btn-sm btn-success">Issue</a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        
        <h3>My Issued Books</h3>
        <table class="table table-striped">
            <thead><tr><th>Title</th><th>Author</th><th>Genre</th><th>Borrowed</th><th>Action</th></tr></thead>
            <tbody>
                <?php while ($issued = $issued_books->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $issued['title']; ?></td>
                        <td><?php echo $issued['author']; ?></td>
                        <td><?php echo $issued['genre']; ?></td>
                        <td><?php echo $issued['borrowed_count']; ?></td>
                        <td><a href="return_book.php?book_id=<?php echo $issued['id']; ?>" class="btn btn-sm btn-warning">Return</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
