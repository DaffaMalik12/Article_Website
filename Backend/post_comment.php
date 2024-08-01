<?php
require 'config.php';

// Ambil data dari form
$article_id = $_POST['article_id'];
$author = $_POST['author'];
$content = $_POST['content'];

// Validasi input
$author = mysqli_real_escape_string($conn, $author);
$content = mysqli_real_escape_string($conn, $content);

// Insert ke database
$sql = "INSERT INTO comments (article_id, author, content) VALUES ('$article_id', '$author', '$content')";
if (mysqli_query($conn, $sql)) {
    header("Location: ../frontend/src/pages/user/isi_artikel.php?id=" . $article_id); // Arahkan kembali ke artikel
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
}
