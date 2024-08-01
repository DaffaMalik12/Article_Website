<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload dan Download File PDF Dengan PHP Dan MySQL</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-md rounded-lg p-8 w-full max-w-4xl">
        <h2 class="text-2xl font-bold text-center mb-6">Tabel Upload/Download File (PDF)</h2>
        <div class="text-right mb-4">
            <button onclick="document.location='halaman_upload.php'" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Tambah Data
            </button>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4 border-b border-gray-300">ID</th>
                        <th class="py-2 px-4 border-b border-gray-300">Judul Jurnal</th>
                        <th class="py-2 px-4 border-b border-gray-300">Type</th>
                        <th class="py-2 px-4 border-b border-gray-300">Ukuran</th>
                        <th class="py-2 px-4 border-b border-gray-300">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php
                    include 'koneksi.php';
                    $result = selectAllData();
                    $countData = mysqli_num_rows($result);

                    if ($countData < 1) {
                    ?>
                        <tr>
                            <td colspan="5" class="py-4 text-red-500 font-bold">TIDAK ADA DATA</td>
                        </tr>
                        <?php
                    } else {
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr class="border-t border-gray-300">
                                <td class="py-2 px-4"><?php echo $row['id']; ?></td>
                                <td class="py-2 px-4"><?php echo $row['judul']; ?></td>
                                <td class="py-2 px-4"><?php echo $row['ekstensi']; ?></td>
                                <td class="py-2 px-4"><?php echo number_format($row['size'] / (1024 * 1024), 2); ?>MB</td>
                                <td class="py-2 px-4">
                                    <a href="DownloadFile.php?url=<?php echo $row['berkas']; ?>" class="text-blue-500 hover:underline">Download</a>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>