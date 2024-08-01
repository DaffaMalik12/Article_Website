<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "artikel");

if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ID artikel dari query parameter
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Ambil data artikel dari database
$sql = "SELECT * FROM articles WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$article = $result->fetch_assoc();

if (!$article) {
  die("Artikel tidak ditemukan.");
}

// Saat menampilkan kembali konten di form
$articleContent = isset($article['content']) ? strip_tags(html_entity_decode($article['content'])) : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Proses pembaruan artikel
  $title = isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '';
  $author = isset($_POST['author']) ? htmlspecialchars($_POST['author']) : '';
  $content = isset($_POST['content']) ? htmlspecialchars($_POST['content']) : '';

  // Jika ada file gambar baru yang diunggah
  if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    // Tentukan direktori untuk menyimpan file
    $target_dir = __DIR__ . "/upload/";

    // Tentukan nama file dan path
    $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
    $allowedFileTypes = ['jpg', 'jpeg', 'png', 'gif'];

    // Validasi file
    if (in_array($imageFileType, $allowedFileTypes)) {
      $target_file = uniqid() . '.' . $imageFileType; // Nama file unik
      $target_path = $target_dir . $target_file;

      // Pindahkan file yang diunggah ke direktori yang ditentukan
      if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_path)) {
        $image = $target_file;
      } else {
        die("Maaf, terjadi kesalahan saat mengunggah file.");
      }
    } else {
      die("Maaf, hanya file gambar yang diperbolehkan.");
    }
  } else {
    // Jika tidak ada file gambar baru, gunakan gambar lama
    $image = $article['image'];
  }

  // Update artikel di database
  $sql = "UPDATE articles SET image = ?, title = ?, author = ?, content = ? WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssssi", $image, $title, $author, $content, $id);

  if ($stmt->execute()) {
    // Redirect setelah sukses
    header("Location: ../blank.php"); // Ganti dengan halaman sukses Anda
    exit();
  } else {
    echo "Error: " . $stmt->error;
  }

  $stmt->close();
  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Artikel</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      ClassicEditor.create(document.querySelector("#editor")).catch(
        (error) => {
          console.error(error);
        }
      );

      const imageInput = document.getElementById('image');
      const imagePreview = document.getElementById('image-preview');

      imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = function(e) {
            imagePreview.src = e.target.result;
          };
          reader.readAsDataURL(file);
        }
      });
    });
  </script>
</head>

<body>
  <div class="leading-loose lg:w-4/5 mx-auto lg:mt-10">
    <p class="pb-6 flex items-center font-bold text-2xl">Edit Artikel</p>
    <form class="p-10 bg-white shadow-xl rounded-xl" method="POST" enctype="multipart/form-data">
      <div class="mb-4">
        <label class="block text-sm text-gray-600" for="image">Upload Gambar</label>
        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="image" name="image" type="file" accept="image/*" aria-label="Image" />
      </div>
      <div class="mb-4">
        <img id="image-preview" src="<?= 'upload/' . htmlspecialchars($article['image']) ?>" alt="Image Preview" class="w-full h-auto rounded" />
      </div>
      <div class="">
        <label class="block text-sm text-gray-600" for="title">Judul</label>
        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="title" name="title" type="text" value="<?= htmlspecialchars($article['title']) ?>" required="" placeholder="Judul" aria-label="Title" />
      </div>
      <div class="mt-2">
        <label class="block text-sm text-gray-600" for="author">Subjudul</label>
        <input class="w-full px-5 py-4 text-gray-700 bg-gray-200 rounded" id="author" name="author" type="text" value="<?= htmlspecialchars($article['author']) ?>" required="" placeholder="Subjudul" aria-label="Subtitle" />
      </div>
      <div class="mt-2">
        <label class="block text-sm text-gray-600" for="content">Konten</label>
        <textarea id="editor" name="content"><?= htmlspecialchars($articleContent) ?></textarea>
      </div>
      <div class="mt-6">
        <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded" type="submit">Submit</button>
      </div>
    </form>
  </div>
</body>

</html>