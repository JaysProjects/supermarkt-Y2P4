<a href="../index.php">Home</a><br>
<?php
include_once "../class/db_config.php";
include_once "../class/DatabaseConnection.php";
include_once "../class/ProductHandler.php";

$productQueryHandler = new ProductHandler($database->getConnection());
$products = $productQueryHandler->getProducts();


// Output the results
foreach ($products as $product) {
    echo "artId: {$product['artId']}, levId: {$product['levId']}, artOmschrijving: {$product['artOmschrijving']}, artVoorraad: {$product['artVoorraad']}, artMinVoorraad: {$product['artMinVoorraad']}, artMaxVoorraad: {$product['artMaxVoorraad']}<br>";
}