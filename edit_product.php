<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['product_name'];
    $price = $_POST['product_price'];
    $description = $_POST['product_description'];
    $category = $_POST['category'];
    $material = $_POST['material'];
    $sustainability_impact = $_POST['sustainability_impact'];
    $gender = isset($_POST['gender']) ? $_POST['gender'] : null;
    $type = $_POST['type'];
    $size = isset($_POST['size']) ? implode(',', $_POST['size']) : null;
    $warranty = isset($_POST['warranty']) ? $_POST['warranty'] : null;
    $function = isset($_POST['function']) ? $_POST['function'] : null;

    // Handle file upload
    $target_dir = "uploads/";
    $image_paths = [];
    if (!empty($_FILES['product_images']['name'][0])) {
        foreach ($_FILES['product_images']['name'] as $key => $image_name) {
            $target_file = $target_dir . basename($image_name);
            move_uploaded_file($_FILES['product_images']['tmp_name'][$key], $target_file);
            $image_paths[] = $target_file;
        }
        $main_image = $image_paths[0]; // Use the first image as the main image
        $additional_images = implode(',', array_slice($image_paths, 1)); // Store additional images as comma-separated values
    } else {
        $main_image = $_POST['current_image'];
        $additional_images = $_POST['current_additional_images'];
    }

    // Update database
    $stmt = $db->prepare("UPDATE products SET name=?, price=?, description=?, image=?, additional_images=?, material=?, sustainability_impact=?, gender=?, type=?, size=?, warranty=?, function=?, category=? WHERE id=?");
    $stmt->bind_param("sdssssssssssssi", $name, $price, $description, $main_image, $additional_images, $material, $sustainability_impact, $gender, $type, $size, $warranty, $function, $category, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: upload-$category.php");
    exit();
} else {
    $id = $_GET['id'];
    $stmt = $db->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="desaincss/upload.css">
</head>
<body>
    <section class="upload-section">
        <div class="upload-container">
            <h1>Edit Product</h1>
            <form method="POST" action="edit_product.php" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                <input type="hidden" name="current_image" value="<?php echo $product['image']; ?>">
                <input type="hidden" name="current_additional_images" value="<?php echo $product['additional_images']; ?>">
                <input type="hidden" name="category" value="<?php echo $product['category']; ?>">
                <div class="form-group">
                    <label for="product_name">Product Name</label>
                    <input type="text" id="product_name" name="product_name" value="<?php echo $product['name']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="product_price">Product Price</label>
                    <input type="number" id="product_price" name="product_price" value="<?php echo $product['price']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="product_description">Product Description</label>
                    <textarea id="product_description" name="product_description" required><?php echo $product['description']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="product_images">Product Images</label>
                    <input type="file" id="product_images" name="product_images[]" accept="image/*" multiple>
                </div>
                <div class="form-group">
                    <label for="material">Material</label>
                    <select id="material" name="material" required>
                        <option value="organik" <?php if ($product['material'] == 'organik') echo 'selected'; ?>>Organik</option>
                        <option value="daur_ulang" <?php if ($product['material'] == 'daur_ulang') echo 'selected'; ?>>Daur Ulang</option>
                        <option value="mudah_terurai" <?php if ($product['material'] == 'mudah_terurai') echo 'selected'; ?>>Mudah Terurai</option>
                        <option value="kayu_alami" <?php if ($product['material'] == 'kayu_alami') echo 'selected'; ?>>Kayu Alami</option>
                        <option value="bambu" <?php if ($product['material'] == 'bambu') echo 'selected'; ?>>Bambu</option>
                        <option value="rotan" <?php if ($product['material'] == 'rotan') echo 'selected'; ?>>Rotan</option>
                        <option value="metal" <?php if ($product['material'] == 'metal') echo 'selected'; ?>>Metal</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sustainability_impact">Dampak Keberlanjutan</label>
                    <select id="sustainability_impact" name="sustainability_impact" required>
                        <option value="bebas_bahan_kimia" <?php if ($product['sustainability_impact'] == 'bebas_bahan_kimia') echo 'selected'; ?>>Bebas Bahan Kimia</option>
                        <option value="bersertifikat_eco_friendly" <?php if ($product['sustainability_impact'] == 'bersertifikat_eco_friendly') echo 'selected'; ?>>Bersertifikat Eco Friendly</option>
                        <option value="hemat-energi" <?php if ($product['sustainability_impact'] == 'hemat-energi') echo 'selected'; ?>>Hemat Energi</option>
                    </select>
                </div>
                <?php if ($product['category'] == 'fashion' || $product['category'] == 'aksesoris' || $product['category'] == 'skincare'): ?>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" required>
                        <option value="pria" <?php if ($product['gender'] == 'pria') echo 'selected'; ?>>Pria</option>
                        <option value="wanita" <?php if ($product['gender'] == 'wanita') echo 'selected'; ?>>Wanita</option>
                        <option value="anak_anak" <?php if ($product['gender'] == 'anak_anak') echo 'selected'; ?>>Anak-anak</option>
                    </select>
                </div>
                <?php endif; ?>
                <?php if ($product['category'] == 'fashion'): ?>
                <div class="form-group">
                    <label for="size">Size</label>
                    <div>
                        <?php
                        $sizes = explode(',', $product['size']);
                        ?>
                        <label><input type="checkbox" name="size[]" value="S" <?php if (in_array('S', $sizes)) echo 'checked'; ?>> S</label>
                        <label><input type="checkbox" name="size[]" value="M" <?php if (in_array('M', $sizes)) echo 'checked'; ?>> M</label>
                        <label><input type="checkbox" name="size[]" value="L" <?php if (in_array('L', $sizes)) echo 'checked'; ?>> L</label>
                        <label><input type="checkbox" name="size[]" value="XL" <?php if (in_array('XL', $sizes)) echo 'checked'; ?>> XL</label>
                        <label><input type="checkbox" name="size[]" value="XXL" <?php if (in_array('XXL', $sizes)) echo 'checked'; ?>> XXL</label>
                    </div>
                </div>
                <?php endif; ?>
                <?php if ($product['category'] == 'furniture' || $product['category'] == 'elektronik'): ?>
                <div class="form-group">
                    <label for="warranty">Garansi</label>
                    <select id="warranty" name="warranty" required>
                        <option value="garansi_1_tahun" <?php if ($product['warranty'] == 'garansi_1_tahun') echo 'selected'; ?>>Garansi 1 Tahun</option>
                        <option value="garansi_2_tahun" <?php if ($product['warranty'] == 'garansi_2_tahun') echo 'selected'; ?>>Garansi 2 Tahun</option>
                        <option value="garansi_3_tahun" <?php if ($product['warranty'] == 'garansi_3_tahun') echo 'selected'; ?>>Garansi 3 Tahun</option>
                    </select>
                </div>
                <?php endif; ?>
                <?php if ($product['category'] == 'furniture'): ?>
                <div class="form-group">
                    <label for="function">Fungsi</label>
                    <select id="function" name="function" required>
                        <option value="indoor" <?php if ($product['function'] == 'indoor') echo 'selected'; ?>>Indoor</option>
                        <option value="outdoor" <?php if ($product['function'] == 'outdoor') echo 'selected'; ?>>Outdoor</option>
                    </select>
                </div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="type">Jenis</label>
                    <select id="type" name="type" required>
                        <option value="kaus" <?php if ($product['type'] == 'kaus') echo 'selected'; ?>>Kaus</option>
                        <option value="celana" <?php if ($product['type'] == 'celana') echo 'selected'; ?>>Celana Panjang</option>
                        <option value="kemeja" <?php if ($product['type'] == 'kemeja') echo 'selected'; ?>>Kemeja</option>
                        <option value="jaket" <?php if ($product['type'] == 'jaket') echo 'selected'; ?>>Jaket</option>
                        <option value="tas" <?php if ($product['type'] == 'tas') echo 'selected'; ?>>Tas</option>
                        <option value="sepatu" <?php if ($product['type'] == 'sepatu') echo 'selected'; ?>>Sepatu</option>
                        <option value="kacamata" <?php if ($product['type'] == 'kacamata') echo 'selected'; ?>>Kacamata</option>
                        <option value="kursi" <?php if ($product['type'] == 'kursi') echo 'selected'; ?>>Kursi</option>
                        <option value="meja" <?php if ($product['type'] == 'meja') echo 'selected'; ?>>Meja</option>
                        <option value="lemari" <?php if ($product['type'] == 'lemari') echo 'selected'; ?>>Lemari</option>
                        <option value="sofa" <?php if ($product['type'] == 'sofa') echo 'selected'; ?>>Sofa</option>
                        <option value="headphone" <?php if ($product['type'] == 'headphone') echo 'selected'; ?>>Headphone</option>
                        <option value="laptop" <?php if ($product['type'] == 'laptop') echo 'selected'; ?>>Laptop</option>
                        <option value="keyboard" <?php if ($product['type'] == 'keyboard') echo 'selected'; ?>>Keyboard</option>
                        <option value="perangkat" <?php if ($product['type'] == 'perangkat') echo 'selected'; ?>>Perangkat rumah tangga</option>
                    </select>
                </div>
                <button type="submit" class="btn">Update</button>
            </form>
            <a href="upload-<?php echo $product['category']; ?>.php">Back to Product List</a>
        </div>
    </section>
</body>
</html>