<?php
include 'db.php'; // Pastikan ini mengarah ke file db.php yang benar
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Artikel</title>
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
    <h1>Tambah Artikel</h1>
    <form action="store_article.php" method="POST" enctype="multipart/form-data">
        <label for="title">Judul Artikel:</label>
        <input type="text" id="title" name="title" placeholder="Masukkan judul artikel" required>

        <label for="author">Nama Author:</label>
        <select id="author" name="author_id" required>
            <option value="">Pilih Author</option>
            <?php
            $authors = mysqli_query($koneksi, "SELECT * FROM author");
            while ($author = mysqli_fetch_assoc($authors)) {
                echo '<option value="' . $author['id'] . '">' . $author['nickname'] . '</option>';
            }
            ?>
        </select>

        <label for="category">Kategori:</label>
        <select id="category" name="category_id" required>
            <option value="">Pilih Kategori</option>
            <?php
            $categories = mysqli_query($koneksi, "SELECT * FROM category");
            while ($category = mysqli_fetch_assoc($categories)) {
                echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
            }
            ?>
        </select>

        <label for="date">Tanggal Publikasi:</label>
        <input type="date" id="date" name="date" required>

        <label for="content">Isi Artikel:</label>
        <textarea id="content" name="content" rows="5" placeholder="Masukkan isi artikel" required></textarea>

        <label for="image">Gambar Artikel:</label>
        <input type="file" id="image" name="image" accept="image/*">

        <button type="submit">Simpan Artikel</button>
    </form>
</body>
</html>