<?php
include 'db.php'; // Pastikan ini mengarah ke file db.php yang benar

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author_id = $_POST['author_id'];
    $category_id = $_POST['category_id'];
    $date = $_POST['date'];
    $content = $_POST['content'];
    $picture = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        $picture = $target_file;
    }

    // Simpan artikel ke database
    $query = "INSERT INTO article (title, date, content, picture) VALUES ('$title', '$date', '$content', '$picture')";
    if (mysqli_query($koneksi, $query)) {
        $article_id = mysqli_insert_id($koneksi);
        $query_author = "INSERT INTO article_author (article_id, author_id) VALUES ('$article_id', '$author_id')";
        mysqli_query($koneksi, $query_author);
        header("Location: index.php");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>