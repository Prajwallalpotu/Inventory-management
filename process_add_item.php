<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Item</title>
    <link rel="stylesheet" href="index2.css">
</head>
<body>
<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_name = $_POST["item_name"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];
    $category_id = $_POST["category"];
    $supplier_id = $_POST["supplier"];

    // Insert category if it doesn't exist
    //$insert_category_sql = "INSERT IGNORE INTO categories (category_name) VALUES ('Uncategorized')";
    //$conn->query($insert_category_sql);

    // Retrieve or insert supplier if it doesn't exist
    $get_supplier_sql = "SELECT id, supplier_name FROM suppliers WHERE id = $supplier_id";
    $supplier_result = $conn->query($get_supplier_sql);

    if ($supplier_result->num_rows === 0) {
        // Insert a default supplier if not found
        $insert_supplier_sql = "INSERT INTO suppliers (supplier_name) VALUES ('Unknown')";
        $conn->query($insert_supplier_sql);

        // Retrieve the id of the last inserted supplier
        $supplier_id = $conn->insert_id;
    } else {
        // Retrieve the actual supplier name
        $supplier_data = $supplier_result->fetch_assoc();
        $supplier_id = $supplier_data['id'];
    }

    // Retrieve the actual category name
    $get_category_sql = "SELECT category_name FROM categories WHERE id = $category_id";
    $category_result = $conn->query($get_category_sql);
    $category_name = ($category_result->num_rows > 0) ? $category_result->fetch_assoc()['category_name'] : 'Uncategorized';

    // Insert item into the inventory table
    $insert_inventory_sql = "INSERT INTO inventory (item_name, quantity, price, category_id, supplier_id) VALUES ('$item_name', $quantity, $price, $category_id, $supplier_id)";
    
    if ($conn->query($insert_inventory_sql) === TRUE) {
        echo '<div class="success-message">';
        echo "<center>Item added successfully.</center>";

        // Retrieve the id of the last inserted item
        $last_item_id = $conn->insert_id;

        // Insert transaction details into the transactions table
        $insert_transaction_sql = "INSERT INTO transactions (item_id, transaction_type, quantity) VALUES ($last_item_id, 'purchase', $quantity)";

        if ($conn->query($insert_transaction_sql) === TRUE) {
            echo " <center>Transaction recorded.</center>";
            echo '</div>';

            // Add two buttons
            echo '<form action="add_item.php" method="post">';
            echo '<input type="submit" class="button" value="Add One More Item">';
            echo '</form>';

            echo '<center><a href="index.php" class="button">Go to Inventory List</a></center>';
        } else {
            echo "Error recording transaction: " . $conn->error;
        }

    } else {
        echo "Error adding item: " . $conn->error;
    }
}

$conn->close();
?>
</body>
</html>
