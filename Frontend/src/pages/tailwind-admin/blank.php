<?php
include '../../../../Backend/config.php'; // Memasukkan file konfigurasi database

// Query untuk mengambil data dari tabel 'artikel'
$sql = "SELECT * FROM articles";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Artikel</title>
  <meta name="author" content="David Grzyb" />
  <meta name="description" content="" />

  <!-- Tailwind -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet" />
  <style>
    @import url("https://fonts.googleapis.com/css?family=Karla:400,700&display=swap");

    .font-family-karla {
      font-family: karla;
    }

    .bg-sidebar {
      background: #3d68ff;
    }

    .cta-btn {
      color: #3d68ff;
    }

    .upgrade-btn {
      background: #1947ee;
    }

    .upgrade-btn:hover {
      background: #0038fd;
    }

    .active-nav-link {
      background: #1947ee;
    }

    .nav-item:hover {
      background: #1947ee;
    }

    .account-link:hover {
      background: #3d68ff;
    }
  </style>
</head>

<body class="bg-gray-100 font-family-karla flex">
  <aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
    <div class="p-6">
      <a href="admin.html" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
    </div>
    <nav class="text-white text-base font-semibold pt-3">
      <a href="admin.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
        <i class="fas fa-tachometer-alt mr-3"></i>
        Dashboard
      </a>
      <a href="blank.html" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
        <i class="fas fa-sticky-note mr-3"></i>
        Blank Page
      </a>
      <a href="tables.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
        <i class="fas fa-table mr-3"></i>
        Tables
      </a>
      <a href="forms.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
        <i class="fas fa-align-left mr-3"></i>
        Forms
      </a>
      <a href="tabs.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
        <i class="fas fa-tablet-alt mr-3"></i>
        Tabbed Content
      </a>
      <a href="calendar.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
        <i class="fas fa-calendar mr-3"></i>
        Calendar
      </a>
    </nav>
  </aside>

  <div class="relative w-full flex flex-col h-screen overflow-y-hidden">
    <!-- Desktop Header -->
    <header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
      <div class="w-1/2"></div>
      <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
        <button @click="isOpen = !isOpen" class="realtive z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
          <img src="../../../assets/Black Simple Bold Professional Twitter Profile Picture.png" />
        </button>
        <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
        <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
          <a href="../../../../Backend/logout.php" class="block px-4 py-2 account-link hover:text-white">Sign Out</a>
        </div>
      </div>
    </header>

    <!-- Mobile Header & Nav -->
    <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 sm:hidden">
      <div class="flex items-center justify-between">
        <a href="admin.html" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
        <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
          <i x-show="!isOpen" class="fas fa-bars"></i>
          <i x-show="isOpen" class="fas fa-times"></i>
        </button>
      </div>

      <!-- Dropdown Nav -->
      <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
        <a href="admin.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
          <i class="fas fa-tachometer-alt mr-3"></i>
          Dashboard
        </a>
        <a href="blank.html" class="flex items-center active-nav-link text-white py-2 pl-4 nav-item">
          <i class="fas fa-sticky-note mr-3"></i>
          Blank Page
        </a>
        <a href="tables.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
          <i class="fas fa-table mr-3"></i>
          Tables
        </a>
        <a href="forms.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
          <i class="fas fa-align-left mr-3"></i>
          Forms
        </a>
        <a href="tabs.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
          <i class="fas fa-tablet-alt mr-3"></i>
          Tabbed Content
        </a>
        <a href="calendar.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
          <i class="fas fa-calendar mr-3"></i>
          Calendar
        </a>
        <a href="#" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
          <i class="fas fa-cogs mr-3"></i>
          Support
        </a>
        <a href="#" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
          <i class="fas fa-user mr-3"></i>
          My Account
        </a>
        <a href="#" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
          <i class="fas fa-sign-out-alt mr-3"></i>
          Sign Out
        </a>
      </nav>
      <!-- <button class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                <i class="fas fa-plus mr-3"></i> New Report
            </button> -->
    </header>

    <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
      <main class="w-full flex-grow p-6">
        <div class="flex justify-between items-center">
          <h1 class="text-3xl text-black pb-6">Artikel</h1>
          <div class="space-x-2">
            <a href="crud/create.php" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
              Create Artikel
            </a>
          </div>
        </div>
        <div class="container mx-auto">
          <h1 class="text-2xl font-bold mb-6">CRUD Table</h1>
          <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
              <thead class="bg-gray-800 text-white">
                <tr>
                  <th class="w-1/5 py-3 px-4 uppercase font-semibold text-sm">Gambar</th>
                  <th class="w-1/3 py-3 px-4 uppercase font-semibold text-sm">Judul</th>
                  <th class="w-1/4 py-3 px-4 uppercase font-semibold text-sm">Penulis</th>
                  <th class="w-1/4 py-3 px-4 uppercase font-semibold text-sm">Aksi</th>
                </tr>
              </thead>
              <tbody class="text-gray-700">
                <?php if ($result->num_rows > 0) : ?>
                  <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr class="<?= $row['id'] % 2 == 0 ? 'bg-gray-100' : '' ?>">
                      <td class="w-1/5 py-3 px-4">
                        <img src="crud/upload/<?= $row['image'] ?>" alt="Image" class="w-full h-auto rounded">
                      </td>
                      <td class="w-1/3 py-3 px-4"><?= htmlspecialchars($row['title']) ?></td>
                      <td class="w-1/4 py-3 px-4"><?= htmlspecialchars($row['author']) ?></td>
                      <td class="w-1/4 py-3 px-4">
                        <a href="crud/edit.php?id=<?= $row['id'] ?>" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">Edit</a>
                        <button onclick="confirmDelete(<?= $row['id'] ?>)" class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
                      </td>
                    </tr>
                  <?php endwhile; ?>
                <?php else : ?>
                  <tr>
                    <td colspan="4" class="py-3 px-4 text-center">Tidak ada data</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </main>
    </div>
    <?php
    $conn->close(); // Menutup koneksi
    ?>
  </div>

  <!-- AlpineJS -->
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <!-- Font Awesome -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
  <script>
    function confirmDelete(id) {
      // Tampilkan dialog konfirmasi
      if (confirm("Apakah Anda yakin ingin menghapus artikel ini?")) {
        // Jika dikonfirmasi, arahkan ke skrip delete
        window.location.href = 'crud/delete.php?id=' + id;
      }
    }
  </script>

</body>

</html>