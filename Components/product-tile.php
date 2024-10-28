<link rel="stylesheet" href="../CSS/Components/product-tile.css">
<link rel="stylesheet" href="../CSS/globals.css">

<?php
function generateProductTile($label, $authorName, $price, $img, $id) {
    ?>
    <div class="product-tile-container">
        <img class="product-tile-img" src="<?= $img ?>" alt="<?= $label ?>"/>
        <p class = "product-tile-label"><?= $label ?></p>
        <p class = "product-tile-label"><?= $authorName ?></p>
        <p class = "product-tile-price"><?= $price ?></p>
        <?php include_once './Components/add-to-cart-button.php';
         generateAddToCartButton($id);?>
    </div>
    <?php
}
?>
