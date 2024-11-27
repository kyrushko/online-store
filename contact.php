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
                    <a class="nav-link" href="#">Get in touch</a>
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

<div class="noCart container text-center">

    <div class="text-center"><h3>Enquire about an art piece</h3></div>
    <form action="message.php" method="POST" class="container" id="cartForm">
        <input type="hidden" id="cartData" name="cartData" value="">
        <div class="row mb-3 align-items-center">
            <label class="col-3 col-md-3 col-form-label text-end" for="name">Name:</label>
            <div class="col-9 col-md-6">
                <input type="text" class="form-control" id="name" name="name" placeholder="John Doe" required>
            </div>
            <div class="col-md-3"></div>
        </div>
        <div class="row mb-3 align-items-center">
            <label class="col-md-3 col-3 col-form-label text-end" for="email">Email:</label>
            <div class="col-md-6 col-9">
                <input type="email" class="form-control" id="email" name="email" placeholder="example@info.com" required>
            </div>
            <div class="col-md-3"></div>
        </div>
        <div class="row mb-3 align-items-center">
            <label class="col-md-3 col-3 col-form-label text-end" for="phone">Phone:</label>
            <div class="col-md-6 col-9">
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="1234 123 123">
            </div>
            <div class="col-md-3"></div>
        </div>
        <div class="row mb-3 align-items-center">
            <label class="col-md-3 col-3 col-form-label text-end" for="comments">Your message:</label>
            <div class="col-md-6 col-9">
                <textarea class="form-control" id="comments" name="comments" placeholder="Type your message here..."></textarea>
            </div>
            <div class="col-md-3"></div>
        </div>
        <button type="submit" class="btn btn-info" onclick="alert('Message sent!')">Send!</button>
    </form>
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
                    <li><a href="#">Contact</a></li>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>