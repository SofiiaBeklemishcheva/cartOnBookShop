<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['add_to_cart'])) {
        $id = $_POST['product_id'];
        $label = $_POST['product_label'];
        $authorName = $_POST['product_author'];
        $price = $_POST['product_price'];
        $img = $_POST['product_image'];
        $genre = $_POST['product_genre'];


        $product = [
            "id" => $id,
            "label" => $label,
            "author" => $authorName,
            "price" => $price,
            "img" => $img,
            "genre" => $genre,
            "amount" => 1
        ];

        $_SESSION['cart'][] = $product;

        echo json_encode(['status' => 'success', 'message' => 'Produkt dodany do koszyka.']);
        exit;
    }

    if (isset($_POST['remove_cart'])) {
        $productIdToRemove = $_POST['product_id'];

        $_SESSION['cart'] = array_filter($_SESSION['cart'], function($product) use ($productIdToRemove) {
            return $product['id'] != $productIdToRemove;
        });

        echo json_encode(['status' => 'success', 'message' => 'Produkt został usunięty z koszyka.']);
        exit;
    }
}
?>



<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua:wght@400;600;700&display=swap" rel="stylesheet">
    <title>Home</title>


    <link rel="stylesheet" href="CSS/Layout/header.css?v=1.2">
    <link rel="stylesheet" href="CSS/globals.css?v=1.2">
    <link rel="stylesheet" href="CSS/Components/product-tile.css?v=1.2">
    <link rel="stylesheet" href="CSS/Components/add-to-cart-button.css?v=1.2">
    <link rel="stylesheet" href="CSS/Components/amoun-in-cart-paticular-item.css?v=1.2">
    <link rel="stylesheet" href="CSS/Components/cart-item.css?v=1.3">

    <link rel="stylesheet" href="CSS/Components/cart.css?v=1.2">
    <link rel="stylesheet" href="CSS/Components/order-button.css?v=1.2">
    <link rel="stylesheet" href="CSS/Pages/index.css?v=1.2">

    <script src="JS/cartDataBase.js?v=2"></script>

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
        loadCart();
        setProductList();

        const cartContainer = document.querySelector('.cart-container');
        const cartButton = document.querySelector('.header-button-img');

        cartContainer.style.display = "none";

        cartButton.addEventListener('click', function() {
            if (cartContainer.style.display === "none" || !cartContainer.style.display) {

                cartContainer.style.display = "block";
                cartContainer.style.opacity = 0;
                let fadeInEffect = setInterval(function() {
                    if (parseFloat(cartContainer.style.opacity) < 1) {
                        cartContainer.style.opacity = parseFloat(cartContainer.style.opacity) + 0.1;
                    } else {
                        clearInterval(fadeInEffect);
                    }
                }, 30);
            } else {

                let fadeOutEffect = setInterval(function() {
                    if (parseFloat(cartContainer.style.opacity) > 0) {
                        cartContainer.style.opacity -= 0.1;
                    } else {
                        clearInterval(fadeOutEffect);
                        cartContainer.style.display = "none";
                    }
                }, 30);
            }
        });

        const buttons = document.querySelectorAll('.button-container');

        buttons.forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();

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

                                loadCart();
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