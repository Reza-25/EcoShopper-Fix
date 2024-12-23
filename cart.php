<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="desaincss/wishlist.css">
    <link rel="stylesheet" href="desaincss/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;900&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <title>shopping-cart</title>
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

    </header>

        <!--product-->
        <section class="products" id="products">

        <!--product content-->
        <div class="products-container">
            <div class="box">
                <img src="product/black-9-removebg-preview.png" alt="">
                <span>fresh item</span>
                <h2>Black Sweater<br>Stock: 20</h2>
                <h3 class="price">Rp 200.000</h3>
                <div class="quantity">
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" value="1" min="1">
                </div>
                <div class="item-actions">
                    <button class="btn-delete">Delete</button>
                    <button class="btn-add">Add</button>
                </div>
                <i class='bx bx-heart' ></i>
                <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                <span class="discount">70%</span>
            </div>
            <!--product2-->
            <div class="box">
                <img src="product/sneaker-4.png" alt="">
                <span>fresh item</span>
                <h2>Black Jacket<br>Stock: 20</h2>
                <h3 class="price">Rp 200.000</h3>
                <div class="quantity">
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" value="1" min="1">
                </div>
                <div class="item-actions">
                    <button class="btn-delete">Delete</button>
                    <button class="btn-add">Add</button>
                </div>
                <i class='bx bx-heart' ></i>
                <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                <span class="discount">70%</span>
            </div>
            <!--product3-->
            <div class="box">
                <img src="product/headphone-9.png" alt="">
                <span>fresh item</span>
                <h2>Black Jacket<br>Stock: 20</h2>
                <h3 class="price">Rp 200.000</h3>
                <div class="quantity">
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" value="1" min="1">
                </div>
                <div class="item-actions">
                    <button class="btn-delete">Delete</button>
                    <button class="btn-add">Add</button>
                </div>
                <i class='bx bx-heart' ></i>
                <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                <span class="discount">70%</span>
                
            </div>
            <!--product4-->
            <div class="box">
                <img src="product/skincare-8-removebg-preview.png" alt="">
                <span>fresh item</span>
                <h2>Black Jacket<br>Stock: 20</h2>
                <h3 class="price">Rp 200.000</h3>
                <div class="quantity">
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" value="1" min="1">
                </div>
                <div class="item-actions">
                    <button class="btn-delete">Delete</button>
                    <button class="btn-add">Add</button>
                </div>
                <i class='bx bx-heart' ></i>
                <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                <span class="discount">70%</span>
            </div>
            <!--product5-->
            <div class="box">
                <img src="product/black-8-removebg-preview.png" alt="">
                <span>fresh item</span>
                <h2>Black Jacket<br>Stock: 20</h2>
                <h3 class="price">Rp 200.000</h3>
                <div class="quantity">
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" value="1" min="1">
                </div>
                <div class="item-actions">
                    <button class="btn-delete">Delete</button>
                    <button class="btn-add">Add</button>
                </div>
                <i class='bx bx-heart' ></i>
                <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                <span class="discount">70%</span>
            </div>
            <!--product6-->
            <div class="box">
                <img src="product/black-14-removebg-preview.png" alt="">
                <span>fresh item</span>
                <h2>Black Jacket<br>Stock: 20</h2>
                <h3 class="price">Rp 200.000</h3>
                <div class="quantity">
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" value="1" min="1">
                </div>
                <div class="item-actions">
                    <button class="btn-delete">Delete</button>
                    <button class="btn-add">Add</button>
                </div>
                <i class='bx bx-heart' ></i>
                <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                <span class="discount">70%</span>
            </div>
        </div>
    </section>

    <!--Checkout-->
    <div class="checkout">
        <div class="filter-icon">
            <i class='bx bx-filter' id="filter-icon"></i>
        </div>
        <h2>Checkout</h2>
        <div class="checkout-container">
            <div class="checkout-box">
                <img src="product/black-9-removebg-preview.png" alt="">
                <h3>Black Sweater</h3>
                <span>Rp 200.000</span>
                <i class='bx bx-x'></i>
            </div>
            <div class="checkout-box">
                <img src="product/sneaker-4.png" alt="">
                <h3>Black Jacket</h3>
                <span>Rp 200.000</span>
                <i class='bx bx-x'></i>
            </div>
            <div class="checkout-box">
                <img src="product/headphone-9.png" alt="">
                <h3>Black Jacket</h3>
                <span>Rp 200.000</span>
                <i class='bx bx-x'></i>
            </div>
            <div class="checkout-box">
                <img src="product/skincare-8-removebg-preview.png" alt="">
                <h3>Black Jacket</h3>
                <span>Rp 200.000</span>
                <i class='bx bx-x'></i>
            </div>
            <div class="checkout-box">
                <img src="product/black-8-removebg-preview.png" alt="">
                <h3>Black Jacket</h3>
                <span>Rp 200.000</span>
                <i class='bx bx-x'></i>
            </div>
            <div class="checkout-box">
                <img src="product/black-14-removebg-preview.png" alt="">
                <h3>Black Jacket</h3>
                <span>Rp 200.000</span>
                <i class='bx bx-x'></i>
            </div>
        </div>
        <div class="total">
            <h1>Pajak: 10%</h1>
            <h3>Total</h3>
            <span>1.225.000</span>
        </div>
        <a href="/checkout.html"><button>Checkout</button></a>

    <script src="/js/cart.js"></script>
    <script src="/js/main.js"></script>


    
    
    
</body>
</html>