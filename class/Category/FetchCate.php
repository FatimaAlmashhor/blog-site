<?php

namespace Category;


use Database\DBConnection;
use PDO;

require_once __DIR__ . "/../../vendor/autoload.php";

class FetchCate
{
    private $conn;
    public $cates;
    function __construct()
    {
        $this->conn = new DBConnection();
        // $this->fetchCats();
    }

    // fetch all the posts
    function fetchCats()
    {
        $this->conn->query("SELECT * FROM  categories");
        $this->conn->execute();
        return  $this->conn->fetchAll(PDO::FETCH_OBJ);
    }
    function fetchMainCat()
    {
        $this->conn->query("SELECT * FROM  categories WHERE category_sub_id  IS NULL ");
        $this->conn->execute();
        return  $this->conn->fetchAll(PDO::FETCH_OBJ);
    }
    function fetchSubCates($id)
    {
        $this->conn->query("SELECT * FROM  categories WHERE category_id =:cate ");
        $this->conn->bind(':cate', $id, PDO::PARAM_INT);
        $this->conn->execute();
        return  $this->conn->fetchAll(PDO::FETCH_OBJ);
    }
}