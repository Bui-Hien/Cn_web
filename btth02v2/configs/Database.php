<?php

namespace connection;

use PDO;
use PDOException;

class Database
{
    private $host = "localhost";
    private $port = "3306";
    private $dbname = "btth01_cse485";
    private $username = "root";
    private $password = "";
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host={$this->host};port={$this->port};dbname={$this->dbname}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Log the error message (you can store this in a log file for further debugging)
            $this->conn = null;
        }
    }

    public function getConnect()
    {
        return $this->conn;
    }
}
