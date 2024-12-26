<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $product_id = $data['product_id'];

    if (!isset($_SESSION['checkout'])) {
        $_SESSION['checkout'] = [];
    }

    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $product_id) {
            $_SESSION['checkout'][] = $item;
            unset($_SESSION['cart'][$key]);
            break;
        }
    }

     // Debugging
     error_log("User ID: " . $_SESSION["user_id"]);
     error_log("Checkout Items: " . print_r($_SESSION['checkout'], true));
 

    $total_items = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total_items += $item['quantity'];
    }

    echo json_encode(['success' => true]);
    exit();
}
?>