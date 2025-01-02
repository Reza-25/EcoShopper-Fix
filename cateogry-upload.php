<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Category</title>
    <link rel="stylesheet" href="desaincss/upload.css">
    <script>
        function redirectToCategoryPage() {
            const categories = document.getElementsByName('category');
            let selectedCategory;
            for (const category of categories) {
                if (category.checked) {
                    selectedCategory = category.value;
                    break;
                }
            }
            if (selectedCategory) {
                window.location.href = `upload-${selectedCategory}.php`;
            }
        }
    </script>
</head>
<body>
    <section class="category-section">
        <div class="category-container">
            <h1>Produk apa yang mau kamu upload?</h1>
            <form>
                <div class="form-group">
                    <label>
                        <input type="radio" name="category" value="fashion" required onclick="redirectToCategoryPage()">
                        Fashion
                    </label>
                </div>
                <div class="form-group">
                    <label>
                        <input type="radio" name="category" value="aksesoris" required onclick="redirectToCategoryPage()">
                        Aksesoris
                    </label>
                </div>
                <div class="form-group">
                    <label>
                        <input type="radio" name="category" value="furniture" required onclick="redirectToCategoryPage()">
                        Furniture
                    </label>
                </div>
                <div class="form-group">
                    <label>
                        <input type="radio" name="category" value="skincare" required onclick="redirectToCategoryPage()">
                        Skin Care
                    </label>
                </div>
                <div class="form-group">
                    <label>
                        <input type="radio" name="category" value="elektronik" required onclick="redirectToCategoryPage()">
                        Elektronik
                    </label>
                </div>
            </form>
        </div>
    </section>
</body>
</html>