<?php

use API\ConnectionController;

session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Adding a product to the cart
    if (isset($_POST['add_to_cart'])) {
        $productId = $_POST['product_id'];
        $productLabel = $_POST['label'];
        $productAuthor = $_POST['author'];
        $productPrice = $_POST['price'];
        $productImage = $_POST['image'];
        $productGenre = $_POST['genre'];
        $amount = isset($_POST['amount']) ? (int)$_POST['amount'] : 1;

        $productExists = false;
        foreach ($_SESSION['cart'] as &$product) {
            if ($product['id'] == $productId) {
                $product['amount'] += $amount;
                $productExists = true;
                break;
            }
        }

        if (!$productExists) {
            $_SESSION['cart'][] = [
                'id' => $productId,
                'label' => $productLabel,
                'author' => $productAuthor,
                'price' => $productPrice,
                'image' => $productImage,
                'genre' => $productGenre,
                'amount' => $amount
            ];
        }

        echo json_encode(['status' => 'success', 'message' => 'Product added to cart.']);
        exit;
    }

    if (isset($_POST['update_cart'])) {
        $productId = $_POST['product_id'];
        $newAmount = (int)$_POST['amount'];

        foreach ($_SESSION['cart'] as &$product) {
            if ($product['id'] == $productId) {
                $product['amount'] = $newAmount;
                break;
            }
        }

        echo json_encode(['status' => 'success', 'message' => 'Cart updated.']);
        exit;
    }

    if (isset($_POST['remove_cart'])) {
        $productIdToRemove = $_POST['product_id'];

        $_SESSION['cart'] = array_filter($_SESSION['cart'], function($product) use ($productIdToRemove) {
            return $product['id'] != $productIdToRemove;
        });

        echo json_encode(['status' => 'success', 'message' => 'Product removed from cart.']);
        exit;
    }
}

require_once 'ConnectionController.php';
$controller = new ConnectionController();

if (!empty($_SESSION['cart'])) {
    $orderData = array_map(function($product) {
        return [
            'id' => $product['id'],
            'label' => $product['label'],
            'price' => $product['price'],
            'amount' => $product['amount']
        ];
    }, $_SESSION['cart']);

    $controller->submitOrder($orderData);
}


