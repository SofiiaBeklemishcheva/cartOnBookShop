<?php
$productId = $_GET['id'];
$maxAmount = 10;

echo '<div class="amount-controls">';
echo '<button class="decrease" onclick="decreaseAmount(' . $productId . ')">-</button>';
echo '<input type="text" id="amount-display-' . $productId . '" value="1" readonly />';
echo '<button class="increase" onclick="increaseAmount(' . $productId . ', ' . $maxAmount . ')">+</button>';
echo '</div>';

