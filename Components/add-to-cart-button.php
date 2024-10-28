<link rel="stylesheet" href="../CSS/Components/add-to-cart-button.css">
<?php
function generateAddToCartButton($id) {
    $customId = "cart-button-" . htmlspecialchars($id);
    ?>
    <div class="container">
        <button class="button-container" id=<?= $customId ?>>
            <img src="../Universal/cartWhite.png" class = "button-icon" alt="Dodaj do koszyka"/>
            <span class="button-label">DO KOSZYKA</span>
        </button>
    </div>
<?php }   ?>
