<?php

namespace API;

use PDO;
use PDOException;

class ConnectionController
{

    private $conn;

    public function __construct()
    {
        $servername = "localhost";
        $database = "optimistic_page";
        $username = "root";
        $password = "root";

        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

}