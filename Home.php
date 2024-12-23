<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoShopper</title>
    <link rel="stylesheet" href="desaincss/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
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

    <!--home-->
    <section class="home swiper" id="home">
        <div class="swiper-wrapper">
            <!-- Slide1 -->
            <div class="swiper-slide container">
                <div class="home-text">
                    <span>Fashion</span>
                    <h1>varian baru<br>dengan diskon gede<br></h1>
                    <a href="/product-fashion.html" class="btn">Belanja<i class='bx bxs-right-arrow-alt' ></i></a>
                </div>
                <img class="shirt" src="product/black-9-removebg-preview.png" alt="">
            
            </div>
            <!--slide2-->
            <div class="swiper-slide container">
                <div class="home-text">
                    <span>Electronic</span>
                    <h1>Headphone baru<br> dengan warna <br>baru</h1>
                    <a href="/product.electronic.html" class="btn">Belanja<i class='bx bxs-right-arrow-alt' ></i></a>
                </div>
                <img id="headphone-image" src="product/headphone-9.png" alt="">
            
            </div>
            <!--slide3-->
            <div class="swiper-slide container">
                <div class="home-text">
                    <span>Accessoris</span>
                    <h1>Tas Mewah<br> Kini dengan <br>desain baru</h1>
                    <a href="product-aksesoris.html" class="btn">Belanja<i class='bx bxs-right-arrow-alt' ></i></a>
                </div>
                <img id="tas-coklat" src="product/brown-5.png" alt="">
            
            </div>
        
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>

    </section>
    <!--category-->
    <section class="categories" id="categories">
        <div class="heading">
            <h1>Jelajahi Produk Kami<br><span>Kategori</span></h1>
            <a href="/product-fashion.html" class="btn">Belanja<i class='bx bxs-right-arrow-alt' ></i></a>
        </div>
        <!--container content-->
        <div class="categories-container">
            <!--box-->
            <div class="box box1">
                <img src="img2/dark-blue-2-removebg-preview.png" alt="">
                <h2>Fashion</h2>
                <span>22 items</span>
                <a href="product-fashion.html"><i class='bx bxs-right-arrow-alt' ></i></a>

            </div>
             <!--box2-->
             <div class="box box2">
                <img src="img2/light-green-5-removebg-preview.png" alt="">
                <h2>Acessories</h2>
                <span>22 items</span>
                <a href="product-aksesoris.html"><i class='bx bxs-right-arrow-alt' ></i></a>

            </div>
             <!--box3-->
             <div class="box box3">
                <img src="img2/furniture_cate1-removebg-preview.png" alt="">
                <h2>Furniture</h2>
                <span>5 items</span>
                <a href="product-furniture.html"><i class='bx bxs-right-arrow-alt' ></i></a>

            </div>
             <!--box4-->
             <div class="box box4">
                <img src="img2/—Pngtree—mock up cosmetic products for_15619191.png" alt="">
                <h2>Skin care</h2>
                <span>50 items</span>
                <a href="product-skincare.html"><i class='bx bxs-right-arrow-alt' ></i></a>
            </div>
            <!--box5-->
            <div class="box box5">
                <img src="img2/black-16.png" alt="">
                <h2>Electronic</h2>
                <span>50 items</span>
                <a href="product.electronic.html"><i class='bx bxs-right-arrow-alt' ></i></a>
            </div>
        </div>
    </section>
    <!--product-->
    <section class="products" id="products">
        <div class="heading">
            <h1>Our Popular <br><span>Products</span></h1>
            <a href="product-fashion.php" class="btn">Belanja<i class='bx bxs-right-arrow-alt' ></i></a>
        </div>

        <!--product content-->
        <div class="products-container">
            <div class="box">
                <img src="product/black-9-removebg-preview.png" alt="">
                <span>fresh item</span>
                <h2>Black Sweater<br>Stock: 20</h2>
                <h3 class="price">Rp 200.000</h3>
                <a href="../EcoShopper-Fix/product-detail-card-slider-master/product-detail.php"><i class='bx bx-cart-alt'></i></a>
                <i class='bx bx-heart' ></i>
                <div class='progress-bar' role='progressbar' aria-valuenow='75' aria-valuemin='0' aria-valuemax='100'></div>
                <span class="category">Recycle</span>
                <span class="discount">70%</span>
            </div>
            <!--product2-->
            <div class="box">
                <img src="product/sneaker-4.png" alt="">
                <span>fresh item</span>
                <h2>Black Jacket<br>Stock: 20</h2>
                <h3 class="price">Rp 200.000</h3>
                <i class='bx bx-cart-alt'></i>
                <a href="../EcoShopper-Fix/product-detail-card-slider-master/product-detail.php"><i class='bx bx-heart' ></i></a>
                <div class='progress-bar' role='progressbar' aria-valuenow='75' aria-valuemin='0' aria-valuemax='100'></div>
                <span class="category">Recycle</span>
                <span class="discount">70%</span>
            </div>
            <!--product3-->
            <div class="box">
                <img src="product/headphone-9.png" alt="">
                <span>fresh item</span>
                <h2>Black Jacket<br>Stock: 20</h2>
                <h3 class="price">Rp 200.000</h3>
                <a href="../EcoShopper-Fix/product-detail-card-slider-master/product-detail.php"><i class='bx bx-cart-alt'></i></a>
                <i class='bx bx-heart' ></i>
                <div class='progress-bar' role='progressbar' aria-valuenow='75' aria-valuemin='0' aria-valuemax='100'></div>
                <span class="category">Recycle</span>
                <span class="discount">70%</span>
            </div>
            <!--product4-->
            <div class="box">
                <img src="product/skincare-8-removebg-preview.png" alt="">
                <span>fresh item</span>
                <h2>Black Jacket<br>Stock: 20</h2>
                <h3 class="price">Rp 200.000</h3>
                <a href="../EcoShopper-Fix/product-detail-card-slider-master/product-detail.php"><i class='bx bx-cart-alt'></i></a>
                <i class='bx bx-heart' ></i>
                <div class='progress-bar' role='progressbar' aria-valuenow='75' aria-valuemin='0' aria-valuemax='100'></div>
                <span class="category">Recycle</span>
                <span class="discount">70%</span>
            </div>
            <!--product5-->
            <div class="box">
                <img src="product/black-8-removebg-preview.png" alt="">
                <span>fresh item</span>
                <h2>Black Jacket<br>Stock: 20</h2>
                <h3 class="price">Rp 200.000</h3>
                <a href="../EcoShopper-Fix/product-detail-card-slider-master/product-detail.php"><i class='bx bx-cart-alt'></i></a>
                <i class='bx bx-heart' ></i>
                <div class='progress-bar' role='progressbar' aria-valuenow='75' aria-valuemin='0' aria-valuemax='100'></div>
                <span class="category">Recycle</span>
                <span class="discount">70%</span>
            </div>
            <!--product6-->
            <div class="box">
                <img src="product/black-14-removebg-preview.png" alt="">
                <span>fresh item</span>
                <h2>Black Jacket<br>Stock: 20</h2>
                <h3 class="price">Rp 200.000</h3>
                <a href="../EcoShopper-Fix/product-detail-card-slider-master/product-detail.php"><i class='bx bx-cart-alt'></i></a>
                <i class='bx bx-heart' ></i>
                <div class='progress-bar' role='progressbar' aria-valuenow='75' aria-valuemin='0' aria-valuemax='100'></div>
                <span class="category">Recycle</span>
                <span class="discount">70%</span>
            </div>
        </div>
    </section>
    <!--about-->
    <section class="about" id="about">
        <img src="label/—Pngtree—eco friendly icon graphic_8076645.png" alt="">
        <div class="about-text">
            <span>About Us</span>
            <p>Sebagai toko online yang berfokus pada produk-produk ramah lingkungan, Eco Shopper menyediakan berbagai macam produk yang ramah lingkungan</p>
            <p>dan juga kami bermitra dengan perusahaan-perusahaan yang memang dibidang pada sumberdaya berkelanjutan.</p>
            <a href="/simple-blog-page-master/images/Tentangkami.html" class="btn">Tentang kami<i class='bx bxs-right-arrow-alt' ></i></a>
        </div>
    </section>
    <!--customer-->
    <section class="customer" id="customer">
        <h2>Kenapa customer menyukai aplikasi ini?</h2>
        <!--customer content-->
        <div class="customer-container">
            <!---review1-->
            <div class="box">
                <i class='bx bxs-quote-alt-left' ></i>
                <div class="stars">
                    <i class='bx bxs-star' ></i>
                    <i class='bx bxs-star' ></i>
                    <i class='bx bxs-star' ></i>
                    <i class='bx bxs-star' ></i>
                    <i class='bx bxs-star' ></i>
                </div>
                <p>Aplikasi ini Sangat Inspiratif, tidak hanya menjual barang saja namun memikirkan bagaimana barang tersebut berpengaruh pada lingkungan kita!, terlebih lagi barang yang di jualnya sangat bagus</p>
                <div class="review-profile">
                    <img src="images/collection-29.jpg" alt="">
                    <h3>angelina smith</h3>
                </div>
            </div>

             <!---review2-->
             <div class="box">
                <i class='bx bxs-quote-alt-left' ></i>
                <div class="stars">
                    <i class='bx bxs-star' ></i>
                    <i class='bx bxs-star' ></i>
                    <i class='bx bxs-star' ></i>
                    <i class='bx bxs-star' ></i>
                    <i class='bx bxs-star' ></i>
                </div>
                <p>Website ini sangat bagus sekali untuk bagi saya sebagai orang yang suka di bidang fashion, selain barang yang dijual nya sangat bagus dan modis, aplikasi ini juga menawarkan harga yang terjangkau.</p>
                <div class="review-profile">
                    <img src="images/collection-72.jpg" alt="">
                    <h3>James Leon</h3>
                </div>
            </div>
             <!---review3-->
             <div class="box">
                <i class='bx bxs-quote-alt-left' ></i>
                <div class="stars">
                    <i class='bx bxs-star' ></i>
                    <i class='bx bxs-star' ></i>
                    <i class='bx bxs-star' ></i>
                    <i class='bx bxs-star' ></i>
                    <i class='bx bxs-star' ></i>
                </div>
                <p>Saya sebagai aktivis pada bidang Lingkungan alam, setelah melihat aplikasi ini hati saya terharu karna akhirnya bisa melihat sebuah aplikasi yang tidak hanya menjual barang bagus, namun tetap memperhatikan dampaknya bagi lingkungan kami.</p>
                <div class="review-profile">
                    <img src="images/glasses-1.jpg" alt="">
                    <h3>Sonya Heny</h3>
                </div>
            </div>
        </div>
    </section>

    <!--footer-->
    <section class="footer" id="footer">
        <div class="footer-box">
            <a href="#" class="logo"><i class='bx bxs-basket'></i>Eco Shopper</a>
            <p>Perum The University Residence Blok A. 6, Jln. Kaliurang Km 14,5, RT04 RW06 Tegalsari,  <br>Daerah Istimewa Yogyakarta</p>
            <div class="social">
                <a href="#"><i class='bx bxl-instagram' ></i></a>
                <a href="#"><i class='bx bxl-facebook' ></i></a>
                <a href="#"><i class='bx bxl-twitter' ></i></a>
            </div>
        </div>
        <div class="footer-box">
            <h3>kategori</h3>
            <a href="/product-fashion.html">Fashion</a>
            <a href="/product-aksesoris.html">Accessories</a>
            <a href="/product-furniture.html">Furniture</a>
            <a href="/product-skincare.html">Skin Care</a>
            <a href="/product.electronic.html">Electronic</a>
        </div>
        <div class="footer-box">
            <h3>FAQ!</h3>
            <a href="#">privacy Policy</a>
            <a href="#">Terms & Condition</a>
            <a href="#">Contact Us</a>
        </div>
    </section>
    <!--copyright-->
    <div class="copy-right">
        <p>&copy; EcoShopper. All right reserved.</p>



    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!--link to js-->
    <script src="js/main.js"></script>

    
</body>
</html>