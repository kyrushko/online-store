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
    <script>
        setTimeout(function() {
            window.location.href = "https://devweb2024.cis.strath.ac.uk/~qrb23133/cw2/";
        }, 4000);
    </script>
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
        .yesCart{
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
                    <a class="nav-link" href="#">Log in</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php
$host = "devweb2024.cis.strath.ac.uk";
$user = "qrb23133";
$pass = "aaS9heith6to";
$dbname = $user;
$conn = new mysqli($host, $user, $pass, $dbname);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $comments = $_POST['comments'];
    $cartData = $_POST['cartData'];
    $cart = json_decode($cartData, true); // Decode the JSON cart data into an array
    $art_ids = "";
    $amount=0;

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement for the orders table
    $sql = "INSERT INTO `Orders`(`date`, `name`, `address`, `art_name`, `amount`) VALUES (?, ?, ?, ?, ?)";
    $orderStmt = $conn->prepare($sql);

    if (!$orderStmt) {
        die("Failed to prepare statement: " . $conn->error);
    }

    // Get the current date and time for the order
    $ord_date = date('Y-m-d H:i:s');

    // Loop through each item in the cart and insert it into the database
    foreach ($cart as $item) {
        $art_ids .= $item['name'].", ";
        $amount += $item['price'];
    }
    // Bind the parameters for each iteration (order)
    $orderStmt->bind_param("ssssi", $ord_date, $name, $address, $art_ids, $amount);

    // Execute the prepared statement
    if (!$orderStmt->execute()) {
        echo "Error executing statement: " . $orderStmt->error;
    }
    $sql1 = "UPDATE `Art` SET `status` ='sold' WHERE `id` = ?";
    $orderStmt1 = $conn->prepare($sql1);
    if (!$sql1) {
        die("Error executing statement: " . $conn->error);
    }
    foreach ($cart as $item) {
        $id  = $item['id'];
        $orderStmt1 -> bind_param("i", $id);
        $orderStmt1 -> execute();
    }
    // Close the prepared statement
    $orderStmt->close();
    $orderStmt1->close();

    // Close the database connection
    $conn->close();

    echo "<div class='yesCart container text-center'><h1>Order placed successfully! <br> You will be redirected to the main page in 5 seconds</h1></div>";
}
?>

<script>  clearCart();
</script>
<footer class="footer bg-dark text-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                 
                <h5>About Us</h5>
                <p>Lorem ipsum dolor sit amet, consectetur  
                    adipiscing elit.</p>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">  

                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
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