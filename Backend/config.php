<?php
// config.php

$servername = "localhost";
$username = "root"; // ganti dengan username database Anda
$password = "";     // ganti dengan password database Anda
$dbname = "artikel"; // ganti dengan nama database Anda

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
