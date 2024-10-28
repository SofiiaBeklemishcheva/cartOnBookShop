let product =[
    {
        img: 'Universal/harry-potter-and-the-philosopher-stone.jpg',
        label: 'Harry Potter',
        price: '100',
        name: 'Harry Potter',
        author: 'J.K.Rowling',
        publisher: 'XXX',
        genre: 'Fantasy',
        amount: '2',
        id: '1'
    },
    {
        img: 'Universal/harry-potter-and-the-philosopher-stone.jpg',
        label: 'Harry Potter',
        price: '100',
        name: 'Harry Potter',
        author: 'J.K.Rowling',
        publisher: 'XXX',
        genre: 'Fantasy',
        amount: '2',
        id: '2'
    },
    {
        img: 'Universal/harry-potter-and-the-philosopher-stone.jpg',
        label: 'Harry Potter',
        price: '100',
        name: 'Harry Potter',
        author: 'J.K.Rowling',
        publisher: 'XXX',
        genre: 'Fantasy',
        amount: '2',
        id: '3'
    }
]


function setProductList(){
   const root = document.getElementById("mini-cart") ;
    let totalItems = product.length;

    const cartCountElement = document.createElement("p");
    cartCountElement.id = "cart-count";
    cartCountElement.textContent = `Twój koszyk: ` + totalItems;
    root.appendChild(cartCountElement);
   product.forEach( (element)=>{

       let cartContainer = document.createElement("div")
       cartContainer.classList.add("cart-item-container")

       let topContainer = document.createElement("div")
       topContainer.classList.add("item-top-container")

       let bookImg = document.createElement("img")
       bookImg.classList.add("book-img")
       bookImg.src = element.img

       let itemPriceContainer = document.createElement("div")
       itemPriceContainer.classList.add("item-price-container")

       let itemPrice = document.createElement("p")
       itemPrice.classList.add("item-price")

       let itemPriceText = document.createTextNode(element.price + " zł.")
       itemPrice.appendChild(itemPriceText)

       let itemLabel = document.createElement("p")
       itemLabel.classList.add("item-label")
       let itemLabelText = document.createTextNode(element.label)
       itemLabel.appendChild(itemLabelText)

       let itemPriceWithTax = document.createElement("p")
       itemPriceWithTax.classList.add("item-price-with-tax")

       let itemPriceWithTaxText = document.createTextNode("Cena z VAT 23%:" + " " + element.price + "zł.")
       itemPriceWithTax.appendChild(itemPriceWithTaxText)

       let descriptionContainer = document.createElement("div")
       descriptionContainer.classList.add("item-description-container")

       let itemDescriptionNameContainer = document.createElement("p")
       itemDescriptionNameContainer.classList.add("item-description")

       let itemDescriptionName = document.createTextNode(element.name)
       itemDescriptionNameContainer.appendChild(itemDescriptionName)

       let itemDescriptionAuthorContainer = document.createElement("p")
       itemDescriptionAuthorContainer.classList.add("item-description")

       let itemDescriptionAuthor = document.createTextNode(element.author)
       itemDescriptionAuthorContainer.appendChild(itemDescriptionAuthor)

       let itemDescriptionPublisherContainer = document.createElement("p")
       itemDescriptionPublisherContainer.classList.add("item-description")

       let itemDescriptionPublisher = document.createTextNode(element.publisher)
       itemDescriptionPublisherContainer.appendChild(itemDescriptionPublisher)

       let itemDescriptionGenreContainer = document.createElement("p")
       itemDescriptionGenreContainer.classList.add("item-description")

       let itemDescriptionGenre = document.createTextNode(element.genre)
       itemDescriptionGenreContainer.appendChild(itemDescriptionGenre)

       fetch(`./Components/amoun-in-cart-paticular-item.php?id=${element.id}`)
           .then(response => {
               if (!response.ok) {
                   throw new Error('Network response was not ok');
               }
               return response.text();
           })
           .then(html => {
               topContainer.innerHTML += html;
           })
           .catch(error => console.error('Error:', error));

       itemPriceContainer.appendChild(itemPrice)
       itemPriceContainer.appendChild(itemLabel)
       itemPriceContainer.appendChild(itemPriceWithTax)

       topContainer.appendChild(bookImg)
       topContainer.appendChild(itemPriceContainer)

       itemDescriptionAuthorContainer.appendChild(itemDescriptionAuthor)
       itemDescriptionPublisherContainer.appendChild(itemDescriptionPublisher)
       itemDescriptionGenreContainer.appendChild(itemDescriptionGenre)
       itemDescriptionNameContainer.appendChild(itemDescriptionName)

       descriptionContainer.appendChild(itemDescriptionAuthorContainer)
       descriptionContainer.appendChild(itemDescriptionPublisherContainer)
       descriptionContainer.appendChild(itemDescriptionGenreContainer)
       descriptionContainer.appendChild(itemDescriptionNameContainer)


       cartContainer.appendChild(topContainer)
       cartContainer.appendChild(descriptionContainer)
       root.appendChild(cartContainer)


   });
    let cartValue = product.reduce(function (acc, obj) { return acc + parseInt(obj.price); }, 0);

    let cartValueContainer = document.createElement("p");
    cartValueContainer.classList.add("summary-container");
    cartValueContainer.textContent = "Wartość koszyka: " + cartValue + " zł.";
    root.appendChild(cartValueContainer);

    let orderButtonContainer = document.createElement("div");
    orderButtonContainer.classList.add("order-button-container");

    let orderButton = document.createElement("input");
    orderButton.classList.add("order-button");
    orderButton.type = "submit";
    orderButton.value = "ZAMAWIAM";

    orderButtonContainer.appendChild(orderButton);

    root.appendChild(orderButtonContainer);
}