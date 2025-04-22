<?php
include 'db.php'; // Pastikan ini mengarah ke file db.php yang benar

if (isset($_GET['id'])) {
    $article_id = $_GET['id'];
    $query = "SELECT a.*, au.nickname FROM article a JOIN article_author aa ON a.id = aa.article_id JOIN author au ON aa.author_id = au.id WHERE a.id = '$article_id'";
    $result = mysqli_query($koneksi, $query);
    $article = mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Artikel</title>
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
    <h1>Edit Artikel</h1>
    <form action="update_article.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $article['id']; ?>">
        <label for="title">Judul Artikel:</label>
        <input type="text" id="title" name="title" value="<?php echo $article['title']; ?>" placeholder="Masukkan judul artikel" required>

        <label for="author">Nama Author:</label>
        <select id="author" name="author_id" required>
            <option value="">Pilih Author</option>
            <?php
            $authors = mysqli_query($koneksi, "SELECT * FROM author");
            while ($author = mysqli_fetch_assoc($authors)) {
                $selected = ($author['id'] == $article['author_id']) ? 'selected' : '';
                echo '<option value="' . $author['id'] . '" ' . $selected . '>' . $author['nickname'] . '</option>';
            }
            ?>
        </select>

        <label for="date">Tanggal Publikasi:</label>
        <input type="date" id="date" name="date" value="<?php echo $article['date']; ?>" required>

        <label for="content">Isi Artikel:</label>
        <textarea id="content" name="content" rows="5" placeholder="Masukkan isi artikel" required><?php echo $article['content']; ?></textarea>

        <label for="image">Gambar Artikel:</label>
        <input type="file" id="image" name="image" accept="image/*">

        <button type="submit">Perbarui Artikel</button>
    </form>
</body>
</html>