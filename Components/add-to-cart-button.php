<link rel="stylesheet" href="../CSS/Components/add-to-cart-button.css">
<?php
function generateAddToCartButton($id, $label, $authorName, $price, $img, $genre, $stock) {
    $customId = "cart-button-" . htmlspecialchars($id); // Wygeneruj customId w funkcji
    ?>
    <div class="container">
        <form method="post" class="add-to-cart-form">
            <input type="hidden" name="product_id" value="<?= htmlspecialchars($id) ?>">
            <input type="hidden" name="product_label" value="<?= htmlspecialchars($label) ?>">
            <input type="hidden" name="product_author" value="<?= htmlspecialchars($authorName) ?>">
            <input type="hidden" name="product_price" value="<?= htmlspecialchars($price) ?>">
            <input type="hidden" name="product_image" value="<?= htmlspecialchars($img) ?>">
            <input type="hidden" name="product_genre" value="<?= htmlspecialchars($genre) ?>">
            <input type="hidden" name="product_name" value="<?= htmlspecialchars($label) ?>">
            <input type="hidden" name="product_stock" value="<?= htmlspecialchars($stock) ?>">

            <button type="submit" class="button-container">
                <img src="../Universal/cartWhite.png" class="button-icon" alt="Dodaj do koszyka"/>
                <span class="button-label">DO KOSZYKA</span>
            </button>
        </form>
    </div>
    <?php
}
?>
