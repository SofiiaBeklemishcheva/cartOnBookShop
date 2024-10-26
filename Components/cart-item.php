<link rel="stylesheet" href="../CSS/Components/product-tile.scss">

<?php
function generateCartItem($img,
$label,
$price,
$name,
$author,
$publisher,
$genre) {
    ?>
    <div class="cart-item-container">
        <div class = "item-top-container">
        <img class="item-img" src="<?= $img ?>" alt="<?= $label ?>"/>
        <div class="iten-price-container">
        <p class = "item-price"><?= $price ?></p>
        <p class = "item-label">Cena z VAT 23%</p>
        <p class = "item-price-with-tax"><?= $price ?> x 1</p>
        <?php
        include './Components/amount-in-cart-particular-item.php';
        $amount = 2;
        generateCartItemChangeAmount($amount);
        ?>
        </div>
        </div>
        <div class = "item-description-container">
        <p class = "item-description"><?= $name?></p>
        <p class = "item-description"><?= $author ?></p>
        <p class = "item-description"><?= $publisher ?></p>
        <p class = "item-description"><?= $genre ?></p>
        </div>
        
    </div>
    <?php
}
?>




