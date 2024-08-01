<?php
require '../../../../Backend/config.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
    <meta name="author" content="David Grzyb">
    <meta name="description" content="">

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

        .font-family-karla {
            font-family: karla;
        }

        .article-container {
            max-width: 100%;
        }
    </style>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
</head>

<body class="bg-white font-family-karla">

    <!-- Top Bar Nav -->
    <nav class="w-full py-4 bg-blue-800 shadow">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between">

            <nav>
                <ul class="flex items-center justify-between font-bold text-sm text-white uppercase no-underline">
                    <li><a class="hover:text-gray-200 hover:underline px-4" href="index.php">Home</a></li>

                </ul>
            </nav>

            <div class="flex items-center text-lg no-underline text-white pr-6">
                <a class="" href="#">
                    <i class="fab fa-facebook"></i>
                </a>
                <a class="pl-6" href="#">
                    <i class="fab fa-instagram"></i>
                </a>
                <a class="pl-6" href="#">
                    <i class="fab fa-twitter"></i>
                </a>
                <a class="pl-6" href="#">
                    <i class="fab fa-linkedin"></i>
                </a>
            </div>
        </div>
    </nav>

    <!-- Text Header -->
    <?php
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
    } else {
        $id = 0;
    }
    $sql = "SELECT * FROM articles where id=$id";
    $hasil = mysqli_query($conn, $sql);
    $jmlArtikel = mysqli_num_rows($hasil);

    if ($jmlArtikel > 0) {
        while ($row = mysqli_fetch_assoc($hasil)) {
            // Hilangkan karakter spesial dari konten
            $title = strip_tags(html_entity_decode($row["title"]));
    ?>
            <header class="w-full container flex items-center justify-center">
                <div class="flex flex-col items-center py-12">
                    <a class="font-bold text-gray-800 uppercase hover:text-gray-700 text-5xl" href="#">
                        <?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?>
                    </a>

                </div>
        <?php
        }
    }
        ?>
            </header>

            <div class="container mx-auto flex flex-wrap py-6">

                <!-- Post Section -->
                <section class="w-full flex flex-col items-center px-3 article-container">
                    <article class="flex flex-col shadow my-4 w-full">
                        <?php
                        if (isset($_GET["id"])) {
                            $id = $_GET["id"];
                        } else {
                            $id = 0;
                        }
                        $sql = "SELECT * FROM articles where id=$id";
                        $hasil = mysqli_query($conn, $sql);
                        $jmlArtikel = mysqli_num_rows($hasil);

                        if ($jmlArtikel > 0) {
                            while ($row = mysqli_fetch_assoc($hasil)) {
                                // Hilangkan karakter spesial dari konten
                                $title = strip_tags(html_entity_decode($row["title"]));
                                $content = strip_tags(html_entity_decode($row["content"]));
                                $author = strip_tags(html_entity_decode($row["author"]));
                        ?>
                                <!-- Article Image -->
                                <a href="#" class="hover:opacity-75">
                                    <img src="../tailwind-admin/crud/upload/<?php echo $row["image"] ?>" class="w-full">
                                </a>
                                <div class="bg-white flex flex-col justify-start p-6">
                                    <a href="#" class="text-3xl font-bold hover:text-gray-700 pb-4"><?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></a>
                                    <p class="text-base text-justify"><?php echo htmlspecialchars($content, ENT_QUOTES, 'UTF-8') ?></p>
                                    <p href="#" class="text-sm pb-8">
                                        By <a href="#" class="font-semibold hover:text-gray-800"><?php echo htmlspecialchars($author, ENT_QUOTES, 'UTF-8') ?></a>, <?php echo $row["created_at"] ?>
                                    </p>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </article>

                    <div class="w-full bg-white p-6 shadow mt-10">
                        <h2 class="text-2xl font-bold mb-4">Tinggalkan Komentar</h2>
                        <form action="../../../../Backend/post_comment.php" method="post" class="border border-gray-300 p-4 rounded-lg">
                            <input class="h-8 border border-gray-400 rounded" type="hidden" name="article_id" value="<?php echo $id; ?>">
                            <div class="mb-4">
                                <label for="author" class="block text-gray-700">Nama:</label>
                                <input type="text" id="author" name="author" class="form-input mt-1 block w-full border border-gray-400 rounded px-3 py-2" required>
                            </div>
                            <div class="mb-4">
                                <label for="content" class="block text-gray-700">Komentar:</label>
                                <textarea id="content" name="content" rows="4" class="form-textarea mt-1 block w-full border border-gray-400 rounded px-3 py-2" required></textarea>
                            </div>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Kirim Komentar</button>
                        </form>
                    </div>

                    <div class="w-full bg-white p-6 shadow mt-10">
                        <h2 class="text-2xl font-bold mb-4">Komentar</h2>
                        <?php
                        $sql_comments = "SELECT * FROM comments WHERE article_id='$id' ORDER BY created_at DESC";
                        $result_comments = mysqli_query($conn, $sql_comments);

                        if (mysqli_num_rows($result_comments) > 0) {
                            while ($comment = mysqli_fetch_assoc($result_comments)) {
                                $comment_author = htmlspecialchars($comment['author'], ENT_QUOTES, 'UTF-8');
                                $comment_content = htmlspecialchars($comment['content'], ENT_QUOTES, 'UTF-8');
                                $comment_created_at = $comment['created_at'];
                        ?>
                                <div class="mb-4">
                                    <p class="font-bold"><?php echo $comment_author; ?></p>
                                    <p class="text-sm text-gray-600"><?php echo $comment_created_at; ?></p>
                                    <p class="mt-2"><?php echo $comment_content; ?></p>
                                </div>
                        <?php
                            }
                        } else {
                            echo "<p>Belum ada komentar.</p>";
                        }
                        ?>
                    </div>


                    <div class="w-full flex pt-6">
                        <a href="#" class="w-1/2 bg-white shadow hover:shadow-md text-left p-6">
                            <p class="text-lg text-blue-800 font-bold flex items-center"><i class="fas fa-arrow-left pr-1"></i> Previous</p>
                            <p class="pt-2">Lorem Ipsum Dolor Sit Amet Dolor Sit Amet</p>
                        </a>
                        <a href="#" class="w-1/2 bg-white shadow hover:shadow-md text-right p-6">
                            <p class="text-lg text-blue-800 font-bold flex items-center justify-end">Next <i class="fas fa-arrow-right pl-1"></i></p>
                            <p class="pt-2">Lorem Ipsum Dolor Sit Amet Dolor Sit Amet</p>
                        </a>
                    </div>

                    <div class="w-full flex flex-col text-center md:text-left md:flex-row shadow bg-white mt-10 mb-10 p-6">
                        <div class="w-full md:w-1/5 flex justify-center md:justify-start pb-4">
                            <img src="../../../assets/Black Simple Bold Professional Twitter Profile Picture.png" class="rounded-full shadow h-32 w-32">
                        </div>
                        <div class="flex-1 flex flex-col justify-center md:justify-start">
                            <p class="font-semibold text-2xl">Muhammad Daffa Malik Akram</p>
                            <p class="pt-2">Saya adalah seorang mahasiswa UIN JAKARTA yang bersemangat dalam dunia pengembangan web, dan situs web ini adalah wadah untuk membagikan proyek-proyek saya. Dengan latar belakang pendidikan saya dalam ilmu komputer dan hasrat saya dalam merancang dan membangun situs web yang menarik, saya berharap Anda dapat menemukan inspirasi dan melihat perkembangan saya sebagai pengembang web.</p>
                            <div class="flex items-center justify-center md:justify-start text-2xl no-underline text-blue-800 pt-4">
                                <a class="" href="#">
                                    <i class="fab fa-facebook"></i>
                                </a>
                                <a class="pl-4" href="#">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a class="pl-4" href="#">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a class="pl-4" href="#">
                                    <i class="fab fa-linkedin"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                </section>

            </div>

            <footer class="w-full border-t bg-white pb-12">
                <div class="w-full container mx-auto flex flex-col items-center">
                    <div class="flex flex-col md:flex-row text-center md:text-left md:justify-between py-6">
                        <a href="#" class="uppercase px-3">About Us</a>
                        <a href="#" class="uppercase px-3">Privacy Policy</a>
                        <a href="#" class="uppercase px-3">Terms & Conditions</a>
                        <a href="#" class="uppercase px-3">Contact Us</a>
                    </div>
                    <div class="uppercase pb-6">&copy; myblog.com</div>
                </div>
            </footer>

</body>

</html>