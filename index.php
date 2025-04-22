<?php
include 'db.php'; // Pastikan ini mengarah ke file db.php yang benar
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Web Artikel</title>
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
    <h1>Blogger</h1>
    <div class="article-container">
        <?php
        // Query untuk mengambil data artikel
        $query = "SELECT a.id, a.title, a.date, a.content, a.picture, GROUP_CONCAT(au.nickname SEPARATOR ', ') AS authors 
                  FROM article a 
                  JOIN article_author aa ON a.id = aa.article_id 
                  JOIN author au ON aa.author_id = au.id 
                  GROUP BY a.id";

        // Eksekusi query
        $result = mysqli_query($koneksi, $query);

        // Cek apakah query berhasil
        if ($result) {
            // Loop melalui hasil query
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="article-card">';
                if (!empty($row['picture'])) {
                    echo '<img src="' . htmlspecialchars($row['picture']) . '" alt="Gambar Artikel" class="article-image">';
                }
                echo '<h2>' . htmlspecialchars($row['title']) . '</h2>';
                echo '<p>Oleh: ' . htmlspecialchars($row['authors']) . ' | Tanggal: ' . htmlspecialchars($row['date']) . '</p>';
                echo '<p>' . nl2br(htmlspecialchars(substr($row['content'], 0, 100))) . '...</p>';
                echo '<a href="edit_article.php?id=' . $row['id'] . '" class="edit-link">Edit</a>';
                echo '<a href="delete_article.php?id=' . $row['id'] . '" class="delete-link">Hapus</a>';
                echo '<a href="view_article.php?id=' . $row['id'] . '" class="view-link">Lihat Selengkapnya</a>';
                echo '</div>';
            }
        } else {
            // Jika query gagal, tampilkan pesan kesalahan
            echo "Error: " . mysqli_error($koneksi);
        }
        ?>
    </div>
    <div class="artikel">
        <h6>Copyright © Blogger</h6>
    </div>
</body>

</html>