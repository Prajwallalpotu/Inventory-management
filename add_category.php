<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <link rel="stylesheet" href="index2.css"> <!-- Add your CSS file link -->
</head>
<body>
    <center><h1>Add Category</h1> </center>

    <?php
    include 'config.php';

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $categoryName = $_POST["category_name"];

        // Insert data into the categories table
        $insertCategorySql = "INSERT INTO categories (category_name) VALUES ('$categoryName')";

        if ($conn->query($insertCategorySql) === TRUE) {
            echo "<p>Category added successfully.</p>";
        } else {
            echo "<p>Error adding category: " . $conn->error . "</p>";
        }
    }
    ?>

    <!-- Category Form -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="category_name">Category Name:</label>
        <input type="text" id="category_name" name="category_name" required><br><br>

        <button type="submit" class="btn">Add Category</button>
    </form>

    <center><a href="index.php" class="button">Go back to Inventory</a> </center>
</body>
</html>
