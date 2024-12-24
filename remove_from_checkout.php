<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $product_id = $data['product_id'];

    foreach ($_SESSION['checkout'] as $key => $item) {
        if ($item['id'] == $product_id) {
            unset($_SESSION['checkout'][$key]);
            break;
        }
    }

    echo json_encode(['success' => true]);
    exit();
}
?>