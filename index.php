<?php

use Inital\Owner;

require_once __DIR__ . "/vendor/autoload.php";
include './templates/navbar.php';

$owner = new Owner();
$has =  $owner->hasOwner;

if (isset($GET['model'])  &&  $_GET['model'] == 'open') {
    if ($_GET['do'] == 'register') {
        include_once('register.php');
    }
}