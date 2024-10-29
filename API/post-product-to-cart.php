<?php
session_start(); // Upewnij się, że sesja jest uruchomiona

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sprawdź, czy dane zostały przesłane
    if (isset($_POST['product_id'])) {
        // Debug: Wyświetlenie zawartości $_POST
        file_put_contents('debug_post.log', print_r($_POST, true), FILE_APPEND);

        // Utworzenie tablicy produktu
        $product = [
            'id' => $_POST['product_id'],
            'label' => $_POST['product_label'],
            'author' => $_POST['product_author'],
            'price' => $_POST['product_price'],
            'image' => $_POST['product_image'],
            'genre' => $_POST['product_genre'],
            'stock' => $_POST['product_stock'],
            'amount' => 1 // domyślna ilość
        ];

        // Sprawdź, czy koszyk już istnieje w sesji
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = []; // Zainicjalizuj jako pustą tablicę
        }

        // Dodaj produkt do koszyka w sesji
        $found = false;
        foreach ($_SESSION['cart'] as &$item) {
            if (is_array($item) && isset($item['id']) && $item['id'] === $product['id']) {
                $item['amount'] += 1; // Zwiększ ilość, jeśli produkt już istnieje
                $found = true;
                break;
            }
        }

        if (!$found) {
            $_SESSION['cart'][] = $product; // Dodaj nowy produkt, jeśli nie znaleziono
        }

        // Zwróć dane JSON dla JS
        echo json_encode([
            'status' => 'success',
            'product_id' => $product['id'],
            'product_image' => $product['image'],
            'product_label' => $product['label'],
            'product_price' => $product['price'],
            'product_author' => $product['author'],
            'product_genre' => $product['genre']
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Nieprawidłowe dane.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Nieprawidłowa metoda żądania.']);
}
