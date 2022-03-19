<?php

namespace Inital;

use Database\DBConnection;
use PDO;

class Owner
{
    public $hasOwner;
    function __construct()
    {
        $this->conn = new DBConnection();
        $this->checkOwner();
    }

    function checkOwner()
    {
        $this->conn->query("SELECT `auth_id`  FROM  auth WHERE `auth_type` =:type");
        $this->conn->bind(":type", 0, PDO::PARAM_INT);
        $this->conn->execute();
        $this->hasOwner =  $this->conn->rowCount();
        if($this->hasOwner == 0){
            header('location: register.php');
            die();
        }
    }
}