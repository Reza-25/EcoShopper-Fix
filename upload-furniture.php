<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Furniture Product</title>
    <link rel="stylesheet" href="desaincss/upload.css">
</head>
<body>
    <section class="upload-section">
        <div class="upload-container">
            <h1>Upload Furniture Product</h1>
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
                        <option value="kayu_alami">Kayu Alami</option>
                        <option value="bambu">Bambu</option>
                        <option value="rotan">Rotan</option>
                        <option value="metal">Metal</option>
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
                    <label for="warranty">Garansi</label>
                    <select id="warranty" name="warranty" required>
                        <option value="garansi_1_tahun">garasni 1 tahun</option>
                        <option value="garansi_2_tahun">garasni 2 tahun</option>
                        <option value="garansi_3_tahun">garasni 3 tahun++</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="function">Fungsi</label>
                    <select id="function" name="function" required>
                        <option value="indoor">indoor</option>
                        <option value="outdoor">outdoor</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="type">Jenis</label>
                    <select id="type" name="type" required>
                        <option value="kursi">Kursi</option>
                        <option value="meja">Meja</option>
                        <option value="lemari">Lemari</option>
                        <option value="sofa">Sofa</option>
                    </select>
                </div>
                <input type="hidden" name="category" value="furniture">
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
                                    <a href='edit_product.php?id=" . $row['id'] . "&category=furniture' class='option-btn'>Edit</a>
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