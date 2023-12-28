<?php
include 'config.php';

// Create inventory table
$sql_inventory = "CREATE TABLE inventory (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    item_name VARCHAR(255) NOT NULL,
    quantity INT(6) NOT NULL,
    price DECIMAL(10, 2) NOT NULL
)";

// Create categories table
$sql_categories = "CREATE TABLE categories (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(50) NOT NULL
)";

// Create suppliers table
$sql_suppliers = "CREATE TABLE suppliers (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    supplier_name VARCHAR(100) NOT NULL,
    contact_person VARCHAR(50),
    phone_number VARCHAR(20)
)";

// Create transactions table
$sql_transactions = "CREATE TABLE transactions (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    item_id INT(6) UNSIGNED,
    transaction_type ENUM('sale', 'purchase') NOT NULL,
    quantity INT(6) NOT NULL,
    transaction_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (item_id) REFERENCES inventory(id)
)";

// Execute queries
if ($conn->query($sql_inventory) === TRUE &&
    $conn->query($sql_categories) === TRUE &&
    $conn->query($sql_suppliers) === TRUE &&
    $conn->query($sql_transactions) === TRUE) {
    echo "Tables created successfully";
} else {
    echo "Error creating tables: " . $conn->error;
}

$conn->close();
?>
