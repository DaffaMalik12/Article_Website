<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Ambil ID artikel dari query string
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    // Koneksi ke database
    $conn = new mysqli("localhost", "root", "", "artikel");

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Ambil nama file gambar dari database sebelum menghapus
    $stmt = $conn->prepare("SELECT image FROM articles WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $article = $result->fetch_assoc();

    if ($article) {
        $image_path = __DIR__ . "/uploads/" . $article['image'];

        // Hapus file gambar dari server
        if (file_exists($image_path)) {
            unlink($image_path);
        }

        // Hapus artikel dari database
        $stmt = $conn->prepare("DELETE FROM articles WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            // Redirect setelah sukses
            header("Location: ../blank.php"); // Ganti dengan halaman sukses Anda
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Artikel tidak ditemukan.";
    }

    $stmt->close();
    $conn->close();
}
