<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = ""; // Ganti dengan password database kamu jika ada
$database = "artikel"; // Ganti dengan nama database kamu

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $database);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil ID dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Query untuk mengambil detail jurnal berdasarkan ID
$sql = "SELECT * FROM jurnal WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Mengecek jika data ditemukan
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Jurnal tidak ditemukan.";
    exit;
}

// Menutup koneksi
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en" class="bg-white">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <title><?php echo htmlspecialchars($row['judul']); ?></title>
</head>

<body>
    <div class="container mx-auto">
        <!-- navbar -->
        <div class="navbar drop-shadow-2xl ">
            <div class="flex-1">
                <a class="btn btn-ghost text-xl text-gray-800">Jurnal</a>
            </div>
            <div class="flex-none">
                <ul class="menu menu-horizontal px-1">
                    <li><a class="text-gray-800" href="jurnal.php">Kembali</a></li>
                </ul>
            </div>
        </div>
        <!-- Hero Section -->
        <div class="hero h-64" style="background-image: url(https://img.daisyui.com/images/stock/photo-1507358522600-9f71e620c44e.webp);">
            <div class="hero-overlay bg-opacity-60"></div>
            <div class="hero-content text-neutral-content text-center">
                <div class="max-w-md">
                    <h1 class="text-6xl font-bold text-gray-400">Welcome</h1>
                    <p class="text-sm font-medium text-gray-400">Jurnal Teknik Informatika Muhammad Daffa Malik Akram</p>
                </div>
            </div>
        </div>

        <!-- Content with aside -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-10">
            <!-- Main Content -->
            <div class="col-span-2">
                <div class="pembungkus">
                    <h1 class="mb-5 text-5xl font-bold text-black"><?php echo htmlspecialchars($row['judul']); ?></h1>
                    <p class="mb-5">
                        <?php echo nl2br(htmlspecialchars($row['abstrak'])); ?>
                    </p>
                    <!-- Tombol Download -->
                    <a href="../../../../src/pages/tailwind-admin/upload_download/DownloadFile.php?url=<?php echo urlencode($row['berkas']); ?>" class="btn btn-primary text-white">Download PDF</a>
                </div>
            </div>

            <!-- Aside -->
            <aside class="bg-gray-100 p-4 rounded-lg shadow-md">
                <div class="join join-vertical w-full">
                    <div class="collapse collapse-arrow join-item border-base-300 border">
                        <input type="radio" name="my-accordion-4" checked="checked" />
                        <div class="collapse-title text-xl font-medium">Click to open this one and close others</div>
                        <div class="collapse-content">
                            <p>hello</p>
                        </div>
                    </div>
                    <div class="collapse collapse-arrow join-item border-base-300 border">
                        <input type="radio" name="my-accordion-4" />
                        <div class="collapse-title text-xl font-medium">Click to open this one and close others</div>
                        <div class="collapse-content">
                            <p>hello</p>
                        </div>
                    </div>
                    <div class="collapse collapse-arrow join-item border-base-300 border">
                        <input type="radio" name="my-accordion-4" />
                        <div class="collapse-title text-xl font-medium">Click to open this one and close others</div>
                        <div class="collapse-content">
                            <p>hello</p>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</body>

</html>