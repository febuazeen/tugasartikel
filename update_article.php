<?php
include 'db.php'; // Pastikan ini mengarah ke file db.php yang benar

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $article_id = $_POST['id'];
    $title = $_POST['title'];
    $author_id = $_POST['author_id'];
    $date = $_POST['date'];
    $content = $_POST['content'];
    $picture = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        $picture = $target_file;
    }

    // Update artikel di database
    $query = "UPDATE article SET title='$title', date='$date', content='$content'" . ($picture ? ", picture='$picture'" : "") . " WHERE id='$article_id'";
    if (mysqli_query($koneksi, $query)) {
        // Update author jika diperlukan
        $query_author = "UPDATE article_author SET author_id='$author_id' WHERE article_id='$article_id'";
        mysqli_query($koneksi, $query_author);
        header("Location: index.php");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>