<?php


// back 
$previous = "javascript:history.go(-1)";
if (isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}

use Post\Management;

require_once('./vendor/autoload.php');
$post = new Management();
if (isset($_GET['id'])) {
    // pass web-site url
    $site_url  = "http://localhost:80/blog-site/postDetails.php?id=" . $_GET['id'];
    // post title
    $site_title  = "FatimaBlog";
    $post_id = trim($_GET['id']);
    $post->getPost($post_id);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./dist/css//tailwind.css">
    <title><?php echo $post->postTitle ?></title>
</head>

<body class="bg-secondary w-screen   text-white overflow-x-hidden flex flex-col items-center ">
    <div class="relative w-full h-96 px-0 md:px-20">
        <div class=" relative w-full h-full bg-red-400 ">
            <a href="<?= $previous ?>"
                class="absolute w-20 h-20 cursor-pointer hover:bg-transparent transition-all bg-black flex justify-center items-center">
                <ion-icon class='text-3xl font-light' name="arrow-back-outline"></ion-icon>
            </a>
        </div>
    </div>
    <div class="relative px-4 md:px20 lg:px-60 w-full">

        <div class="relative bg-gray-700 p-6 w-full">

            <!-- share -->
            <div class="absolute  right-0 md:-right-12 flex flex-row gap-2" style="writing-mode: vertical-lr">
                <a class="relative h-fit p-3 cursor-pointer text-white bg-blue-400 hover:bg-transparent hover:border-blue-400
                    flex justify-center items-center" style="width: 100%;"
                    href="https://twitter.com/share?url='<?= $site_url ?>'&amp;text='Blog from Fatima blog'"
                    target=" _blank">
                    <ion-icon name="logo-twitter"></ion-icon>
                </a>
                <a class="relative h-fit p-3 cursor-pointer text-white bg-blue-400 hover:bg-transparent hover:border-blue-400
                    flex justify-center items-center" style="width: 100%;"
                    href="http://www.linkedin.com/shareArticle?mini=true&amp;url='<?= $site_url ?>'" target="_blank">
                    <ion-icon name="logo-linkedin"></ion-icon>
                </a>

                <a href="http://www.facebook.com/sharer.php?u=<?= $site_url ?>" target="_blank"
                    class="h-fit p-3  text-white bg-blue-500 flex justify-center items-center">
                    <ion-icon name="logo-facebook"></ion-icon>
                </a>
                <!-- <a class="h-fit p-3  text-white bg-green-400  flex justify-center items-center">
                    <ion-icon name="logo-whatsapp"></ion-icon>
                </a> -->
            </div>

            <!-- content of the blog -->
            <div class="min-h-full">
                <?php
                echo $post->postBody;
                ?>
            </div>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
</body>

</html>