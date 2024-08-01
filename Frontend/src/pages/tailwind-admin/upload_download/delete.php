<?php
include 'koneksi.php';

$conn = koneksiDB();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus file fisik
    $query = "SELECT berkas FROM jurnal WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $filePath = 'nyimpenJurnal/' . $row['berkas'];

    if (file_exists($filePath)) {
        unlink($filePath);
    }

    // Hapus data dari database
    $query = "DELETE FROM jurnal WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        header("Location: ../tabs.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "ID tidak ditemukan";
}

mysqli_close($conn);
