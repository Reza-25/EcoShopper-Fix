<?php
session_start();
include 'config.php';

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

if (!$user) {
    echo "<script>alert('User not found.');</script>";
    header("Location: login.php");
    exit();
}

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
    <title>Pembayaran</title>
</head>
<body>
    <!--navbar-->
    <header>
        <a href="#" class="logo"><i class='bx bxs-basket'></i>Eco shopper</a>
        <!--menu icon-->
        <div class="bx bx-menu" id="menu-icon"></div>
        <!--nav list-->
        <ul class="navbar">
            <li><a href="./Main/Home.php" class="home-active">Home</a></li>
            <li><a href="./Main/Home.php">Kategori</a></li>
            <li><a href="/product-fashion.php">Produk</a></li>
            <li><a href="./simple-blog-page-master/images/Tentangkami.php">Tentang Kami</a></li>
            <li><a href="./Main/Home.php">Customer</a></li>
        </ul>

        <!--cart-->
        <div class="cart">
            <a href="cart.php"><i class='bx bx-cart'><span class="count">0</span></i></a>
        </div>

        <!--profil-->
        <div class="profile">
            <?php
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
    </header>

    <section class="product-list" id="product">
        <h2>Produk yang Dipilih</h2>
        <?php foreach ($checkout_items as $item): ?>
            <div class="product-container">
                <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
                <span><?php echo $item['name']; ?></span>
                <p class="price">Rp <?php echo number_format($item['price'], 0, ',', '.'); ?></p>
                <p class="kuantiti">jumlah barang: <?php echo $item['quantity']; ?></p>
            </div>
            <?php $total_price += $item['price'] * $item['quantity']; ?>
        <?php endforeach; ?>
        <!--total-->
        <div class="total">
            <h1 class="pajak">Pajak: 10%</h1>
            <h2>Total: Rp <?php echo number_format($total_price * 1.1, 0, ',', '.'); ?></h2>
        </div>
    </section>

    <!--Pembayaran Form-->
    <section class="payment-form">
        <h2>Pembayaran</h2>
        <form action="process_payment.php" method="POST" class="form">
            <div class="input-container">
                <label for="alamat">Alamat</label>
                <input type="text" id="alamat" name="alamat" placeholder="Masukkan alamat anda" required>
            </div>
            <div class="input-container">
                <label for="kota">Kota</label>
                <input type="text" id="kota" name="kota" placeholder="Masukkan kota anda" required>
            </div>
            <div class="input-container">
                <label for="kodepos">Kode Pos</label>
                <input type="text" id="kodepos" name="kodepos" placeholder="Masukkan kode pos anda" required>
            </div>
            <div class="input-container">
                <label for="nomor">Nomor Telepon</label>
                <input type="text" id="nomor" name="nomor" placeholder="Masukkan nomor telepon anda" required>
            </div>
            <div class="pilih-kurir">
                <label for="kurir">Pilih Kurir</label>
                <select name="kurir" id="kurir" required>
                    <option value="jne">JNE</option>
                    <option value="tiki">TIKI</option>
                    <option value="SiCepat">Sicepat</option>
                    <option value="pos">POS Indonesia</option>
                </select>
            </div>
            <div class="metode-pembayaran">
                <label for="pay">Pilih Metode Pembayaran</label>
                <select name="pay" id="pay" required>
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
</body>
</html>