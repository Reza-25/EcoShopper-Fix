<?php
session_start();
include 'config.php';

$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$checkout_items = isset($_SESSION['checkout']) ? $_SESSION['checkout'] : [];
$total_price = 0;
?>

<?php

$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$checkout_items = isset($_SESSION['checkout']) ? $_SESSION['checkout'] : [];
$total_price = 0;

// Function to count total items in the cart
function countCartItems($cart_items) {
    $total_items = 0;
    foreach ($cart_items as $item) {
        $total_items += $item['quantity'];
    }
    return $total_items;
}

$total_cart_items = countCartItems($cart_items);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="desaincss/wishlist.css">
    <link rel="stylesheet" href="desaincss/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;900&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <title>Shopping Cart</title>
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
            <li><a href="product-fashion.php">Produk</a></li>
            <li><a href="simple-blog-page-master/images/Tentangkami.php">Tentang Kami</a></li>
            <li><a href="./Main/Home.php">Customer</a></li>
        </ul>

        <!--cart-->
        <div class="cart">
            <a href="cart.php"><i class='bx bx-cart'><span class="count"><?php echo $total_cart_items; ?></span></i></a>
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

    <section class="cart-section">
        <div class="cart-container">
            <h1>Your Cart</h1>
            <?php if (empty($cart_items)): ?>
                <p>Your cart is empty.</p>
            <?php else: ?>
                <div class="products-container">
                    <?php foreach ($cart_items as $item): ?>
                        <div class="box">
                            <img src="<?php echo $item['image']; ?>" alt="Product Image">
                            <span>fresh item</span>
                            <h2><?php echo $item['name']; ?><br>Stock: <?php echo $item['quantity']; ?></h2>
                            <h3 class="price">Rp <?php echo $item['price']; ?></h3>
                            <div class="quantity">
                                <label for="quantity-<?php echo $item['id']; ?>">Quantity:</label>
                                <input type="number" id="quantity-<?php echo $item['id']; ?>" name="quantity" value="<?php echo $item['quantity']; ?>" min="1">
                            </div>
                            <div class="item-actions">
                                <button class="btn-delete" onclick="removeFromCart(<?php echo $item['id']; ?>)">Delete</button>
                                <button class="btn-add" onclick="addToCheckout(<?php echo $item['id']; ?>)">Add to Checkout</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="checkout-container">
            <h1>Checkout</h1>
            <div class="checkout-items">
                <?php if (empty($checkout_items)): ?>
                    <p>No items in checkout.</p>
                <?php else: ?>
                    <?php foreach ($checkout_items as $item): ?>
                        <div class="checkout-box">
                            <img src="<?php echo $item['image']; ?>" alt="Product Image">
                            <h3><span><?php echo $item['quantity']; ?></span> <?php echo $item['name']; ?></h3>
                            <span>Rp <?php echo $item['price']; ?></span>
                            <i class='bx bx-x' onclick="removeFromCheckout(<?php echo $item['id']; ?>)"></i>
                        </div>
                        <?php $total_price += $item['price'] * $item['quantity']; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="total">
                <h1>Pajak: 10%</h1>
                <h3>Total</h3>
                <span>Rp <?php echo number_format($total_price * 1.1, 0, ',', '.'); ?></span>
            </div>
            <a href="payment.php"><button>Checkout</button></a>
        </div>
    </section>

    <script>
        function removeFromCart(productId) {
            // Implement remove from cart functionality
             fetch('remove_from_cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ product_id: productId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            });
        }

        function addToCheckout(productId) {
            // Implement add to checkout functionality
            fetch('add_to_checkout.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ product_id: productId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            });
        }

        function removeFromCheckout(productId) {
            // Implement remove from checkout functionality
            fetch('remove_from_checkout.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ product_id: productId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            });
        }

        function updateTotalPrice() {
            // Implement total price calculation
        }
    </script>

    <script src="/js/cart.js"></script>
    <script src="/js/main.js"></script>
</body>
</html>