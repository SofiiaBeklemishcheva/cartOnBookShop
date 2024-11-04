let product = [];

if (typeof cartProductsData !== 'undefined') {
    product = cartProductsData;
}

function loadCart() {
    const cartContainer = document.getElementById("mini-cart");
    cartContainer.innerHTML = '';

    fetch('API/get-cart.php')
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json();
        })
        .then(cartItems => {
            console.log('Otrzymane dane koszyka:', cartItems);
            if (typeof cartItems === 'object' && cartItems !== null) {
                cartItems = Object.values(cartItems);
            } else {
                console.error('Otrzymane dane nie są obiektem:', cartItems);
                return;
            }
            cartItems.forEach(item => {
                const existingProductIndex = product.findIndex(prod => prod.id === item.id);
                if (existingProductIndex !== -1) {
                    product[existingProductIndex].amount = item.amount;
                } else {
                    product.push({
                        id: item.id,
                        label: item.label,
                        author: item.author,
                        price: item.price,
                        img: item.image,
                        genre: item.genre,
                        amount: item.amount
                    });
                }
            });
            setProductList();
        })
        .catch(error => console.error('Error fetching cart:', error));
}

function renderCartSummary(container, totalAmount) {
    const summaryContainer = document.createElement("div");
    summaryContainer.classList.add("cart-summary");

    const totalAmountElement = document.createElement("p");
    totalAmountElement.id = "total-amount";
    totalAmountElement.textContent = `Wartość koszyka: ${totalAmount.toFixed(2)} PLN`;
    summaryContainer.appendChild(totalAmountElement);

    const orderButtonContainer = document.createElement("div");
    orderButtonContainer.classList.add("order-button-container");

    const orderButton = document.createElement("button");
    orderButton.textContent = "ZAMAWIAM";
    orderButton.classList.add("order-button");

    orderButton.addEventListener("click", function() {
        fetch('/zadanie-rekrutacyjne-omnicorp/API/submit-order.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(product),
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert("Zamówienie zostało złożone!");
                    product = [];
                    setProductList();
                } else {
                    console.error('Błąd podczas składania zamówienia:', data.message);
                }
            })
            .catch(error => console.error('Błąd:', error));
    });

    orderButtonContainer.appendChild(orderButton);
    summaryContainer.appendChild(orderButtonContainer);
    container.appendChild(summaryContainer);
}

function setProductList() {
    const root = document.getElementById("mini-cart");
    root.innerHTML = '';

    const totalItems = product.length;
    const cartCountElement = document.createElement("p");
    cartCountElement.id = "cart-count";
    cartCountElement.textContent = `Twój koszyk: ${totalItems}`;
    root.appendChild(cartCountElement);

    let totalAmount = 0;
    product.forEach(element => {
        const cartContainer = document.createElement("div");
        cartContainer.classList.add("cart-item-container");

        const topContainer = document.createElement("div");
        topContainer.classList.add("item-top-container");

        const bookImg = document.createElement("img");
        bookImg.classList.add("book-img");
        bookImg.src = element.img;

        const itemPriceContainer = document.createElement("div");
        itemPriceContainer.classList.add("item-price-container");

        const deleteButton = document.createElement("button");
        deleteButton.classList.add("delete-button");

        const deleteIcon = document.createElement("img");
        deleteIcon.src = "Universal/delete.png";
        deleteIcon.alt = "Usuń";
        deleteIcon.classList.add("delete-icon");

        deleteButton.appendChild(deleteIcon);
        deleteButton.addEventListener('click', () => removeFromCart(element.id));
        itemPriceContainer.appendChild(deleteButton);

        const itemPrice = document.createElement("p");
        itemPrice.classList.add("item-price");
        itemPrice.textContent = `${element.price} zł.`;

        const itemLabel = document.createElement("p");
        itemLabel.classList.add("item-label");
        itemLabel.textContent = element.label;

        const itemPriceWithTax = document.createElement("p");
        itemPriceWithTax.classList.add("item-price-with-tax");
        itemPriceWithTax.textContent = `Cena z VAT 23%: ${element.price} zł.`;

        itemPriceContainer.appendChild(itemPrice);
        itemPriceContainer.appendChild(itemLabel);
        itemPriceContainer.appendChild(itemPriceWithTax);

        const controlsContainer = document.createElement("div");
        controlsContainer.classList.add("controls-container");

        const decreaseButton = document.createElement("button");
        decreaseButton.textContent = "-";
        decreaseButton.classList.add("amount-button");
        decreaseButton.addEventListener('click', () => decreaseAmount(element.id));

        const amountInput = document.createElement("input");
        amountInput.type = "number";
        amountInput.id = "amount-display-" + element.id;
        amountInput.value = element.amount;
        amountInput.classList.add("amount-input");
        amountInput.min = "1";
        amountInput.readOnly = true;

        const increaseButton = document.createElement("button");
        increaseButton.textContent = "+";
        increaseButton.classList.add("amount-button");
        increaseButton.addEventListener('click', () => increaseAmount(element.id));

        controlsContainer.appendChild(decreaseButton);
        controlsContainer.appendChild(amountInput);
        controlsContainer.appendChild(increaseButton);
        itemPriceContainer.appendChild(controlsContainer);

        const descriptionContainer = document.createElement("div");
        descriptionContainer.classList.add("item-description-container");

        const itemDescriptionFields = [
            { className: "item-description", content: element.name },
            { className: "item-description", content: element.author },
            { className: "item-description", content: element.publisher },
            { className: "item-description", content: element.genre }
        ];

        itemDescriptionFields.forEach(field => {
            const itemDescriptionContainer = document.createElement("p");
            itemDescriptionContainer.classList.add(field.className);
            itemDescriptionContainer.textContent = field.content;
            descriptionContainer.appendChild(itemDescriptionContainer);
        });

        const itemTotalPrice = parseFloat(element.price) * parseInt(element.amount);
        totalAmount += itemTotalPrice;

        topContainer.appendChild(bookImg);
        topContainer.appendChild(itemPriceContainer);
        cartContainer.appendChild(topContainer);
        cartContainer.appendChild(descriptionContainer);
        root.appendChild(cartContainer);
    });

    renderCartSummary(root, totalAmount);
}

function addToCart(productId, label, author, price, image, genre, amount = 1) {
    fetch('API/post-product-to-cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `add_to_cart=true&product_id=${productId}&label=${encodeURIComponent(label)}&author=${encodeURIComponent(author)}&price=${price}&image=${encodeURIComponent(image)}&genre=${encodeURIComponent(genre)}&amount=${amount}`
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                console.log(data.message);
                loadCart();
            } else {
                console.error('Błąd:', data.message);
            }
        })
        .catch(error => console.error('Błąd:', error));
}

function decreaseAmount(productId) {
    const productToDecrease = product.find(prod => prod.id === productId);
    if (productToDecrease && productToDecrease.amount > 1) {
        productToDecrease.amount--;
        updateCart(productToDecrease);
    }
}

function increaseAmount(productId) {
    const productToIncrease = product.find(prod => prod.id === productId);
    if (productToIncrease) {
        productToIncrease.amount++;
        updateCart(productToIncrease);
    }
}

function updateCart(productToUpdate) {
    fetch('API/post-product-to-cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `update_cart=true&product_id=${productToUpdate.id}&amount=${productToUpdate.amount}`
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                console.log("Koszyk zaktualizowany");
                loadCart();
            } else {
                console.error('Błąd:', data.message);
            }
        })
        .catch(error => console.error('Błąd:', error));
}

function removeFromCart(productId) {
    fetch('API/post-product-to-cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `remove_cart=true&product_id=${productId}`
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                console.log("Produkt usunięty z koszyka");
                product = product.filter(prod => prod.id !== productId);
                setProductList();
            } else {
                console.error('Błąd:', data.message);
            }
        })
        .catch(error => console.error('Błąd:', error));
}

document.addEventListener('DOMContentLoaded', loadCart);
