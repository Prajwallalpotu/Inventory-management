<!-- add_supplier.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Supplier</title>
    <link rel="stylesheet" href="index2.css">
</head>
<body>
    <center> <h1>Add Supplier</h1></center>

    <?php
    include 'config.php';

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $supplierName = $_POST["supplier_name"];
        $contactPerson = $_POST["contact_person"];
        $phoneNumber = $_POST["phone_number"];

        // Insert data into the suppliers table
        $insertSupplierSql = "INSERT INTO suppliers (supplier_name, contact_person, phone_number) VALUES ('$supplierName', '$contactPerson', '$phoneNumber')";

        if ($conn->query($insertSupplierSql) === TRUE) {
            echo "<p>Supplier added successfully.</p>";
        } else {
            echo "<p>Error adding supplier: " . $conn->error . "</p>";
        }
    }
    ?>

    <!-- Supplier Form -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="supplier_name">Supplier Name:</label>
        <input type="text" id="supplier_name" name="supplier_name" required>

        <label for="contact_person">Contact Person:</label>
        <input type="text" id="contact_person" name="contact_person" required>

        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number" required><br><br>

        <button type="submit" class="btn">Add Supplier</button>
    </form>

    <center> <a href="index.php" class="button">Go back to Inventory</a> </center>
</body>
</html>
