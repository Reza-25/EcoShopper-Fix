<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['product_name'];
    $price = $_POST['product_price'];
    $description = $_POST['product_description'];
    $stock = $_POST['product_stock'];
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
    foreach ($_FILES['product_images']['name'] as $key => $image_name) {
        $target_file = $target_dir . basename($image_name);
        move_uploaded_file($_FILES['product_images']['tmp_name'][$key], $target_file);
        $image_paths[] = $target_file;
    }
    $main_image = $image_paths[0]; // Use the first image as the main image
    $additional_images = implode(',', array_slice($image_paths, 1)); // Store additional images as comma-separated values

    // Insert into database
    $stmt = $db->prepare("INSERT INTO products (name, price, description, image, additional_images, category, material, sustainability_impact, gender, type, size, warranty, function) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sdsssssssssss", $name, $price, $description, $main_image, $additional_images, $category, $material, $sustainability_impact, $gender, $type, $size, $warranty, $function);
    $stmt->execute();
    $stmt->close();

    header("Location: upload-$category.php");
}
?>