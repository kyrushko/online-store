<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="public/store.js"></script>
    <title>Home page</title>
    <link rel="stylesheet" href="public/store.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        html, body {
            height: 100%;
        }
        .wrapper {
            min-height: 100%;
            display: flex;
            flex-direction: column;
        }
        .content {
            flex-grow: 1;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 10px;
            text-align: center;
        }
        .noCart{
            display: none;
            height: 66vh;
            align-content: center;
            align-items: center;
        }
    </style>
</head>
<body>
<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <div class="col-lg-4 text-center">
            <h2><a class="navbar-brand " href="index.php"> <span class="logo">The Painted Palette</span></a></h2>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse col-lg-8" id="navbarNav">
            <ul class="navbar-nav w-100 d-flex justify-content-around">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Art</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Get in touch</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php"><i class="bi bi-basket"></i> <div id="countCart"></div></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin.php">Log in</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="noCart container text-center"><h1>There are no things here. Let's buy some art!</h1></div>
<div class="wrapper mb-3">
    <div class="content">
        <div class="container">
            <div class="container text-center mt-5">
                <h2>Your Shopping Cart</h2>
                <div id="cartItems" class="mt-4"></div>
                <div> <h3 id="total"></h3></div>
                <button onclick="clearCart()" class="btn btn-danger mt-4">Clear Cart</button>
            </div>
        </div>
        <div class="text-center container mt-5"><h3>Let's finalize your order:</h3></div>
        <div class="text-center container">
            <form action="order.php" method="POST" class=" container" id = "cartForm">
                <input type="hidden" id="cartData" name="cartData">
                <div class="row mb-3 align-items-center">
                    <label class="col-3 col-md-3 col-form-label text-end" for="name">Name:</label>
                    <div class="col-9  col-md-6">
                        <input type="text" class="form-control" id="name" name="name" placeholder="FirstName LastName">
                    </div>
                    <div class="col-md-3"></div>
                </div>

                <div class="row mb-3 align-items-center">
                    <label class="col-md-3 col-3 col-form-label text-end" for="address">Address:</label>
                    <div class="col-md-6 col-9">
                        <input type="text" class="form-control" id="address" name="address" placeholder="51 Dalmarnock Road, Glasgow">
                    </div>
                    <div class="col-md-3"></div>
                </div>

                <div class="row mb-3 align-items-center">
                    <label class="col-md-3 col-3  col-form-label text-end" for="email">Email:</label>
                    <div class="col-md-6 col-9">
                        <input type="email" class="form-control" id="email" name="email" placeholder="example@gmail.com">
                    </div>
                    <div class="col-md-3"></div>
                </div>
                <div class="row mb-3 align-items-center">
                    <label class="col-md-3 col-3  col-form-label text-end" for="email">Phone:</label>
                    <div class="col-md-6 col-9">
                        <input type="phone" class="form-control" id="phone" name="phone" placeholder="1234 123 123">
                    </div>
                    <div class="col-md-3"></div>
                </div>
                <div class="row mb-3 align-items-center">
                    <label class="col-md-3 col-3 col-form-label text-end " for="comments">Additional Comments:</label>
                    <div class="col-md-6 col-9">
                        <textarea type="textarea" class="form-control" id="comments" name="comments"></textarea>
                    </div>
                    <div class="col-md-3"></div>
                </div>
                <button class="btn btn-success">Finish order</button>
            </form>
        </div>
    </div>
</div>

<footer class="footer bg-dark text-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                 
                <h5>About Us</h5>
                <p class="text-start">With her paint-streaked apron and ever-present coffee mug, Cara is the soul of the store. She’s always ready to give advice, recommend a product, or just chat about art and life. Customers often come back, not just for supplies, but for her infectious enthusiasm and encouragement.</p>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">  

                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="index.php">About</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12 text-center">
                <p>&copy; 2024 Nikita Kyrushko's design and implementation. No rights reserved.</p>
            </div>
        </div>
    </div>
</footer>
<script>
    displayCart();
    if(countCartItems() == 0){
        document.getElementsByClassName("wrapper")[0].style.display = "none";
        document.getElementsByClassName("noCart")[0].style.display = "block";
    }else{
        document.getElementsByClassName("wrapper")[0].style.display = "block";
        document.getElementsByClassName("noCart")[0].style.display = "none";
    }
    document.getElementById("total").innerHTML = "Total is: "+ countAmount();
    document.getElementById("cartForm").addEventListener("submit", function (event) {
        // Get the cart data from the cookie
        let cartData = getCookie("cart");

        // Set the hidden input's value to the cart data
        document.getElementById("cartData").value = cartData || "[]"; // Default to an empty array if no cookie is found
    });

    document.addEventListener("DOMContentLoaded", function () {
        updateCartDisplay(); // Ensure the cart count is accurate when the page loads
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>