<?php
$host = "devweb2024.cis.strath.ac.uk";
$user = "qrb23133";
$pass = "aaS9heith6to";
$dbname = $user;
$conn = new mysqli($host, $user, $pass, $dbname);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    if (!isset($input['id']) || !isset($input['names'])) {
        echo json_encode(['success' => false, 'error' => 'Invalid input data']);
        exit;
    }

    $delete_id = intval($input['id']);
    $names = $input['names'];
    $name_arr = explode(',', $names);

    // Delete from Orders table
    $sql_delete = "DELETE FROM `Orders` WHERE id = ?";
    $stmt = $conn->prepare($sql_delete);
    if (!$stmt) {
        echo json_encode(['success' => false, 'error' => $conn->error]);
        exit;
    }

    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        // Process the painting updates
        $update_errors = [];
        foreach ($name_arr as $painting) {
            // Prepare the UPDATE statement
            $sql_update = "UPDATE `Art` SET status = 'for sale' WHERE name = ?";
            $update_stmt = $conn->prepare($sql_update);
            if (!$update_stmt) {
                $update_errors[] = "Prepare failed for painting: $painting, Error: " . $conn->error;
                continue;
            }

            $update_stmt->bind_param("s", $painting);

            // Execute the UPDATE statement
            if (!$update_stmt->execute()) {
                $update_errors[] = "Failed to update painting: $painting, Error: " . $conn->error;
            }

            $update_stmt->close();
        }

        // If there are update errors, return them
        if (!empty($update_errors)) {
            echo json_encode(['success' => false, 'error' => $update_errors]);
            exit;
        }

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }

    // Close resources
    $stmt->close();
    $conn->close();
}



?>
