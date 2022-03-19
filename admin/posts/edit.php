<!DOCTYPE html>
<html lang="en">
<?php

use Post\{Fetch, Management};

require_once('../../vendor/autoload.php');

$postManager = new Management();
if (isset($_GET['id'])) {
    $postManager->getPost($_GET['id']);
}
if (isset($_POST['edit'])) {
    $postTitle = trim($_POST["title"]);
    $postBody = trim($_POST["blog_body"]);
    $postId = trim($_GET["id"]);

    $postManager->updatePost($postTitle, $postBody, $postId);
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<script src="https://cdn.ckeditor.com/4.18.0/full/ckeditor.js"></script>

<body>
    <h1>Test</h1>
    <form action='./edit.php?edit=true&id=<?php echo $postManager->postId; ?>' method="post">
        <input type="text" name='title' placeholder="Title of the article"
            value=<?php echo $postManager->postTitle ?> />
        <textarea name="blog_body" value=<?php
                                            echo $postManager->postBody;
                                            ?>></textarea>
        <input type="submit" name='edit' />
        <script>
        CKEDITOR.replace('blog_body');
        </script>
    </form>
</body>

</html>