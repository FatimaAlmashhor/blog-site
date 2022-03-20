<?php

use Post\Management;

require_once('./vendor/autoload.php');
$post = new Management();
if (isset($_GET['id'])) {
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

<body class="bg-secondary w-screen   text-white overflow-x-hidden">
    <div class=" px-4 md:px20 lg:px-60">
        <div class="bg-primary p-6">
            <?php
            echo $post->postBody;
            ?>
        </div>
    </div>
</body>

</html>