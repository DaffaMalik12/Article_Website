<?php
// Koneksi ke database
$host = 'localhost';
$dbname = 'artikel';
$username = 'root'; // Ubah jika perlu
$password = ''; // Ubah jika perlu

// Buat koneksi
$conn = new mysqli($host, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ID jurnal dari query string
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id) {
    // Query untuk mendapatkan data jurnal berdasarkan ID
    $sql = "SELECT berkas FROM jurnal WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($berkas);
    $stmt->fetch();
    $stmt->close();

    // Periksa apakah berkas ditemukan
    if ($berkas) {
        // Atur header untuk menampilkan PDF
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . basename($berkas) . '"');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . filesize($berkas));

        // Baca dan tampilkan file PDF
        readfile($berkas);
    } else {
        echo "File tidak ditemukan.";
    }
} else {
    echo "ID jurnal tidak valid.";
}

// Tutup koneksi
$conn->close();
?>
