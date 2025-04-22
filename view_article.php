<?php
include 'db.php'; // Pastikan ini mengarah ke file db.php yang benar

// Ambil ID artikel dari URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Ambil data artikel dari database
    $query = "SELECT a.*, GROUP_CONCAT(au.nickname SEPARATOR ', ') AS authors 
              FROM article a 
              LEFT JOIN article_author aa ON a.id = aa.article_id 
              LEFT JOIN author au ON aa.author_id = au.id 
              WHERE a.id = '$id' 
              GROUP BY a.id";
    $result = mysqli_query($koneksi, $query);
    $article = mysqli_fetch_assoc($result);
    
    if (!$article) {
        echo "Artikel tidak ditemukan.";
        exit;
    }
} else {
    echo "ID artikel tidak diberikan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($article['title']); ?></title>
    <link rel="stylesheet" href="style.css"> <!-- Link ke file CSS Anda -->
</head>
<body>

<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="create_article.php">Tambah Artikel</a></li>
        <li><a href="login.php">Login</a></li>
    </ul>
</nav>

<h1><?php echo htmlspecialchars($article['title']); ?></h1>
<p><strong>Ditulis oleh:</strong> <?php echo htmlspecialchars($article['authors']); ?></p>
<p><strong>Tanggal:</strong> <?php echo htmlspecialchars($article['date']); ?></p>
<?php if (!empty($article['picture'])): ?>
    <img src="<?php echo htmlspecialchars($article['picture']); ?>" alt="<?php echo htmlspecialchars($article['title']); ?>" class="article-image">
<?php endif; ?>
<p><?php echo nl2br(htmlspecialchars($article['content'])); ?></p>

<div>
    <a href="edit_article.php?id=<?php echo $article['id']; ?>" class="edit-link">Edit Artikel</a>
    <a href="delete_article.php?id=<?php echo $article['id']; ?>" class="delete-link">Hapus Artikel</a>
    <a href="index.php" class="view-link">Kembali ke Daftar Artikel</a>
</div>

</body>
</html>