<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home page</title>
    <link rel="stylesheet" href="public/store.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <div class="col-lg-4 text-center">
            <h2><a class="navbar-brand " href="#"> <span class="logo">The Painted Palette</span></a></h2>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse col-lg-8" id="navbarNav">
            <ul class="navbar-nav w-100 d-flex justify-content-around">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Art</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Get in touch</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php" class="cart"><i class="bi bi-basket"></i> <div id="countCart"></div>

                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin.php">Log in</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="body">
    <div class="banner container main_msg">
        <div class="row align-items-center">
            <div class="col-md-12 col-sm-12 col-12 col-lg-7 text-center align-middle">
                <h1>Hello! My name is Cara. <br> Feel free to explore your next artpiece here!</h1>
                <div class="container1 ">
                    <?php
                    $host = "devweb2024.cis.strath.ac.uk";
                    $user = "qrb23133";
                    $pass = "aaS9heith6to";
                    $dbname = $user;
                    $conn = new mysqli($host, $user, $pass, $dbname);
                    $sql = "SELECT `image` FROM `Art` where `id` = 1";//note do not have `abc01234`. in front of the table name if you used $dbname to connect
                    $result = $conn->query($sql);


                    // Checking the connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT `image`, `name` FROM `Art` WHERE `id` = 1";
                    $result = $conn->query($sql);

                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            // No need for header, as we are embedding base64-encoded data
                            echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" alt="' . htmlspecialchars($row['name']) . '" width="320px" height="240px" class="cara_img mt-3" > ';
//                            echo ' <div class="overlay"> <div class="text">'."Let's go shopping?".'</div> </div>';
                        }
                    } else {
                        echo "No image found.";
                    }

                    $conn->close();



                    ?>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-12 col-lg-5 text-center align-middle fs-3">
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        <p>"It is the thrill of bringing a blank canvas to life, witnessing a vision materialize
                            stroke by stroke, is a source of immense joy and satisfaction".</p>
                        <footer class="blockquote-footer"><cite title="Source Title">Why do you enjoy art so much?</cite></footer>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-3 mt-5">
        <div class="row justify-content-end">

            <div class="col-auto">
                <select id="sortDropdown" class="form-select w-auto ">
                    <option value="default" selected>Sort by:</option>
                    <option value="status">Sort by Status (For Sale First)</option>
                    <option value="priceAsc">Sort by Price (Low to High)</option>
                    <option value="priceDesc">Sort by Price (High to Low)</option>
                    <option value="name">Sort by Name</option>
                </select>
            </div>
        </div>
    </div>


    <div class="container text-center product">
        <div class="row align-items-center">
            <?php
            $host = "devweb2024.cis.strath.ac.uk";
            $user = "qrb23133";
            $pass = "aaS9heith6to";
            $dbname = $user;
            $conn = new mysqli($host, $user, $pass, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            // Define pagination variables
            $limit = 12 ;  // Number of items per page
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Get the current page or set default to 1
            $offset = ($page - 1) * $limit;

            // Get total count of items for pagination calculation
            $total_query = "SELECT COUNT(*) FROM Art WHERE id>=2";
            $total_result = $conn->query($total_query);
            $total_row = $total_result->fetch_row();
            $total_records = $total_row[0];
            $total_pages = ceil($total_records / $limit);

            // Fetch the current page of items from the database
            $sql = "SELECT `id`, `image`, `name`, `status`, `price`, `description` FROM `Art` WHERE id>=2 LIMIT $limit OFFSET $offset";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Set the data-status, data-name, and data-price for sorting
                    echo '<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-4 clearfix"
                data-price="' . $row['price'] . '" 
                data-name="' . htmlspecialchars($row['name']) . '" 
                data-status="' . $row['status'] . '">';
                    $encodedImage = base64_encode($row['image']);
                    $imageSrc = 'data:image/jpeg;base64,' . $encodedImage;
                    echo '<div class="card h-100 d-flex flex-column">';
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" alt="' . htmlspecialchars($row['name']) . '" class="img-fluid mt-3 img_hover" style="width: 100%; height: auto; aspect-ratio: 4 / 3; object-fit: contain;" onclick="getArt(\'' . $row['price'] . '\', \'' . $row['name'] . '\', \'' . $imageSrc . '\', \'' . $row['id'] . '\', \'' . $row['description'] . '\')">';
                    //       echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" alt="' . htmlspecialchars($row['name']) . '" class="img-fluid mt-3" style="width: 100%; height: auto; aspect-ratio: 4 / 3; object-fit: contain;"  onclick="getArt(\'' . $row['price'] . '\', \'' . $row['name'] . '\', \'' . $imageSrc . '\')">';
                    echo '<div class="card-body d-flex flex-column justify-content-between">';
                    echo '<p class="name text-center">' . htmlspecialchars($row['name']) . '</p>';
                    echo '<p class="name text-center">$' . htmlspecialchars($row['price']) . '</p>';

                    if ($row['status'] == "for sale") {
                        echo '<button class="btn btn-success add-to-cart" onclick="addToCart(\'' . $row['id'] . '\', \'' . htmlspecialchars($row['name']) . '\', \'' . htmlspecialchars($row['price']) . '\')">Add to Cart</button>';
                    } else {
                        echo '<button class="btn btn-danger" disabled>Sold</button>';
                    }
                    echo '</div>';
                    echo '</div>'; // Close card
                    echo '</div>'; // Close column
                }
            } else {
                echo "No image found.";
            }
            $conn->close();
            ?>
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                    <li class="page-item"><a class="page-link" href="?page=<?= $page - 1 ?>">Previous</a></li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item<?= $i == $page ? ' active' : '' ?>"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                    <li class="page-item"><a class="page-link" href="?page=<?= $page + 1 ?>">Next</a></li>
                <?php endif; ?>
            </ul>
        </nav>
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
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
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

<script src="public/store.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>