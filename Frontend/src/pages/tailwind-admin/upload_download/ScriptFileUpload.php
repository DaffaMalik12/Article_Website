<?php
include 'Koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['judul'];
    $abstrak = $_POST['abstrak'];
    $namaFile = $_FILES['berkas']['name'];
    $x = explode('.', $namaFile);
    $ekstensiFile = strtolower(end($x));
    $ukuranFile = $_FILES['berkas']['size'];
    $file_tmp = $_FILES['berkas']['tmp_name'];

    // Lokasi Penempatan file
    $dirUpload = "nyimpenJurnal/";
    $linkBerkas = $dirUpload . $namaFile;

    // Membuat direktori jika belum ada
    if (!is_dir($dirUpload)) {
        mkdir($dirUpload, 0755, true);
    }

    // Menyimpan file
    $terupload = move_uploaded_file($file_tmp, $linkBerkas);

    if ($terupload) {
        $dataArr = array(
            'judul' => $judul,
            'abstrak' => $abstrak,
            'size' => $ukuranFile,
            'ekstensi' => $ekstensiFile,
            'berkas' => $linkBerkas,
        );

        if (insertData($dataArr) == 1) {
            echo "Upload berhasil!";
            header("Location: ../tabs.php", true, 301);
            exit();
        } else {
            echo "Upload Gagal!";
            header("Location: halaman_upload.php", true, 301);
            exit();
        }
    } else {
        echo "Upload Gagal!";
        header("Location: halaman_upload.php", true, 301);
        exit();
    }
}
