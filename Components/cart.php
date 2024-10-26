
<link rel="stylesheet" href="../CSS/Components/product-tile.scss">

<?php
function generateCart() {
    ?>
    <div class="cart-container">
    <?php
        include './Components/cart-item.php';
        $img = ;
$label = ;
$price = ;
$name = ;
$author = ;
$publisher = ;
$genre = ;
        generateCartItem($img,
        $label,
        $price,
        $name,
        $author,
        $publisher,
        $genre);
        ?>
        
    </div>
    <?php
}
?>