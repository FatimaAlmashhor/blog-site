<?php

use Inital\Owner;
use Post\Fetch;

require_once __DIR__ . "/vendor/autoload.php";
include './templates/navbar.php';

$owner = new Owner();
$posts = new Fetch();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./dist/css/tailwind.css">
    <title>Fatima Blogs</title>
</head>

<body class="bg-primary w-screen  text-white overflow-x-hidden">

    <div class='flex '>
        <nav class="bg-secondary w-24 h-screen sticky top-0">
            F
        </nav>
        <div>
            <header class="h-screen">
                <div class="w-full h-full flex flex-col justify-center px-20">
                    <h1 class="text-7xl">Blogs</h1>
                    <h1 class="text-7xl">Fatima Almashhor</h1>
                </div>
            </header>
            <main class="flex px-4 md:px-12 lg:px-20 ">
                <!--  all articles-->

                <section class="flex flex-wrap gap-6">
                    <?php
                    foreach ($posts->posts as $post) {
                    ?> <article class="bg-secondary cursor-pointer hover:border-2 border-blue rounded-lg">
                        <div class="w-60 h-52  relative">
                            <div class="absolute w-12 h-12 rounded-full flex justify-center items-center bg-blue"
                                style="top:-20px;left:-20px">
                                React
                            </div>
                            <a href='postDetails.php?id=<?php echo $post->blog_id ?>' class="w-full h-full p-3">
                                <div class="pt-6 p-3 flex flex-col gap-2  h-full ">
                                    <h2 class="text-xl"><?php echo $post->blog_title; ?></h2>
                                    <div class="overflow-hidden w-full h-16">
                                        <p class="text-gray-400"> <?php echo $post->blog_des; ?></p>
                                    </div>
                                    <div class="flex flex-1 items-center justify-self-end ">
                                        <!-- Dot -->
                                        <div class="w-2 h-2 rounded-full bg-red-400 mx-3">
                                        </div>
                                        <small>Web</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </article>
                    <?php
                    }
                    ?>

                </section>
                <!-- aside for aside articles -->
                <aside class="hidden lg:flex">
                    aside
                </aside>
            </main>


        </div>
    </div>
</body>

</html>