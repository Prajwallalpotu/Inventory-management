<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Item</title>
    <link rel="stylesheet" href="index2.css">
</head>
<body>
    <center><h1>Add Item to Inventory</h1></center>

    <?php
    include 'config.php';

    // Fetch categories from the database
    $categoryQuery = "SELECT * FROM categories";
    $categoryResult = $conn->query($categoryQuery);

    // Fetch suppliers from the database
    $supplierQuery = "SELECT * FROM suppliers";
    $supplierResult = $conn->query($supplierQuery);

    if ($categoryResult->num_rows > 0 && $supplierResult->num_rows > 0) {
        echo '<form action="process_add_item.php" method="post">';
        echo '<label for="item_name">Item Name:</label>';
        echo '<input type="text" name="item_name" required><br>';
        echo '<label for="quantity">Quantity:</label>';
        echo '<input type="number" name="quantity" required><br>';
        echo '<label for="price">Price:</label>';
        echo '<input type="number" name="price" step="0.01" required><br>';
        
        // Category selection dynamically populated from the database
        echo '<label for="category">Category:</label>';
        echo '<select name="category" required>';
        
        while ($categoryRow = $categoryResult->fetch_assoc()) {
            echo '<option value="' . $categoryRow['id'] . '">' . $categoryRow['category_name'] . '</option>';
        }
        
        echo '</select><br>';
        
        // Supplier selection dynamically populated from the database
        echo '<label for="supplier">Supplier:</label>';
        echo '<select name="supplier" required>';
        
        while ($supplierRow = $supplierResult->fetch_assoc()) {
            echo '<option value="' . $supplierRow['id'] . '">' . $supplierRow['supplier_name'] . '</option>';
        }
        
        echo '</select><br><br>';

        echo '<input type="submit" value="Add Item">';
        echo '</form>';
    } else {
        echo '<p>No categories or suppliers found. Add them in the <a href="add_category.php">Add Category</a> and <a href="add_supplier.php">Add Supplier</a> pages.</p>';
    }

    $conn->close();
    ?>

    <div class="button-container">
        <a href="index.php" class="button">Go back to Inventory</a>
    </div>
</body>
</html>