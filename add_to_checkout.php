<?php
session_start();

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

    echo json_encode(['success' => true]);
    exit();
}
?>