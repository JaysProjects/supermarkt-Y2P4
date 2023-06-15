<?php
include_once "../class/db_config.php";
include_once "../class/DatabaseConnection.php";
include_once "../class/ProductHandler.php";

$productQueryHandler = new ProductHandler($database->getConnection());
$products = $productQueryHandler->getProducts();

$database->closeConnection();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Overview</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/overview.css">
    <script type="text/javascript" src="../assets/api/js/getIdentification.js"></script>
</head>
<body>
<a href="../index.php" class="home-link">Home</a><br>
<div class="container">
    <h2>Artikelen overzicht</h2>
    <?php
    echo '<table class="order-table">';
    echo '<tr>';
    echo '<th>Art ID</th>';
    echo '<th>Lev ID</th>';
    echo '<th>Omschrijving</th>';
    echo '<th>Voorraad</th>';
    echo '<th>Min Voorraad</th>';
    echo '<th>Max Voorraad</th>';
    echo '<th>Actions</th>';
    echo '</tr>';

    foreach ($products as $product) {
        echo '<tr>';
        echo '<td>' . $product['artId'] . '</td>';
        echo '<td>' . $product['levId'] . '</td>';
        echo '<td>' . $product['artOmschrijving'] . '</td>';
        echo '<td>' . $product['artVoorraad'] . '</td>';
        echo '<td>' . $product['artMinVoorraad'] . '</td>';
        echo '<td>' . $product['artMaxVoorraad'] . '</td>';
        echo '<td>';
//        echo '<button class="button button-update" onclick="openUpdateModal(' . $product['artId'] . ')">Update</button>';
        echo '<button class="button button-delete" onclick="deleteProduct(' . $product['artId'] . ')">Delete</button>';
        echo '</td>';
        echo '</tr>';
    }
    echo '</table>';
    ?>
</div>
</body>
</html>
