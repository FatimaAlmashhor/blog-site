<!DOCTYPE html>
<?php

use Post\Fetch;

require_once('../vendor/autoload.php');

$posts = new Fetch();

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/sidebar.css">
    <link rel="stylesheet" href="../dist/css/tailwind.css">
    <title>Blogs</title>
</head>

<body class="bg-primary text-white">
    <div class=" w-fit h-fit">
        <?php
        include '../templates/sidebar.php';
        ?>
    </div>
    <main class=" pl-32 relative min-h-screen w-full  ">
        <div class="absolute bottom-5 right-5 bg-blue rounded-full w-16 h-16 hover:shadow-lg "> <a
                href='./posts/new.php' class="w-full h-full flex justify-center items-center ">
                <ion-icon name="add-outline" class="font-bold text-3xl"></ion-icon>
            </a>
        </div>
        <?php
        foreach ($posts->posts as $post) {

        ?> <div>
            <?php echo $post->blog_title; ?>
        </div>
        <a href="./posts/edit.php?id=<?php echo $post->blog_id; ?>">Edit</a>
        <a href="./posts/delete.php?id=<?php echo $post->blog_id; ?>">Delete</a>
        <?php
        };
        ?>
    </main>
    <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
    <!-- ===== MAIN JS ===== -->
    <script src="../public/js/main.js"></script>
</body>

</html>