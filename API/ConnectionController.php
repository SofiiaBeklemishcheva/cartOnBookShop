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
        $database = "book_shop";
        $username = "root";
        $password = "root";

        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getAllBooksData(){
        try {
            $stmt = $this->conn->prepare(
                "SELECT 
                sklep_produkty.nazwa, 
                sklep_produkty.cena, 
                CONCAT(autorzy.imie, ' ', autorzy.nazwisko) AS autor, 
                sklep_produkty.autorID, 
                sklep_produkty.gatunekID,
                gatunek.nazwa AS gatunek,
                sklep_produkty.stanMagazynowy, 
                sklep_produkty.linkZdjęcie, 
                sklep_produkty.ID 
            FROM 
                sklep_produkty
            JOIN 
                autorzy ON sklep_produkty.autorID = autorzy.ID
            JOIN 
                gatunek ON sklep_produkty.gatunekID = gatunek.ID");
            $stmt->execute();

            $resultsArray = array ();
            foreach ($stmt as $row){
                $resultsArrayRow = array (
                    "nazwa" => $row["nazwa"],
                    "cena" => $row["cena"],
                    "autor" => $row["autor"],
                    "gatunekID" => $row["gatunekID"],
                    "gatunek" => $row["gatunek"],
                    "stanMagazynowy" => $row["stanMagazynowy"],
                    "linkZdjęcie" => $row["linkZdjęcie"],
                    "ID" => $row["ID"]
                );
                array_push($resultsArray, $resultsArrayRow);
            }

            return $resultsArray;

        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return ("Coś poszło nie tak");
        }
    }

}