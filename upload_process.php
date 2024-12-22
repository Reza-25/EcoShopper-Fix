<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
    $target_file = $target_dir . basename($_FILES["product_image"]["name"]);
    move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file);

    // Insert into database
    $stmt = $db->prepare("INSERT INTO products (name, price, description, image, category, material, sustainability_impact, gender, type, size, warranty, function) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sdssssssssss", $name, $price, $description, $target_file, $category, $material, $sustainability_impact, $gender, $type, $size, $warranty, $function);
    $stmt->execute();
    $stmt->close();

    header("Location: upload-$category.php");
}
?>