  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Jurnal</title>
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
        <a href="blank.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
          <i class="fas fa-sticky-note mr-3"></i>
          Artikel
        </a>

        <a href="tabs.html" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
          <i class="fas fa-tablet-alt mr-3"></i>
          Jurnal
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
          <a href="index.html" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
          <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
            <i x-show="!isOpen" class="fas fa-bars"></i>
            <i x-show="isOpen" class="fas fa-times"></i>
          </button>
        </div>

        <!-- Dropdown Nav -->
        <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
          <a href="index.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
            <i class="fas fa-tachometer-alt mr-3"></i>
            Dashboard
          </a>
          <a href="blank.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
            <i class="fas fa-sticky-note mr-3"></i>
            Artikel
          </a>

          <a href="tabs.php" class="flex items-center active-nav-link text-white py-2 pl-4 nav-item">
            <i class="fas fa-tablet-alt mr-3"></i>
            Jurnal
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
          <div class="bg-white shadow-md rounded-lg p-8 w-full max-w-4xl mx-auto ">
            <h2 class="text-2xl font-bold text-center mb-6">Tabel Upload/Download File (PDF)</h2>
            <div class="text-right mb-4">
              <button onclick="document.location='upload_download/halaman_upload.php'" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Tambah Data</button>
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
                  include 'upload_download/koneksi.php';
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
                        <td class="py-2 px-4 flex justify-center space-x-2">
                          <a href="upload_download/DownloadFile.php?url=<?php echo $row['berkas']; ?>" class="inline-flex items-center justify-center px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white text-sm font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Download</a>
                          <a href="upload_download/delete.php?id=<?php echo $row['id']; ?>" class="inline-flex items-center justify-center px-4 py-2 bg-red-500 hover:bg-red-700 text-white text-sm font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Hapus</a>
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

        </main>
      </div>
    </div>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
  </body>

  </html>