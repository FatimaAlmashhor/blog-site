<!DOCTYPE html>
<html lang="en">
<?php

use Post\Management;

require_once('../vendor/autoload.php');

$postManager = new Management();

if (isset($_POST['submit'])) {
    print_r($_POST['blog_body']);
    $postTitle = trim($_POST["title"]);
    $postBody = trim($_POST["blog_body"]);

    $postManager->addPost($postTitle, $postBody);
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
    <form action='index.php' method="post">
        <input type="text" name='title' placeholder="Title of the article" />
        <textarea name="blog_body"></textarea>
        <input type="submit" name='submit' />
        <script>
        CKEDITOR.replace('blog_body');
        </script>
    </form>
</body>

</html>