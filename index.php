<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System</title>
    <link rel="stylesheet" href="index2.css">
</head>
<body>
    <center><h1>Inventory Management System</h1></center>

    <!-- Add three buttons -->
    <div class="button-container">
        <a href="add_item.php" class="button">Add Item</a>
        <a href="add_supplier.php" class="button">Add Supplier</a>
        <a href="add_category.php" class="button">Add Category</a>
    </div>

    <!-- Display your inventory here -->
    <?php
        include 'config.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["remove_item"])) {
            $item_id_to_remove = $_POST["remove_item"];

            // Delete from transactions
            $delete_transactions_sql = "DELETE FROM transactions WHERE item_id = $item_id_to_remove";
            $conn->query($delete_transactions_sql);

            // Delete from inventory
            $delete_inventory_sql = "DELETE FROM inventory WHERE id = $item_id_to_remove";
            $conn->query($delete_inventory_sql);
        }

        $sql = "SELECT inventory.*, categories.category_name, suppliers.supplier_name FROM inventory
                LEFT JOIN categories ON inventory.category_id = categories.id
                LEFT JOIN suppliers ON inventory.supplier_id = suppliers.id";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Item Name</th><th>Quantity</th><th>Price</th><th>Category</th><th>Supplier</th><th>Action</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['item_name']}</td>";
                echo "<td>{$row['quantity']}</td>";
                echo "<td>{$row['price']}</td>";
                echo "<td>{$row['category_name']}</td>";
                echo "<td>{$row['supplier_name']}</td>";
                echo '<td><form method="post"><input type="hidden" name="remove_item" value="' . $row['id'] . '"><input type="submit" value="Remove"></form></td>';
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No items in the inventory.";
        }

        $conn->close();
    ?>
</body>
</html>
