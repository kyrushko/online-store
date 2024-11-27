
<?php

$host = "";
$user = "";
$pass = "";
$dbname = $user;

// Database connection
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'error' => 'Connection failed: ' . $conn->connect_error]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $price = floatval($_POST['price']);
    $width = floatval($_POST['width']);
    $height = floatval($_POST['height']);
    $description = trim($_POST['description']);

    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileContent = file_get_contents($fileTmpPath);

        $sql_add = "INSERT INTO `Art` (name, width, height, price, description, image, status) VALUES (?, ?, ?, ?, ?, ?, 'for sale')";
        $stmt = $conn->prepare($sql_add);

        if (!$stmt) {
            echo json_encode(['success' => false, 'error' => 'Prepare failed: ' . $conn->error]);
            exit;
        }

        $stmt->bind_param("sdddss", $name, $width, $height, $price, $description, $fileContent);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Item added successfully!']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Error adding item: ' . $stmt->error]);
        }

        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(['success' => false, 'error' => 'File upload error.']);
    }
}


?>
