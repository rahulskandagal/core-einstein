<?php
session_start();
require_once('includes/db_connect.php');

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'login_required', 'message' => 'Please login first.']);
    exit();
}

if (isset($_GET['id'])) {
    $user_id = $_SESSION['user_id'];
    $dest_id = clean_input($_GET['id'], $conn);

    // Check if already in wishlist
    $check = $conn->query("SELECT id FROM wishlist WHERE user_id = $user_id AND destination_id = $dest_id");
    
    if ($check->num_rows > 0) {
        echo json_encode(['status' => 'exists', 'message' => 'Already in your wishlist.']);
    } else {
        $stmt = $conn->prepare("INSERT INTO wishlist (user_id, destination_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $dest_id);
        
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Added to wishlist!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to add.']);
        }
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
}
?>
