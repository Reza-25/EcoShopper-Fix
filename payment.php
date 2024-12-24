<?php

if (!isset($_SESSION["user_id"])) {
    echo "<script>alert('Kamu harus login terlebih dahulu sebelum melakukan pembayaran!');</script>";
    header("Location: login.php");
    exit();
}

$userId = $_SESSION["user_id"];
$stmt = $db->prepare("SELECT username, email FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$checkout_items = isset($_SESSION['checkout']) ? $_SESSION['checkout'] : [];
$total_price = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="desaincss/checkout.css">
    <link rel="stylesheet" href="desaincss/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;900&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <title>pembayaran</title>
</head>
<body>
    <!--navbar-->
    <header>
        <a href="#" class="logo"><i class='bx bxs-basket'></i>Eco shopper</a>
        <!--menu icon-->
        <div class="bx bx-menu" id="menu-icon"></div>
        <!--nav list-->
        <ul class="navbar">
            <li><a href="#home" class="home-active">Home</a></li>
            <li><a href="home.html#categories">Kategori</a></li>
            <li><a href="#products">Produk</a></li>
            <li><a href="home.html#about">Tentang Kami</a></li>
            <li><a href="home.html#customer">Customer</a></li>
        </ul>

        <!--cart-->
        <div class="cart">
            <a href="cart.html"><i class='bx bx-cart'><span class="count">0</span></i></a>
        </div>

        <!--profil-->
        <div class="profile">
    <?php
    session_start();
    include 'config.php';
    if (isset($_SESSION["user_id"])) {
        $userId = $_SESSION["user_id"];
        $stmt = $db->prepare("SELECT profile_picture FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $profilePicture = $user["profile_picture"] ? $user["profile_picture"] : 'default-profile.png';
    ?>
        <img src="<?php echo $profilePicture; ?>" alt="Profile Picture">
        <span><?php echo $_SESSION["username"]; ?></span>
        <i class='bx bx-caret-down' onclick="toggleDropdown()"></i>
    <?php
    } else {
        echo '<a href="login.php">Sign In</a>';
    }
    ?>
</div>

<div class="profile-dropdown" id="profile-dropdown" style="display: none;">
    <?php if (isset($_SESSION["user_id"])): ?>
        <a href="logout.php">Log Out</a>
    <?php else: ?>
        <a href="login.php">Sign In</a>
    <?php endif; ?>
</div>

<script>
function toggleDropdown() {
    var dropdown = document.getElementById("profile-dropdown");
    if (dropdown.style.display === "none") {
        dropdown.style.display = "block";
    } else {
        dropdown.style.display = "none";
    }
}
</script>

    <!-- Main Content -->
    <div class="main-content">
        <!--Product List-->
        <section class="product-list" id="product">
            <h2>Produk yang Dipilih</h2>
            <div class="product-container">
                <img src="product/black-14-removebg-preview.png" alt="black-hat">
                <span>Black Hat</span>
                <p class="price">Rp 20.000</p>
                <p class="kuantiti">jumlah barang: 1</p>
            </div>
            <div class="product-container">
                <img src="product/black-8-removebg-preview.png" alt="Scarf">
                <span>Sorban Hitam</span>
                <p class="price">Rp 100.000</p>
                <p class="kuantiti">jumlah barang: 1</p>
            </div>
            <div class="product-container">
                <img src="product/sneaker-4.png" alt="Sepatu">
                <span>sepatu</span>
                <p class="price">Rp 150.000</p>
                <p class="kuantiti">jumlah barang: 1</p>
            </div>
            <!--total-->
            <div class="total">
                <h1 class="pajak">Pajak: 10%</h1>
                <h2>Total: Rp 270.000</h2>
            </div>
        </section>

        <!--Pembayaran Form-->
        <section class="payment-form">
            <h2>Pembayaran</h2>
            <form action="" class="form">
                <div class="input-container">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" readonly>
                </div>
                <div class="input-container">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" readonly>
                </div>
                <div class="input-container">
                    <label for="alamat">Alamat</label>
                    <input type="text" id="alamat" placeholder="Masukkan alamat anda">
                </div>
                <div class="input-container">
                    <label for="kota">Kota</label>
                    <input type="text" id="kota" placeholder="Masukkan kota anda">
                </div>
                <div class="input-container">
                    <label for="kodepos">Kode Pos</label>
                    <input type="text" id="kodepos" placeholder="Masukkan kode pos anda">
                </div>
                <div class="input-container">
                    <label for="nomor">Nomor Telepon</label>
                    <input type="text" id="nomor" placeholder="Masukkan nomor telepon anda">
                </div>
                <div class="metode-pembayaran">
                    <label for="pay">Pilih Metode Pembayaran</label>
                    <select name="pay" id="pay">
                        <option value="gopay">Gopay</option>
                        <option value="ovo">Ovo</option>
                        <option value="dana">Dana</option>
                        <option value="linkaja">Linkaja</option>
                        <option value="transfer">Transfer Bank</option>
                    </select>
                </div>
                <button type="submit">Bayar</button>
            </form>
        </section>
    </div>

    <script src="/js/checkout.js"></script>
</body>
</html>