<link rel="stylesheet" href="../CSS/Components/product-tile.scss">

<?php
function generateProductTile($label, $authorName, $price, $img) {
    ?>
    <div class="product-tile-container">
        <img src="<?= $img ?>" alt=""/>
        <p><?= $label ?></p>
        <p><?= $authorName ?></p>
        <p><?= $price ?></p>
        <?php include './Components/add-to-cart-button.php';
         generateAddToCartButton();?>
    </div>
    <?php
}
?>
