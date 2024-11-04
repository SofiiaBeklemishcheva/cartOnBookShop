<?php
session_start();
require_once 'ConnectionController.php';

header('Content-Type: application/json');

use API\ConnectionController;

$controller = new ConnectionController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $products = json_decode(file_get_contents('php://input'), true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(['status' => 'error', 'message' => 'Błąd podczas dekodowania JSON: ' . json_last_error_msg()]);
        exit;
    }

    $result = $controller->submitOrder($products);
    echo json_encode($result);
    exit;
}

echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
exit;
