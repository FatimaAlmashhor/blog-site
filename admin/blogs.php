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
    <title>Blogs</title>
</head>

<body>
    <?php
    foreach ($posts->posts as $post) {

    ?>
    <div>
        <?php echo $post->blog_title; ?>
    </div>
    <a href="./posts/edit.php?id=<?php echo $post->blog_id;?>">Edit</a>
    <a href="./posts/delete.php?id=<?php echo $post->blog_id;?>">Delete</a>
    <?php
    };
    ?>
</body>

</html>