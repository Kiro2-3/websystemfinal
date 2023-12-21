<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    require 'config.php';
    $orderId = $_POST['orderId'];
    $newStatus = $_POST['newStatus'];
    $stmt = $conn->prepare('UPDATE orders SET order_status = ? WHERE order_id = ?');
    $stmt->bind_param('ss', $newStatus, $orderId);
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false]);
}
?>


<!-- Step 1: Update order status->  GET ORDER ID 
STEP 2: Retrieve curremt status
Step 3: AFter button click, supply the new status inside the ajax parameter 
STEP 4: Update the database depending on what information is inside the parameter-->