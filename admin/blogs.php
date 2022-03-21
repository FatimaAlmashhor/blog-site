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
        <div class="w-16 h-16 absolute bottom-5 right-5 bg-blue rounded-full  hover:shadow-lg "> <a
                href='./posts/new.php' class="w-full h-full flex justify-center items-center ">
                <ion-icon name="add-outline" class="font-bold text-3xl"></ion-icon>
            </a>
        </div>
        <div class=" w-full h-full pt-24 ">
            <h1 class="text-5xl my-8">BLogs : </h1>
            <div class="w-full flex  pb-4">
                <div class="w-3/12 font-bold text-lg text-gray-400">
                    Title
                </div>
                <div class="w-3/12 font-bold text-lg text-gray-400">
                    Description
                </div>
                <div class="w-3/12 font-bold text-lg text-gray-400">
                    Created At
                </div>
            </div>

            <?php
            foreach ($posts->posts as $key => $post) {
            ?>
            <div
                class=" w-full h-full py-3 flex border-b border-gray-500 cursor-pointer  hover:bg-gray-500 <?php if ($key % 2 == 0) echo 'bg-gray-600' ?>">
                <div class="w-3/12">
                    <?php echo $post->blog_title; ?>
                </div>
                <div class="w-3/12">
                    <?php echo $post->blog_des; ?>
                </div>
                <div class="w-3/12">
                    <?php echo $post->created_at; ?>
                </div>
                <div class="w-3/12 flex gap-x-4">
                    <a href="./posts/edit.php?id=<?php echo $post->blog_id; ?>">Edit</a>
                    <a href="./posts/delete.php?id=<?php echo $post->blog_id; ?>">Delete</a>
                </div>
            </div>
            <?php
            };
            ?>

    </main>
    <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
    <!-- ===== MAIN JS ===== -->
    <script src="../public/js/main.js"></script>
</body>

</html>