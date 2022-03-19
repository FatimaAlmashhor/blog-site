<?php

use Inital\Owner;

require_once __DIR__ . "/vendor/autoload.php";

$owner = new Owner();
$has =  $owner->hasOwner;