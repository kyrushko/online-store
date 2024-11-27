<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
    <style>
        .pass{
            width: 40%;
        }
    </style>
</head>
<body>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['password'];
    if ($password === "WeKnowTheGame24") {
        echo '<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
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
                    <a class="nav-link" href="#">Admin panel</a>
                </li>
            </ul>
        </div>
    </div>
</nav>';
//Connect to MySQL
        $host = "";
        $user = "";
        $pass = "";
        $dbname = $user;
        $conn = new mysqli($host, $user, $pass, $dbname);
        $sql = "SELECT * FROM `Orders`";//note do not have `abc01234`. in front of the table name if you used $dbname to connect
        $result = $conn->query($sql);
        echo '<div class="row d-flex justify-content-center container">';
        echo '<div class="col-md-8">';
        echo '<h2 class="text-center mt-4 mb-3">Manage my orders: </h2>';
        while ($row = $result->fetch_assoc()) {
            echo '
                <div class="row order d-flex justify-content-center align-items-center mt-2" id="order-row-'.$row["id"].'">
                    <div class="col-auto id text-center" >'.$row["id"].'</div>
                    <div class="col-auto date text-center">'.$row["date"].'</div>
                    <div class="col-auto name text-center">'.$row["name"].'</div>
                    <div class="col-auto address text-center">'.$row["address"].'</div>
                    <div class="col-auto art_name text-center">'.$row["art_name"].'</div>
                    <div class="col-auto amount text-center">'.$row["amount"].'</div>
                    <div class="col-auto amount text-center">
                     <form method="POST" action="delete_order.php">
                        <input type="hidden" name="delete_id" value="'.$row["id"].'">
                         <button type="button" class="btn btn-danger btn-sm" onclick="deleteOrder('.$row["id"].', \''.$row["art_name"].'\')">Delete</button>
                    </form>
                    </div>
                </div>
            ';
        }
        echo '</div>';
        echo '<div class="col-md-4 mt-4 mb-3">';
        echo '<h2>Add New Item</h2>';
        echo '
    <form action="add_item.php" method="post" class="p-3 border rounded" enctype="multipart/form-data" id="addItemForm">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" required>
        </div>
        <div class="mb-3">
            <label for="width" class="form-label">Width</label>
            <input type="number" class="form-control" id="width" name="width" required>
        </div>
        <div class="mb-3">
            <label for="height" class="form-label">Height</label>
            <input type="number" class="form-control" id="height" name="height" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea type="number" class="form-control" id="description" rows="3" name="description" ></textarea>
        </div>
           <div class="mb-3">
            <label for="file" class="form-label">Attach a picture</label>
            <input type="file" class="form-control" id="file" name="file"  accept="image/*"required>
        </div>
        <button type="submit" id="response" class="btn btn-success">Add Item</button>
    </form>
';
        echo '</div>'; // Close col-md-4
        echo '</div>';
        $conn->close();
    }
}else{

    echo "<div class='row pass'>
                <form action='admin.php' method='post' class='d-flex'>
                    <input type='password' name='password' class='form-control me-2' placeholder='Password'>
                    <button type='submit' class='btn btn-success'>Send</button>
                </form>
            </div>";
}
?>

<script src="public/store.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
