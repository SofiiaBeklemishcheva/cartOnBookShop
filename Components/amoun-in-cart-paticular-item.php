<link rel="stylesheet" href="../CSS/Components/amoun-in-cart-paticular-item.css">

<?php
function generateCartItemChangeAmount($id) {
    ob_start();
    ?>
    <div class="amount-counting-component-container">
        <button class="increase" onclick="increaseAmount('<?= $id;?>', 10)">
            <img class="item-img" src="/Universal/plus.png" alt="Dodaj"/>
        </button>

        <input type="number" class="amount-of-items-label" id="amount-display-<?= $id;?>" value="1"/>

        <button class="decrease" onclick="decreaseAmount('<?= $id;?>')">
            <img class="item-img" src="/Universal/minus.png" alt="Odejmij"/>
        </button>
    </div>
    <?php
    return ob_get_clean();
}

if (isset($_GET['id'])) {
    echo generateCartItemChangeAmount($_GET['id']);
}
?>

