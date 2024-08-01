<?php

function koneksiDB()
{
    $host = "localhost";
    $username = "root";
    $password = "";
    $db = "artikel";

    $conn = mysqli_connect($host, $username, $password, $db);

    if (!$conn) {
        die("Koneksi Database Gagal : " . mysqli_connect_error());
    } else {
        return $conn;
    }
}

function selectAllData()
{
    $query = "SELECT * FROM jurnal";
    $result = mysqli_query(koneksiDB(), $query);
    return $result;
}

function insertData($data)
{
    $conn = koneksiDB();
    $stmt = $conn->prepare("INSERT INTO jurnal (judul, abstrak, size, ekstensi, berkas) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiss", $data['judul'], $data['abstrak'], $data['size'], $data['ekstensi'], $data['berkas']);

    if ($stmt->execute()) {
        return 1;
    } else {
        return 0;
    }
}
?>  