<a href="../index.php">Home</a><br>
<?php
include_once "../class/db_config.php";
include_once "../class/DatabaseConnection.php";
include_once "../class/SalesHandler.php";

$salesQueryHandler = new SalesHandler($database->getConnection());
$salesData = $salesQueryHandler->getSalesData();

foreach ($salesData as $sale) {
    echo "klantId: {$sale['Klanten_klantId']}, ArtikelId: {$sale['Artikelen_artId']}, Order Datum: {$sale['verOrdDatum']}, Bestel Aantal: {$sale['verOrdBestAantal']}, Order Status: {$sale['verOrdStatus']}<br>";
}

$database->closeConnection();

