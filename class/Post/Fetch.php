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
        $this->conn->query("SELECT `blog_id` , `blog_title` , `blog_body` FROM  blogs");
        $this->conn->execute();
        $this->posts =  $this->conn->fetchAll();
    }
    /**
     * Return a post
     * @param int $id
     * @return object
     */


    public function fetchPost(int $id): object
    {
        // Send query
        $this->db->query("SELECT `blog_title`, `blog_body` FROM `blogs` WHERE `blog_id`=:id");
        // Bind the data
        $this->db->bind(":id", $id, PDO::PARAM_INT);
        // Execute the statement
        $this->db->execute();
        // Return the received data
        return $this->db->fetch();
    }
}