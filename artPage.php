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
        #imageDisplay img{
            max-height: 500px;  /* Ensure the image height does not exceed 750px */
            width: auto;        /* Automatically adjust the width to maintain the aspect ratio */
            height: auto;
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
<div> <button class="btn btn-secondary m-2" onclick=" window.location.href='index.php'">Back</button></div>
<div class="container mt-4 mb-4">
    <div class="row text-center">
        <div id="imageDisplay" class="col-sm-12 col-md-6"></div>
        <div class="col-sm-12 col-md-6 pt-5 pt-5">
            <div class=" data justify-content-start d-flex">
                <div class=""><h2>Name:  </h2> </div>
                <div class=""> <h2 id="artName"></h2></div>
            </div>
            <div class="data justify-content-start d-flex mt-2">
                <div class=""><h3>Price:   </h3> </div>
                <div ><h3 id="artPrice"></h3></div>
            </div>

            <div class="data row mt-2 text-start">
                <div class="col-sm-12 col-md-4"><h4>Description: </h4></div>
                <div class="pl-2 col-sm-12 col-md-8 "><span id="desc"></span></div>
            </div>
            <div class="data d-flex justify-content-start ">
                <button class=" mt-3 btn btn-success add-to-cart" id="addToCartButton">Add to Cart</button>
            </div>

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
    document.addEventListener("DOMContentLoaded", function() {
        updateCartDisplay();
        const price = localStorage.getItem('artPrice');
        const name = localStorage.getItem('artName');
        const imageSrc = localStorage.getItem('artImage');
        const id = localStorage.getItem('id');
        const desc = localStorage.getItem('artDescription');
        if (price && name && imageSrc && id && desc) {
            document.getElementById("artName").textContent = name;
            document.getElementById("artPrice").textContent = `$${price}`;
            document.getElementById("desc").textContent = `${desc}`;
            document.getElementById("imageDisplay").innerHTML = `<img src="${imageSrc}" alt="${name}" class="img-fluid">`;
        }
        document.getElementById("addToCartButton").addEventListener('click', function() {
            addToCart( id, name, price);
        });
    });

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>