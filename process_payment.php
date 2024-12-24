<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_SESSION["user_id"];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $kota = $_POST['kota'];
    $kodepos = $_POST['kodepos'];
    $nomor = $_POST['nomor'];
    $pay = $_POST['pay'];
    $checkout_items = isset($_SESSION['checkout']) ? $_SESSION['checkout'] : [];
    $total_price = 0;

    foreach ($checkout_items as $item) {
        $total_price += $item['price'] * $item['quantity'];
    }

    $total_price_with_tax = $total_price * 1.1; // Include 10% tax

    // Insert transaction into database
    $stmt = $db->prepare("INSERT INTO transactions (user_id, username, email, alamat, kota, kodepos, nomor, pay, total_price, transaction_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("isssssssd", $userId, $username, $email, $alamat, $kota, $kodepos, $nomor, $pay, $total_price_with_tax);
    $stmt->execute();

    // Get the transaction ID
    $transaction_id = $stmt->insert_id;

    // Insert each item into transaction_items table
    foreach ($checkout_items as $item) {
        $stmt = $db->prepare("INSERT INTO transaction_items (transaction_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiid", $transaction_id, $item['id'], $item['quantity'], $item['price']);
        $stmt->execute();
    }

    // Clear the checkout session
    unset($_SESSION['checkout']);

    // Redirect to success page
    header("Location: payment_success.php?transaction_id=$transaction_id");
    exit();
}
?>