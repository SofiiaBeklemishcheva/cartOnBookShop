
<link rel="stylesheet" href="CSS/Components/cart.css">

<?php
function generateCart($cartItems, $itemsInCart) {
    ?>
    <script>

        function increaseAmount(id, maxValue) {
            console.log("Zaczynam liczyć")
            let amount = document.getElementById("amount-display-"+id).value
            console.log(document.getElementById("amount-display-"+id))
            console.log(amount)
            if(amount<maxValue){
                amount++
            }

            document.getElementById("amount-display-"+id).value = amount;
        }

        function decreaseAmount(id) {
            let amount = document.getElementById("amount-display-"+id).value
            if(amount>1){
                amount--;
            }
            document.getElementById("amount-display-"+id).value = amount;

        }
    </script>
    <div class="cart-container">
    <p>Twój koszyk (<?= $itemsInCart ?>)</p>
    <?php
    include './Components/cart-item.php';
          foreach ($cartItems as $item) {

            $img = $item['img'];
            $label = $item['label'];
            $price = $item['price'];
            $name = $item['name'];
            $author = $item['author'];
            $publisher = $item['publisher'];
            $genre = $item['genre'];
            $id = $item['id'];

            generateCartItem($img, $label, $price, $name, $author, $publisher, $genre, $id);
        }
        ?>
        <p class="summary-container" id="summary-container">Wartość koszyka: xxxx zł.</p>

        <?php
        include './Components/order-button.php';
        generateOrderButton();
        ?>
    </div>
    <?php
}
?>