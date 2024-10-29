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
    <script src="/JS/cartDataBase.js" defer></script>
    <?php session_start(); ?>
</head>
<body class="body-container">

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
                    $book["nazwa"],
                    $book["autor"],
                    $book["cena"],
                    $book["linkZdjęcie"],
                    $book["ID"],
                    $book["gatunek"],
                    $book["stanMagazynowy"]
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
        </div>
    </div>
</div>

<script>

    document.addEventListener("DOMContentLoaded", function() {
        setProductList();
        const cartContainer = document.querySelector('.cart-container');
        const cartButton = document.querySelector('.header-button-img');

        cartButton.addEventListener('click', function() {
            if (cartContainer.style.display === "none" || !cartContainer.style.display) {
                cartContainer.style.display = "block";
                cartContainer.style.opacity = 0; // Ustawiamy opacity na 0 przed animacją
                let fadeEffect = setInterval(function () {
                    if (!cartContainer.style.opacity) {
                        cartContainer.style.opacity = 0;
                    }
                    if (cartContainer.style.opacity < 1) {
                        cartContainer.style.opacity = parseFloat(cartContainer.style.opacity) + 0.1;
                    } else {
                        clearInterval(fadeEffect);
                    }
                }, 50);
            } else {
                // Animacja ukrywania
                let fadeEffect = setInterval(function () {
                    if (!cartContainer.style.opacity) {
                        cartContainer.style.opacity = 1;
                    }
                    if (cartContainer.style.opacity > 0) {
                        cartContainer.style.opacity -= 0.1;
                    } else {
                        clearInterval(fadeEffect);
                        cartContainer.style.display = "none"; // Ukrywamy kontener
                    }
                }, 50);
            }
        });

    });



    function updateProductAmount(id, amount) {
        let productItem = product.find((item) => item.id === id);
        if (productItem) {
            productItem.amount = amount;
        }
    }

    function increaseAmount(id, maxValue) {
        let amountInput = document.getElementById("amount-display-" + id);
        if (amountInput) {
            let amount = parseInt(amountInput.value) || 0;
            if (amount < maxValue) {
                amount++;
                amountInput.value = amount;
                updateProductAmount(id, amount); // Uaktualnij ilość produktu
                updateCartValue(); // Uaktualnij wartość koszyka
            }
        }
    }

    function decreaseAmount(id) {
        let amountInput = document.getElementById("amount-display-" + id);
        if (amountInput) {
            let amount = parseInt(amountInput.value) || 0;
            if (amount > 1) {
                amount--;
                amountInput.value = amount;
                updateProductAmount(id, amount); // Uaktualnij ilość produktu
                updateCartValue(); // Uaktualnij wartość koszyka
            }
        }
    }


    document.addEventListener("DOMContentLoaded", function () {
        const buttons = document.querySelectorAll('.button-container');

        buttons.forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault(); // Zatrzymaj domyślne działanie formularza

                const form = this.closest('form');
                if (form) {
                    const formData = new FormData(form);
                    fetch('API/post-product-to-cart.php', {
                        method: 'POST',
                        body: formData
                    })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.status === 'success') {
                                // Po dodaniu produktu do koszyka możesz go załadować
                                loadCart(); // Funkcja, która zaktualizuje widok koszyka
                            }
                        })
                        .catch(error => console.error('Wystąpił błąd:', error));
                }
            });
        });
    });


</script>
</body>
</html>