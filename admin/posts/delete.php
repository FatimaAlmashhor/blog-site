<?php

use Post\Management;

require_once('../../vendor/autoload.php');

$postManager = new Management();
if (isset($_GET['id'])) {
    $postManager->deletePost($_GET['id']);
}