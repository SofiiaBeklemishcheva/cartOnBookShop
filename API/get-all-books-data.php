<?php
use API\ConnectionController;
require "API/ConnectionController.php";

$dataBaseConnection = new ConnectionController();

$booksData = $dataBaseConnection->getAllBooksData();

