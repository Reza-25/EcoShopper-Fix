<?php
session_start();
include 'config.php';


// Simpan halaman sebelumnya di session
$_SESSION['previous_page'] = basename($_SERVER['PHP_SELF']);

// Function to count items in a category
function countItems($category, $db) {
    $stmt = $db->prepare("SELECT COUNT(*) as count FROM products WHERE category = ?");
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['count'];
}

$fashion_count = countItems('fashion', $db);
$aksesoris_count = countItems('aksesoris', $db);
$furniture_count = countItems('furniture', $db);
$skincare_count = countItems('skincare', $db);
$electronic_count = countItems('electronic', $db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="desaincss/style.css">
    <link rel="stylesheet" href="desaincss/product.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <title>Product</title>
</head>
<body>

        <!--navbar-->
    <header>
        <a href="#" class="logo"><i class='bx bxs-basket'></i>Eco shopper</a>
        <!--menu icon-->
        <div class="bx bx-menu" id="menu-icon"></div>
        <!--nav list-->
        <ul class="navbar">
            <li><a href="home.php" >Home</a></li>
            <li><a href="home.php">Kategori</a></li>
            <li><a href="product-fashion.php" class="home-active">Produk</a></li>
            <li><a href="simple-blog-page-master/images/Tentangkami.php">Tentang Kami</a></li>
            <li><a href="home.php">Customer</a></li>
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
        
        <!-- Main Content -->
        <div class="main-content">
            <!-- Filter Icon -->
            <div class="filter-icon">
                <i class='bx bx-filter' id="filter-icon"></i>
            </div>
            
        <!-- Filter Section -->
        <div class="filter-section" id="filter-section">
            <h2>Filter</h2>
            <form>
                <div class="filter-group">
                    <label for="material">Material</label>
                    <select id="material" name="material">
                        <option value="organik">Organik</option>
                        <option value="daur-ulang">Daur Ulang</option>
                        <option value="reuseable">Reuseable</option>
                        <option value="zero-waste">Zero Waste</option>
                        <option value="biodegredable">Mudah Terurai</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="keberlanjutan">Dampak Keberlanjutan</label>
                    <select id="keberlanjutan" name="keberlanjutan">
                        <option value="hemat-energi">Hemat Energi</option>
                        <option value="kimia">Bebas bahan kimia</option>
                        <option value="sertifikat">Ber-sertifikat Eco-Friendly</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="warranty">Garansi</label>
                    <select id="warranty" name="warranty">
                        <option value="garansi1">Garansi 1 Tahun</option>
                        <option value="garansi2">Garansi 2 Tahun</option>
                        <option value="garansi3">Garansi 3 Tahun++</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="type">Jenis</label>
                    <select id="type" name="type">
                        <option value="headphone">Headphone</option>
                        <option value="laptop">Laptop</option>
                        <option value="keyboard">Keyboard</option>
                        <option value="perangkat">Perangkat rumah tangga</option>
                        <a href="product-elektronik.php" class="btn-reset">Reset Filter</a>
                    </select>
                </div>
                <button type="submit">Terapkan Filter</button>
                <a href="product-elektronik.php" class="btn-reset">Reset Filter</a>
            </form>
        </div>
    <!--category-->
    <section class="categories" id="categories">
        <!--container content-->
        <div class="categories-container">
            <!--box-->
            <div class="box box1">
                <img src="img2/dark-blue-2-removebg-preview.png" alt="">
                <h2>Fashion</h2>
                <span><?php echo $fashion_count; ?> items</span>
                    <a href="product-fashion.php"><i class='bx bxs-right-arrow-alt' ></i></a>

            </div>
             <!--box2-->
             <div class="box box2">
                <img src="img2/light-green-5-removebg-preview.png" alt="">
                <h2>Acessories</h2>
                <span><?php echo $aksesoris_count; ?> items</span>
                    <a href="product-aksesoris.php"><i class='bx bxs-right-arrow-alt' ></i></a>

            </div>
             <!--box3-->
             <div class="box box3">
                <img src="img2/furniture_cate1-removebg-preview.png" alt="">
                <h2>Furniture</h2>
                <span><?php echo $furniture_count; ?> items</span>
                    <a href="product-furniture.php"><i class='bx bxs-right-arrow-alt' ></i></a>

            </div>
             <!--box4-->
             <div class="box box4">
                <img src="img2/—Pngtree—mock up cosmetic products for_15619191.png" alt="">
                <h2>Skin care</h2>
                <span><?php echo $skincare_count; ?> items</span>
                    <a href="product-skincare.php"><i class='bx bxs-right-arrow-alt' ></i></a>
            </div>
            <!--box5-->
            <div class="box box5">
                <img src="img2/black-16.png" alt="">
                <h2>Electronic</h2>
                <span><?php echo $electronic_count; ?> items</span>
                    <a href="product-elektronik.php"><i class='bx bxs-right-arrow-alt' ></i></a>
            </div>
        </div>
    </section>

        <!--name Page-->
    <div class="nama-kategori">
        <h2>Elektronik</h2>
    </div>
    
        <!---filter-->
    
        <!--product-->
        <section class="products" id="products">
        
        <!--product content-->
        <div class="products-container">
            <?php

            $category = 'elektronik';
            $material = isset($_GET['material']) ? $_GET['material'] : '';
            $keberlanjutan = isset($_GET['keberlanjutan']) ? $_GET['keberlanjutan'] : '';
            $warranty = isset($_GET['warranty']) ? $_GET['warranty'] : '';
            $type = isset($_GET['type']) ? $_GET['type'] : '';

            // Build the query
            $query = "SELECT * FROM products WHERE category='$category'";

            if ($material) {
                $query .= " AND material='$material'";
            }
            if ($keberlanjutan) {
                $query .= " AND sustainability_impact='$keberlanjutan'";
            }
            if ($warranty) {
                $query .= " AND warranty='$warranty'";
            }
            if ($type) {
                $query .= " AND type='$type'";
            }

            $result = $db->query($query);

            while ($row = $result->fetch_assoc()) {
                echo "<div class='box'>";
                echo "<img src='" . $row['image'] . "' alt='Product Image'>";
                echo "<h2>" . $row['name'] . "<br>Stock: " . $row['stock'] . "</h2>";
                echo "<h3 class='price'>Rp " . $row['price'] . "</h3>";
                echo "<a href='..\EcoShopper-Fix\product-detail-card-slider-master\product-detail.php?id='><i class='bx bx-cart-alt'></i></a>";
                echo "<i class='bx bx-heart'></i>";
                echo "<div class='progress-bar' role='progressbar' aria-valuenow='75' aria-valuemin='0' aria-valuemax='100'></div>";
                echo "<span class='category'>" . $row['material'] . "</span>";
                echo "<span class='discount'>70%</span>";
                echo "</div>";
            }
            ?>
        </div>
        </section>
    <script src="js/product.js"></script>
    
</body>
</html>