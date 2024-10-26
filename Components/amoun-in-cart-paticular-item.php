<link rel="stylesheet" href="../CSS/Components/product-tile.scss">

<?php
function generateCartItemChangeAmount($amount) {
    ?>
    <div class="amount-counting-component-container">
        <button class = "decrease">
            <img class="item-img" src="" alt="Dodaj"/>
        </button>

        <p class = "amount-of-items-label"><?= $amount ?></p>

        <button class = "increase">
            <img class="item-img" src="" alt="Odejmij"/>
        </button>
        
    </div>
    <?php
}
?>