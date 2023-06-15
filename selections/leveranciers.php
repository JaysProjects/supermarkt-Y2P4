<?php
include_once "../class/db_config.php";
include_once "../class/DatabaseConnection.php";
include_once "../class/SupplierHandler.php";

$supplierQueryHandler = new SupplierHandler($database->getConnection());
$suppliers = $supplierQueryHandler->getSupplierData();

$database->closeConnection();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Supplier Overview</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/overview.css">
    <script type="text/javascript" src="../assets/api/js/getIdentification.js"></script>
</head>


<body>
<a href="../index.php" class="home-link">Home</a><br>
<div class="container">
    <h2>Supplier overzicht</h2>
    <?php
    echo '<table class="order-table">';
    echo '<tr>';
    echo '<th>Supplier ID</th>';
    echo '<th>Supplier Name</th>';
    echo '<th>Contact Person</th>';
    echo '<th>Email</th>';
    echo '<th>Address</th>';
    echo '<th>Postal Code</th>';
    echo '<th>City</th>';
    echo '<th>Actions</th>';
    echo '</tr>';

    foreach ($suppliers as $supplier) {
        echo '<tr>';
        echo '<td>' . $supplier['levId'] . '</td>';
        echo '<td>' . $supplier['levNaam'] . '</td>';
        echo '<td>' . $supplier['levContact'] . '</td>';
        echo '<td>' . $supplier['levEmail'] . '</td>';
        echo '<td>' . $supplier['levAdres'] . '</td>';
        echo '<td>' . $supplier['levPostcode'] . '</td>';
        echo '<td>' . $supplier['levWoonplaats'] . '</td>';
        echo '<td>';
//        echo '<button class="button button-update" onclick="openUpdateModal(' . $supplier['levId'] . ')">Update</button>';
        echo '<button class="button button-delete" onclick="deleteSupplier(' . $supplier['levId'] . ')">Delete</button>';
        echo '</td>';
        echo '</tr>';
    }
    echo '</table>';
    ?>

    <script type="text/javascript">
        function openUpdateModal(supplierId) {
            // Add your code to open the update modal for the given supplier ID
            console.log("Update modal opened for supplier ID: " + supplierId);
        }

        // function deleteSupplier(supplierId) {
        //     // Add your code to delete the supplier with the given supplier ID
        //     console.log("Supplier deleted with ID: " + supplierId);
        // }
    </script>
</div>
</body>
</html>
