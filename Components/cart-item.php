<link rel="stylesheet" href="../CSS/Components/cart-item.css">

<?php
function generateCartItem($img,
$label,
$price,
$name,
$author,
$publisher,
$genre,
$id) {
    ?>
    <div class="cart-item-container">
        <div class = "item-top-container">
        <img class="book-img" src="<?= $img ?>" alt="<?= $label ?>"/>
                <div class="item-price-container">
                <p class = "item-price"><?= $price ?> zł.</p>
                <p class = "item-label">Cena z VAT 23%</p>
                <p class = "item-price-with-tax"><?= $price ?> zł. x 1</p>
                <?php
                include_once './Components/amoun-in-cart-paticular-item.php';
                $amount = 2;
                generateCartItemChangeAmount($id);
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




