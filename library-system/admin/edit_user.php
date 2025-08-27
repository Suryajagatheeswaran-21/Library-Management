
<?php
session_start();
include '../db.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: ../login.php');
}

$id = $_GET['id'];
$user = $conn->query("SELECT * FROM users WHERE id=$id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $role = $_POST['role'];

    $sql = "UPDATE users SET role='$role' WHERE id=$id";
    if ($conn->query($sql)) {
        header('Location: manage_users.php');
    } else {
        $error = "Error updating user";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit User</h2>
        <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
        <form method="POST">
            <div class="mb-3"><label>Name</label><input type="text" value="<?php echo $user['name']; ?>" class="form-control" disabled></div>
            <div class="mb-3"><label>Email</label><input type="text" value="<?php echo $user['email']; ?>" class="form-control" disabled></div>
            <div class="mb-3"><label>Role</label><select name="role" class="form-control"><option value="user" <?php if($user['role']=='user') echo 'selected'; ?>>User</option><option value="admin" <?php if($user['role']=='admin') echo 'selected'; ?>>Admin</option></select></div>
            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
    </div>
</body>
</html><?php
// Edit user role
?>
