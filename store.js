function addToCart(id, name, price) {
    // Get the cart from cookies
    let cart = JSON.parse(getCookie("cart") || "[]");
    var button = event.target;
    // Disable the button
    button.disabled = true;
    // Check if the item is already in the cart
    let existingItem = cart.find(item => item.id === id);
    if (existingItem) {
        alert("Item already exists!");
    } else {
        // Add new item if it doesn't exist in cart
        cart.push({ id: id, name: name, price: price, quantity: 1 });
        alert(name + " has been added to the cart!");
    }

    // Save updated cart to cookies
    setCookie("cart", JSON.stringify(cart), 7); // Expires in 7 days
    console.log(cart);
    updateCartDisplay();
}
// function countCartItems() {
//     let cart = JSON.parse(getCookie("cart") || "[]");
//     // Sum up the quantity of all items in the cart
//     let totalItems = cart.reduce((total, item) => total + item.quantity, 0);
//     console.log(`Total items in cart: ${totalItems}`);
//     return totalItems;
// }
// Set cookie function
function setCookie(name, value, days) {
    let expires = "";
    if (days) {
        let date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

// Get cookie function
function getCookie(name) {
    let nameEQ = name + "=";
    let ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) === ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}


// Wait for the DOM to be fully loaded before executing JS
document.addEventListener('DOMContentLoaded', function () {
    const cardsContainer = document.querySelector('.container.text-center.product .row');
    const cards = Array.from(cardsContainer.children);

    // Add event listener to the dropdown
    document.getElementById('sortDropdown').addEventListener('change', function () {
        const selectedValue = this.value;

        let sortedCards;

        if (selectedValue === 'priceAsc') {
            sortedCards = cards.sort(function (a, b) {
                return parseFloat(a.getAttribute('data-price')) - parseFloat(b.getAttribute('data-price'));
            });
        } else if (selectedValue === 'priceDesc') {
            sortedCards = cards.sort(function (a, b) {
                return parseFloat(b.getAttribute('data-price')) - parseFloat(a.getAttribute('data-price'));
            });
        } else if (selectedValue === 'name') {
            sortedCards = cards.sort(function (a, b) {
                const nameA = a.getAttribute('data-name').toLowerCase();
                const nameB = b.getAttribute('data-name').toLowerCase();
                return nameA.localeCompare(nameB);
            });
        } else if (selectedValue === 'status') {
            sortedCards = cards.sort(function (a, b) {
                const statusA = a.getAttribute('data-status').toLowerCase();
                const statusB = b.getAttribute('data-status').toLowerCase();

                // Sort "for sale" first, then "sold"
                if (statusA === 'for sale' && statusB === 'sold') {
                    return -1;
                } else if (statusA === 'sold' && statusB === 'for sale') {
                    return 1;
                }
                return 0; // If both statuses are the same, no change in order
            });
        }

        updateCards(sortedCards);
    });

    // Helper function to update the card order in the DOM
    function updateCards(sortedCards) {
        // Clear the current container
        cardsContainer.innerHTML = '';

        // Append the sorted cards back to the container
        sortedCards.forEach(function (card) {
            cardsContainer.appendChild(card);
        });
    }
});
function removeFromCart(name) {
    // Get the cart from cookies
    let cart = JSON.parse(getCookie("cart") || "[]");

    // Find the item in the cart by name
    let itemIndex = cart.findIndex(item => item.name === name);

    if (itemIndex !== -1) {
        // Decrease the quantity if more than 1, otherwise remove the item
        if (cart[itemIndex].quantity > 1) {
            cart[itemIndex].quantity -= 1;
        } else {
            // Remove the item if quantity is 1
            cart.splice(itemIndex, 1);
        }

        // Save updated cart to cookies
        setCookie("cart", JSON.stringify(cart), 7); // Expires in 7 days

        alert(name + " has been removed from the cart.");
    } else {

        alert(name + " is not in the cart.");
    }

    console.log(cart); // Log updated cart for debugging
    displayCart(); // Optional: Update the UI if you're displaying the cart dynamically
    updateCartDisplay();
}
function countCartItems() {
    let cart = JSON.parse(getCookie("cart") || "[]");
    // Sum up the quantity of all items in the cart
    let totalItems = cart.reduce((total, item) => total + item.quantity, 0);
    console.log(`Total items in cart: ${totalItems}`);
    return totalItems;
}
function updateCartDisplay() {
    const totalItems = countCartItems(); // Get the total items in the cart
    const cartNumberElement = document.getElementById("countCart"); // The span or element displaying the cart count
    cartNumberElement.textContent = totalItems; // Update its text content
}
document.addEventListener("DOMContentLoaded", function () {
    updateCartDisplay(); // Ensure the cart count is accurate when the page loads
});

function clearCart() {
    setCookie("cart", "[]", -1); // Expire immediately
    displayCart();
    updateCartDisplay();
    alert("Cart has been cleared.");
}

function displayCart() {
    let cart = JSON.parse(getCookie("cart") || "[]");
    let cartItems = document.getElementById("cartItems");
    if (cart.length === 0) {
        cartItems.innerHTML = "<p>Your cart is empty.</p>";
    } else {
        cartItems.innerHTML = cart.map(item => `
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">${item.name}</h5>
                    <p class="card-text">Price: $${item.price}</p>
                    <p class="card-text">Quantity: ${item.quantity}</p>
            <button class="btn btn-secondary" onclick="removeFromCart('${item.name.replace(/'/g, "\\'")}')">Remove from cart</button>
                </div>
            </div>
        `).join('');
        countCartItems();
    }
    if(countCartItems() == 0){
        document.getElementsByClassName("wrapper")[0].style.display = "none";
        document.getElementsByClassName("noCart")[0].style.display = "block";
    }else{
        document.getElementsByClassName("wrapper")[0].style.display = "block";
        document.getElementsByClassName("noCart")[0].style.display = "none";
    }
}
function countAmount() {
    // Retrieve the cart from cookies and parse it into an array
    let cart = JSON.parse(getCookie("cart") || "[]");
    // Calculate the total amount by summing the price * quantity for each item
    let amount = cart.reduce((total, item) => {
        return total + (item.price * item.quantity);
    }, 0);
    // Log the total amount to the console
    return amount;
}
function deleteOrder(orderId, names) {
    fetch('delete_order.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: orderId, names: names }),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Order deleted successfully');
                document.getElementById(`order-row-${orderId}`).remove(); // Remove the row from DOM
            } else {
                alert('Error deleting order: ' + data.error);
            }
        })
        .catch(error => console.error('Error:', error));
}

document.getElementById('addItemForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission

    const formData = new FormData(this); // Gather form data

    fetch('add_item.php', {
        method: 'POST',
        body: formData,
    })
        .then(response => response.json())
        .then(data => {
            const responseDiv = document.getElementById('response');
            if (data.success) {
                this.reset();
                window.alert("New item added successfully!");
            } else {
                // responseDiv.innerHTML = `<p style="color:red;">${data.error}</p>`;
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
});
function getArt(price, name, imageSrc, id, description) {
    // Ensure that the data is being stored in localStorage
    console.log('Storing art:', price, name, imageSrc);  // Check the values being stored
    localStorage.setItem('artPrice', price);
    localStorage.setItem('artName', name);
    localStorage.setItem('artImage', imageSrc);
    localStorage.setItem('artDescription', description);
    localStorage.setItem('id', id);

    // Open the art details page in a new tab
    window.open('artPage.php', '_blank');
};