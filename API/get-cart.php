<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product = [
        'id' => $_POST['product_id'],
        'label' => $_POST['product_label'],
        'author' => $_POST['product_author'],
        'price' => $_POST['product_price'],
        'image' => $_POST['product_image'],
        'genre' => $_POST['product_genre'],
        'stock' => $_POST['product_stock'],
        'amount' => 1
    ];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] === $product['id']) {
            $item['amount'] += 1;
            $found = true;
            break;
        }
    }
    if (!$found) {
        $_SESSION['cart'][] = $product;
    }

    echo json_encode(['status' => 'success']);
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    echo json_encode($_SESSION['cart']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Nieprawidłowe dane.']);
}
