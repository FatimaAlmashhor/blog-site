<?php

use Post\Fetch as FetchPost;

require_once __DIR__ . "/vendor/autoload.php";

$posts = new FetchPost();
print_r($posts);