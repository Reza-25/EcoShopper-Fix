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
            <h1>Upload Elektronik Product</h1>
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
                        <option value="daur-ulang">Daur Ulang</option>
                        <option value="reuseable">Reuseable</option>
                        <option value="zero-waste">Zero Waste</option>
                        <option value="biodegredable">Mudah Terurai</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sustainability_impact">Dampak Keberlanjutan</label>
                    <select id="sustainability_impact" name="sustainability_impact">
                        <option value="hemat-energi">Hemat Energi</option>
                        <option value="kimia">Bebas bahan kimia</option>
                        <option value="sertifikat">Ber-sertifikat Eco-Friendly</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="warranty">Garansi</label>
                    <select id="warranty" name="warranty">
                        <option value="garansi1">Garansi 1 Tahun</option>
                        <option value="garansi2">Garansi 2 Tahun</option>
                        <option value="garansi3">Garansi 3 Tahun++</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="type">Jenis</label>
                    <select id="type" name="type">
                        <option value="headphone">Headphone</option>
                        <option value="laptop">Laptop</option>
                        <option value="keyboard">Keyboard</option>
                        <option value="perangkat">Perangkat rumah tangga</option>
                    </select>
                </div>
                <input type="hidden" name="category" value="elektronik">
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
                                    <a href='edit_product.php?id=" . $row['id'] . "&category=elektronik' class='option-btn'>Edit</a>
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