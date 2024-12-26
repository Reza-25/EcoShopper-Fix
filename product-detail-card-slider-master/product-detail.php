<?php
include '../config.php';

$product_id = $_GET['id'];
$stmt = $db->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

$additional_images = explode(',', $product['additional_images']);

// Dapatkan halaman sebelumnya dari session
$previous_page = isset($_SESSION['previous_page']) ? $_SESSION['previous_page'] : 'home.php';
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Product Detail</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../desaincss/style.css">
    <link rel="stylesheet" href="product-detail.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />

    <script>
        function validateStock(input) {
            var max = parseInt(input.max);
            var value = parseInt(input.value);
            if (value > max) {
                alert('Jumlah barang tidak bisa melebihi stok yang tersedia');
                input.value = max;
            }
        }
    </script>
</head>
<body>
    <!--navbar-->
    <header>
        <a href="#" class="logo"><i class='bx bxs-basket'></i>Eco shopper</a>
        <!--menu icon-->
        <div class="bx bx-menu" id="menu-icon"></div>
        <!--nav list-->
        <ul class="navbar">
            <li><a href="/Home.php">Home</a></li>
            <li><a href="/product.">Kategori</a></li>
            <li><a href="../<?php echo $previous_page; ?>">Produk</a></li>
            <li><a href="home.html#about">Tentang Kami</a></li>
            <li><a href="home.html#customer">Customer</a></li>
        </ul>

        <!--cart-->
        <div class="cart">
            <a href="../cart.php"><i class='bx bx-cart'><span class="count">0</span></i></a>
        </div>

        <!--profil-->
        <div class="profile">
            <?php
            session_start();
            if (isset($_SESSION["user_id"])) {
                $userId = $_SESSION["user_id"];
                $stmt = $db->prepare("SELECT profile_picture FROM users WHERE id = ?");
                $stmt->bind_param("i", $userId);
                $stmt->execute();
                $result = $stmt->get_result();
                $user = $result->fetch_assoc();
                $profilePicture = $user["profile_picture"] ? $user["profile_picture"] : 'default-profile.png';
            ?>
                <img src="../<?php echo $profilePicture; ?>" alt="Profile Picture">
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

    <!-- Main Content -->
    <div class="main-content">
        <div class="card-wrapper">
            <div class="card">
                <!-- card left -->
                <div class="product-imgs">
                    <div class="img-display">
                        <div class="img-showcase">
                            <img src="../<?php echo $product['image']; ?>" alt="Product Image">
                        </div>
                    </div>
                    <div class="img-select">
                        <div class="img-item">
                            <a href="#" data-id="1">
                                <img src="../<?php echo $product['image']; ?>" alt="Product Image">
                            </a>
                        </div>
                    </div>
                </div>
                <!-- card right -->
                <div class="product-content">
                    <h2 class="product-title"><?php echo $product['name']; ?></h2>
                    <div class="product-price">
                        <p class="new-price">Price: <span>Rp <?php echo $product['price']; ?></span></p>
                    </div>
                    <div class="product-detail">
                        <h2>About this item: </h2>
                        <p><?php echo $product['description']; ?></p>
                        <ul>
                            <li>Material: <span><?php echo $product['material']; ?></span></li>
                            <li>Impact: <span><?php echo $product['sustainability_impact']; ?></span></li>
                            <?php if ($product['gender']): ?>
                                <li>Gender: <span><?php echo $product['gender']; ?></span></li>
                            <?php endif; ?>
                            <li>Type: <span><?php echo $product['type']; ?></span></li>
                            <?php if ($product['size']): ?>
                                <li>Size: <span><?php echo $product['size']; ?></span></li>
                            <?php endif; ?>
                            <?php if ($product['warranty']): ?>
                                <li>Warranty: <span><?php echo $product['warranty']; ?></span></li>
                            <?php endif; ?>
                            <li><a href="Profil-produk.html">Learn More about this product</a></li>
                        </ul>
                    </div>
                    <div class="purchase-info">
                    <form method="POST" action="../add_to_cart.php">
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            <input type="hidden" name="product_name" value="<?php echo $product['name']; ?>">
                            <input type="hidden" name="product_price" value="<?php echo $product['price']; ?>">
                            <input type="hidden" name="product_image" value="<?php echo $product['image']; ?>">
                            <p>Stok tersedia: <?php echo $product['stock']; ?></p>
                            <input type="number" name="quantity" min="1" max="<?php echo $product['stock']; ?>" value="1" oninput="validateStock(this)">
                            <button type="submit" class="btn">Add to Cart <i class="fas fa-shopping-cart"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="/EcoShopper-Fix/js/product.js"></script>
    <script src="/EcoShopper-Fix/js/main.js"></script>
</body>
</html>