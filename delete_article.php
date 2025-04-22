<?php
include 'db.php'; // Pastikan ini mengarah ke file db.php yang benar

if (isset($_GET['id'])) {
    $article_id = $_GET['id'];

    // Hapus artikel dari database
    $query = "DELETE FROM article WHERE id='$article_id'";
    if (mysqli_query($koneksi, $query)) {
        // Hapus juga dari tabel article_author
        $query_author = "DELETE FROM article_author WHERE article_id='$article_id'";
        mysqli_query($koneksi, $query_author);
        header("Location: index.php");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>