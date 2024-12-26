<?php
session_start();
include 'config.php';

$transaction_id = $_GET['transaction_id'];
$stmt = $db->prepare("SELECT * FROM transactions WHERE id = ?");
$stmt->bind_param("i", $transaction_id);
$stmt->execute();
$result = $stmt->get_result();
$transaction = $result->fetch_assoc();

$stmt = $db->prepare("SELECT * FROM transaction_items WHERE transaction_id = ?");
$stmt->bind_param("i", $transaction_id);
$stmt->execute();
$items_result = $stmt->get_result();
$items = $items_result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="desaincss/style.css">
    <title>Pembayaran Berhasil</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
        }
        .payment-success {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            text-align: center;
        }
        .payment-success h2 {
            color: #4CAF50;
        }
        .payment-success p {
            margin: 10px 0;
        }
        .payment-success ul {
            list-style-type: none;
            padding: 0;
        }
        .payment-success ul li {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <section class="payment-success">
        <h2>Pembayaran Berhasil</h2>
        <h3>Struk Transaksi</h3>
        <p>Transaction ID: <?php echo $transaction['id']; ?></p>
        <p>Username: <?php echo $transaction['username']; ?></p>
        <p>Email: <?php echo $transaction['email']; ?></p>
        <p>Alamat: <?php echo $transaction['alamat']; ?></p>
        <p>Kota: <?php echo $transaction['kota']; ?></p>
        <p>Kode Pos: <?php echo $transaction['kodepos']; ?></p>
        <p>Nomor Telepon: <?php echo $transaction['nomor']; ?></p>
        <p>Metode Pembayaran: <?php echo $transaction['pay']; ?></p>
        <p>Total Harga: Rp <?php echo number_format($transaction['total_price'], 0, ',', '.'); ?></p>
        <p>Waktu Transaksi: <?php echo $transaction['transaction_time']; ?></p>
        <h3>Items</h3>
        <ul>
            <?php foreach ($items as $item): ?>
                <li><?php echo $item['quantity']; ?> x <?php echo $item['product_id']; ?> - Rp <?php echo number_format($item['price'], 0, ',', '.'); ?></li>
            <?php endforeach; ?>
        </ul>
    </section>
</body>
</html>