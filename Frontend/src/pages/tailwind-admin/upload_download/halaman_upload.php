<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload dan Download File PDF Dengan PHP Dan MySQL</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"> -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-md rounded-lg p-8 max-w-md w-full">
        <h2 class="text-2xl font-bold text-center mb-6">Form Upload File (PDF)</h2>
        <form action="ScriptFileUpload.php" method="post" enctype="multipart/form-data" class="space-y-4">
            <div>
                <label for="judul" class="block text-sm font-medium text-gray-700">Judul Jurnal:</label>
                <input type="text" name="judul" id="judul" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="">
            </div>
            <div>
                <label for="abstrak" class="block text-sm font-medium text-gray-700">Abstrak:</label>
                <input type="text" name="abstrak" id="abstrak" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="">
            </div>
            <div>
                <label for="berkas" class="block text-sm font-medium text-gray-700">Upload File:</label>
                <input type="file" name="berkas" id="berkas" accept="application/pdf" class="mt-1 block w-full text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div class="text-center">
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Upload File</button>
            </div>
        </form>
    </div>
</body>

</html>