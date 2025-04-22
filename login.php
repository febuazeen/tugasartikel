<?php
session_start(); // Memulai sesi
include 'db.php'; // Pastikan ini mengarah ke file db.php yang benar

// Cek apakah pengguna sudah login
if (isset($_SESSION['author_id'])) {
    header("Location: index.php"); // Jika sudah login, redirect ke halaman utama
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nickname = $_POST['nickname'];
    $password = $_POST['password'];

    // Query untuk memeriksa kredensial pengguna
    $query = "SELECT * FROM author WHERE nickname='$nickname' AND password='$password'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        $author = mysqli_fetch_assoc($result);
        $_SESSION['author_id'] = $author['id']; // Simpan ID author di sesi
        header("Location: index.php"); // Redirect ke halaman utama
        exit();
    } else {
        $error = "Nickname atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="create_article.php">Tambah Artikel</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </nav>
    <h1>Login</h1>
    <form action="login.php" method="POST">
        <label for="nickname">Nickname:</label>
        <input type="text" id="nickname" name="nickname" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <button type="submit">Login</button>
    </form>
</body>
</html>