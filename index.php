<?php

use Inital\Owner;
use Post\Fetch;

require_once __DIR__ . "/vendor/autoload.php";
include './templates/navbar.php';

$owner = new Owner();
$posts = new Fetch();

foreach ($posts->posts as $post) {
?>
<div>
    <?php echo $post['blog_title']; ?>
</div>
<?php
}