let product = []; // Tablica przechowująca produkty w koszyku

function updateCartValue() {
    let cartValue = product.reduce((acc, obj) => {
        const totalItemPrice = parseInt(obj.price) * parseInt(obj.amount);
        console.log(`Produkt: ${obj.name}, Ilość: ${obj.amount}, Cena: ${obj.price}, Łączna cena: ${totalItemPrice}`);
        return acc + totalItemPrice;
    }, 0);

    let cartValueContainer = document.querySelector(".summary-container");

    if (cartValueContainer) {
        cartValueContainer.textContent = "Wartość koszyka: " + cartValue + " zł.";
    }
}


function updateProductAmount(productId, newAmount) {
    const productIndex = product.findIndex(item => item.id === productId);
    if (productIndex !== -1) {
        product[productIndex].amount = newAmount; // Zaktualizuj ilość produktu
    }
}

function setProductList() {
    const root = document.getElementById("mini-cart");
    root.innerHTML = ''; // Wyczyszczenie koszyka przed dodaniem nowych elementów
    let totalItems = product.length;

    const cartCountElement = document.createElement("p");
    cartCountElement.id = "cart-count";
    cartCountElement.textContent = `Twój koszyk: ` + totalItems;
    root.appendChild(cartCountElement);

    product.forEach(element => {
        let cartContainer = document.createElement("div");
        cartContainer.classList.add("cart-item-container");

        let topContainer = document.createElement("div");
        topContainer.classList.add("item-top-container");

        let bookImg = document.createElement("img");
        bookImg.classList.add("book-img");
        bookImg.src = element.img;

        let itemPriceContainer = document.createElement("div");
        itemPriceContainer.classList.add("item-price-container");

        let itemPrice = document.createElement("p");
        itemPrice.classList.add("item-price");
        itemPrice.textContent = element.price + " zł.";

        let itemLabel = document.createElement("p");
        itemLabel.classList.add("item-label");
        itemLabel.textContent = element.label;

        let itemPriceWithTax = document.createElement("p");
        itemPriceWithTax.classList.add("item-price-with-tax");
        itemPriceWithTax.textContent = "Cena z VAT 23%: " + element.price + " zł.";

        let descriptionContainer = document.createElement("div");
        descriptionContainer.classList.add("item-description-container");

        let itemDescriptionNameContainer = document.createElement("p");
        itemDescriptionNameContainer.classList.add("item-description");
        itemDescriptionNameContainer.textContent = element.name;

        let itemDescriptionAuthorContainer = document.createElement("p");
        itemDescriptionAuthorContainer.classList.add("item-description");
        itemDescriptionAuthorContainer.textContent = element.author;

        let itemDescriptionPublisherContainer = document.createElement("p");
        itemDescriptionPublisherContainer.classList.add("item-description");
        itemDescriptionPublisherContainer.textContent = element.publisher;

        let itemDescriptionGenreContainer = document.createElement("p");
        itemDescriptionGenreContainer.classList.add("item-description");
        itemDescriptionGenreContainer.textContent = element.genre;

        fetch(`./Components/amoun-in-cart-paticular-item.php?id=${element.id}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(html => {
                // Dodajemy pobrany HTML z przyciskami do kontenera
                topContainer.innerHTML += html;

                // Po dodaniu HTML wyszukujemy przyciski i dodajemy `EventListener`
                const increaseButton = topContainer.querySelector(`.increase`);
                const decreaseButton = topContainer.querySelector(`.decrease`);
                const amountInput = topContainer.querySelector(`#amount-display-${element.id}`);

                // Event listener dla zwiększenia ilości
                if (increaseButton) {
                    increaseButton.addEventListener("click", () => {
                        updateProductAmount(element.id, newAmount);
                        updateCartValue();
                    });
                }

                // Event listener dla zmniejszenia ilości
                if (decreaseButton) {
                    decreaseButton.addEventListener("click", () => {
                        updateProductAmount(element.id, newAmount);
                        updateCartValue();
                    });
                }

                // Event listener dla zmiany wartości w `amountInput`
                if (amountInput) {
                    amountInput.addEventListener("input", () => {
                        const newAmount = Math.max(1, parseInt(amountInput.value)) || 1; // Minimalna ilość to 1
                        updateProductAmount(element.id, newAmount);
                        updateCartValue();
                    });
                }
            })
            .catch(error => console.error('Error:', error));

        itemPriceContainer.appendChild(itemPrice);
        itemPriceContainer.appendChild(itemLabel);
        itemPriceContainer.appendChild(itemPriceWithTax);

        topContainer.appendChild(bookImg);
        topContainer.appendChild(itemPriceContainer);

        descriptionContainer.appendChild(itemDescriptionAuthorContainer);
        descriptionContainer.appendChild(itemDescriptionPublisherContainer);
        descriptionContainer.appendChild(itemDescriptionGenreContainer);
        descriptionContainer.appendChild(itemDescriptionNameContainer);

        cartContainer.appendChild(topContainer);
        cartContainer.appendChild(descriptionContainer);
        root.appendChild(cartContainer);
    });

    renderCartSummary(root); // Renderowanie podsumowania koszyka
    renderOrderButton(root); // Renderowanie przycisku zamawiania
}

function renderCartSummary(root) {
    let cartValue = product.reduce((acc, obj) => acc + (parseInt(obj.price) * parseInt(obj.amount)), 0);

    let cartValueContainer = document.createElement("p");
    cartValueContainer.classList.add("summary-container");
    cartValueContainer.textContent = "Wartość koszyka: " + cartValue + " zł.";
    root.appendChild(cartValueContainer);
}

function renderOrderButton(root) {
    let orderButtonContainer = document.createElement("div");
    orderButtonContainer.classList.add("order-button-container");

    let orderButton = document.createElement("input");
    orderButton.classList.add("order-button");
    orderButton.type = "submit";
    orderButton.value = "ZAMAWIAM";

    orderButtonContainer.appendChild(orderButton);
    root.appendChild(orderButtonContainer);
}
document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll('.button-container'); // Zmienna musi być zgodna z klasą kontenera przycisków

    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const form = this.closest('form');
            if (form) {
                const formData = new FormData(form);
                fetch('/API/post-product-to-cart.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.status === 'success') {
                            // Dodaj nowy produkt do lokalnej tablicy
                            const newProduct = {
                                id: data.product_id,
                                label: data.product_label,
                                author: data.product_author,
                                price: data.product_price,
                                img: data.product_image,
                                genre: data.product_genre,
                                amount: 1 // Domyślna ilość
                            };

                            // Sprawdź, czy produkt już istnieje w tablicy
                            const existingProductIndex = product.findIndex(item => item.id === newProduct.id);
                            if (existingProductIndex !== -1) {
                                product[existingProductIndex].amount += 1; // Zwiększ ilość
                            } else {
                                product.push(newProduct); // Dodaj nowy produkt
                            }

                            // Zaktualizuj widok koszyka
                            setProductList();
                            updateCartValue();
                        } else {
                            console.error('Błąd:', data.message);
                        }
                    })
                    .catch(error => console.error('Wystąpił błąd:', error));
            }
        });
    });
});


function loadCart() {
    const cartContainer = document.getElementById("mini-cart");
    cartContainer.innerHTML = ''; // Wyczyść koszyk

    fetch('/API/get-cart.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })

        .catch(error => console.error('Error fetching cart:', error));
}



