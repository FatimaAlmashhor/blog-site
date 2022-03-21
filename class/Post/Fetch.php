<?php

namespace Post;


use Database\DBConnection;
use PDO;

require_once __DIR__ . "/../../vendor/autoload.php";

class Fetch
{
    private $conn;
    public $posts;
    function __construct()
    {
        $this->conn = new DBConnection();
        $this->fetchPosts();
    }

    // fetch all the posts
    function fetchPosts(): void
    {
        $this->conn->query("SELECT `blog_id` , `blog_title` , `blog_body` ,`blog_des` , `created_at` FROM  blogs");
        $this->conn->execute();
        $this->posts =  $this->conn->fetchAll();
    }
}