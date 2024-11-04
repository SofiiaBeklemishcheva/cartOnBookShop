<link rel="stylesheet" href="CSS/Components/product-tile.css">
<link rel="stylesheet" href="CSS/globals.css">

<?php
function generateProductTile($label, $authorName, $price, $img, $id, $genre, $stock) {
    ?>
    <div class="product-tile-container">
        <img class="product-tile-img" src="<?= $img ?>" alt="<?= htmlspecialchars($label) ?>"/>
        <p class="product-tile-label"><?= htmlspecialchars($label) ?></p>
        <p class="product-tile-author"><?= htmlspecialchars($authorName) ?></p>
        <p class="product-tile-price"><?= htmlspecialchars($price) ?> zł</p>

        <form method="post" action="API/post-product-to-cart.php">
            <input type="hidden" name="product_id" value="<?= htmlspecialchars($id) ?>">
            <input type="hidden" name="product_label" value="<?= htmlspecialchars($label) ?>">
            <input type="hidden" name="product_author" value="<?= htmlspecialchars($authorName) ?>">
            <input type="hidden" name="product_price" value="<?= htmlspecialchars($price) ?>">
            <input type="hidden" name="product_image" value="<?= htmlspecialchars($img) ?>">
            <input type="hidden" name="product_genre" value="<?= htmlspecialchars($genre) ?>">
            <input type="hidden" name="product_stock" value="<?= htmlspecialchars($stock) ?>">

            <?php
            include_once 'Components/add-to-cart-button.php';
            generateAddToCartButton($id, $label, $authorName, $price, $img, $genre, $stock);
            ?>
        </form>
    </div>
    <?php
}
?>
