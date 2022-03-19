<?php

namespace Database;

use PDO;
use PDOException;

class DBConnection
{
    private $host       = 'mysql:host=localhost;dbname=blog-site'; //or localhost
    private $port       = 8081;
    private $user       = 'root';
    private $password   = '';
    private  $conn;
    private $stmt;

    function __construct()
    {
        try {
            $this->conn  = new PDO($this->host, $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo 'Scussesfuly connected ';
        } catch (PDOException $e) {
            echo 'Failed To Connected' . $e;
        }
    }
    function query(string $sql): void
    {
        $this->stmt = $this->conn->prepare($sql);
    }
    function bind(string $param, string $value, int $type)
    {
        $this->stmt->bindParam($param, $value, $type);
    }
    function execute(): bool
    {
        if ($this->stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    // return object
    function fetch()
    {
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // return array 
    public function fetchAll(): array
    {
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function rowCount(): int
    {
        return $this->stmt->rowCount();
    }

    public function __destruct()
    { {
            $this->db = null;
            $this->stmt = null;
        }
    }
}