<!DOCTYPE html>
<html lang="en">
<?php

use Post\Management;
use Category\FetchCate;

require_once('../../vendor/autoload.php');

$cates = new FetchCate();
$mainCates = $cates->fetchMainCat();
// print_r($mainCates);
foreach ($mainCates as $cat) {
    $web = $cates->fetchSubCates($cat->category_id);
    // foreach ($web as $web)
    // echo "<h1>" . $web->category_title . "</h1>";
}

$postManager = new Management();
if (isset($_POST['main_cat'])) {
    $catId = $_POST['main_cat'];
    print_r($catId);
}
if (isset($_POST['submit'])) {
    // print_r($_POST['blog_body']);
    $postTitle = trim($_POST["title"]);
    $postDes = trim($_POST["blog_des"]);
    $postBody = trim($_POST["blog_body"]);
    $catId = (int)trim($mainCates[0]->category_id);
    $postManager->addPost($postTitle, $postDes, $postBody,  $catId);
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.ckeditor.com/4.18.0/full/ckeditor.js"></script>
    <link rel="stylesheet" href="../../public/css/sidebar.css">
    <link rel="stylesheet" href="../../dist/css/tailwind.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#myDropDown').change(function() {
            //Selected value
            var inputValue = $(this).val();

            alert("value in js " + inputValue);

            //Ajax for calling php function
            $.post('submit.php', {
                dropdownValue: inputValue
            }, function(data) {
                alert('ajax completed. Response:  ' + data);
                //do after submission operation in DOM
            });
        });
    });
    </script>
    <title>Blogs</title>
</head>

<body class="bg-primary text-white">
    <div class=" w-fit h-fit">
        <?php
        include '../../templates/sidebar.php';
        ?>
    </div>
    <main class=" pl-32 mt-12  relative min-h-screen w-full  flex flex-col  items-center mx-auth">
        <div class="w-12/12 lg:w-9/12 h-full p-8 bg-secondary">
            <h1 class="text-xl mb-4">Adding new blog</h1>
            <form action='./new.php' method="post" class=" flex flex-col gap-4">
                <div class="flex flex-col lg:flex-row gap-5">
                    <label>Category:</label>
                    <select id='myDropDown' name='main_cat'
                        class="w-full p-3 bg-transparent border border-gray-400 rounded ">
                        <?php
                        foreach ($mainCates as $cat) {
                            echo "<option class='bg-transparent text-white' value=" . $cat->category_id . ">";
                            echo $cat->category_title;
                            echo " </option> ";
                        }
                        ?>

                    </select>
                    <?php
                    if (isset($_POST['main_cat']))
                        echo $_POST['main_cat'] ?>
                    <select class="w-full p-3 bg-transparent border border-gray-400 rounded ">
                        <option>
                            Test
                        </option>
                    </select>
                </div>
                <input class="p-5 bg-transparent border border-gray-400 rounded" type="text" name='title'
                    placeholder="Title of the article" />
                <input class="p-5 bg-transparent border border-gray-400 rounded" type="text" name='blog_des'
                    placeholder="Some description" />
                <textarea class="p-5 bg-transparent border border-gray-400 rounded" name="blog_body"></textarea>
                <input class="p-3 bg-blue border border-gray-400 rounded" type="submit" name='submit' />
                <script>
                CKEDITOR.replace('blog_body');
                </script>
            </form>
        </div>
    </main>
    <!-- ===== IONICONS ===== -->
    <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
    <!-- ===== MAIN JS ===== -->
    <script src="../../public/js/main.js"></script>
</body>

</html>