<?php
session_start();

require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $orderId = $_POST['orderId'];

    // Perform the necessary database deletion operations
    $stmt = $conn->prepare("DELETE FROM orders WHERE order_id = ?");
    $stmt->bind_param("s", $orderId);
    $stmt->execute();

    $response = ['success' => true, 'message' => 'Order deleted successfully'];
    echo json_encode($response);
} else {
    $response = ['success' => false, 'message' => 'Invalid request method'];
    echo json_encode($response);
}
?>