<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./CSS/Pages/index.css">
    <link rel="stylesheet" href="./CSS/Components/cart-item.css">
    <link rel="stylesheet" href="./CSS/Components/cart.css">
    <link rel="stylesheet" href="./CSS/Components/order-button.css">
    <link rel="stylesheet" href="./CSS/Components/amoun-in-cart-paticular-item.css">
</head>
<body class="body-container">
<script src="/JS/cartDataBase.js"></script>

<?php
include "Layout/header.php";
include "API/get-all-books-data.php";
include './Components/product-tile.php';
include "Components/cart.php";
generateHeader();
?>

<div class="page-content-container">
    <div class="product-tiles-container">
            <?php
            if (!empty($booksData)) {
                foreach ($booksData as $book) {
                    generateProductTile(
                        $book['nazwa'],
                        $book['autor'],
                        $book['cena'] . " zł",
                        $book['linkZdjęcie'],
                        $book['ID']
                    );
                }
            } else {
                echo "Brak wyników do wyświetlenia.";
            }
            ?>
        </div>

    <div>
        <div class="cart-container">
            <div class="cart-container-products" id="mini-cart"></div>

            <script>
                setProductList();


                function increaseAmount(id, maxValue) {
                    let amountInput = document.getElementById("amount-display-" + id);
                    if (amountInput) {
                        let amount = parseInt(amountInput.value) || 0; // Bezpieczne przypisanie
                        if (amount < maxValue) {
                            amount++;
                            amountInput.value = amount;
                        }
                    }
                }

                function decreaseAmount(id) {
                    let amountInput = document.getElementById("amount-display-" + id);
                    if (amountInput) { // Sprawdzamy, czy element istnieje
                        let amount = parseInt(amountInput.value) || 0; // Użyj 0, jeśli wartość jest NaN
                        if (amount > 1) {
                            amount--;
                            amountInput.value = amount;
                        }
                    }
                }
            </script>
        </div>
    </div>
</div>
</body>
</html>
