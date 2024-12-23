<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Fashion Product</title>
    <link rel="stylesheet" href="desaincss/upload.css">
</head>
<body>
    <section class="upload-section">
        <div class="upload-container">
            <h1>Upload Fashion Product</h1>
            <form method="POST" action="upload_process.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="product_name">Product Name</label>
                    <input type="text" id="product_name" name="product_name" required>
                </div>
                <div class="form-group">
                    <label for="product_price">Product Price</label>
                    <input type="number" id="product_price" name="product_price" required>
                </div>
                <div class="form-group">
                    <label for="product_description">Product Description</label>
                    <textarea id="product_description" name="product_description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="product_image">Product Image</label>
                    <input type="file" id="product_images" name="product_images[]" accept="image/*" multiple required>
                </div>
                <div class="form-group">
                    <label for="product_stock">Stok</label>
                    <input type="number" id="product_stock" name="product_stock" required>
                </div>
                <div class="form-group">
                    <label for="material">Material</label>
                    <select id="material" name="material" required>
                        <option value="organik">Organik</option>
                        <option value="daur_ulang">Daur Ulang</option>
                        <option value="mudah_terurai">Mudah Terurai</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sustainability_impact">Dampak Keberlanjutan</label>
                    <select id="sustainability_impact" name="sustainability_impact" required>
                        <option value="bebas_bahan_kimia">Bebas Bahan Kimia</option>
                        <option value="bersertifikat_eco_friendly">Bersertifikat Eco Friendly</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" required>
                        <option value="pria">Pria</option>
                        <option value="wanita">Wanita</option>
                        <option value="anak_anak">Anak-anak</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="size">Size</label>
                    <div>
                        <label><input type="checkbox" name="size[]" value="S"> S</label>
                        <label><input type="checkbox" name="size[]" value="M"> M</label>
                        <label><input type="checkbox" name="size[]" value="L"> L</label>
                        <label><input type="checkbox" name="size[]" value="XL"> XL</label>
                        <label><input type="checkbox" name="size[]" value="XXL"> XXL</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="type">Jenis</label>
                    <select id="type" name="type" required>
                        <option value="kaus">Kaus</option>
                        <option value="celana">Celana Panjang</option>
                        <option value="kemeja">Kemeja</option>
                        <option value="jaket">Jaket</option>
                    </select>
                </div>
                <input type="hidden" name="category" value="fashion">
                <button type="submit" class="btn">Upload</button>
            </form>
            <a href="cateogry-upload.php">Back to Category Selection</a>
        </div>
        <div class="product-list-container">
            <h1>Product List</h1>
            <div class="display-product-table">
                <table>
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- PHP code to fetch and display products from the database -->
                        <?php
                        include 'config.php';
                        $result = $db->query("SELECT * FROM products");
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td><img src='" . $row['image'] . "' alt='Product Image'></td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['price'] . "</td>";
                            echo "<td>" . $row['description'] . "</td>";
                            echo "<td>
                                    <a href='edit_product.php?id=" . $row['id'] . "&category=fashion' class='option-btn'>Edit</a>
                                    <a href='delete_product.php?id=" . $row['id'] . "' class='delete-btn'>Delete</a>
                                  </td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</body>
</html>