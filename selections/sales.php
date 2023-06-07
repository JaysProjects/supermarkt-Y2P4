<a href="../index.php">Home</a><br>
<?php
include_once "../class/db_config.php";
include_once "../class/DatabaseConnection.php";
include_once "../class/SalesHandler.php";
include_once "../class/ClientHandler.php";

$salesQueryHandler = new SalesHandler($database->getConnection());
$klanten = new ClientHandler($database->getConnection());

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedKlantId = $_POST['klant'];
    if (!empty($selectedKlantId)) {
        $salesData = $salesQueryHandler->getSalesOrdersByKlantId($selectedKlantId);
    } else {
        $salesData = $salesQueryHandler->getSalesData();
    }
}else{
    $salesData = $salesQueryHandler->getSalesData();
}

    foreach ($salesData as $sale) {
        echo "klantId: {$sale['Klanten_klantId']}, ArtikelId: {$sale['Artikelen_artId']}, Order Datum: {$sale['verOrdDatum']}, Bestel Aantal: {$sale['verOrdBestAantal']}, Order Status: {$sale['verOrdStatus']}<br>";
    }

$database->closeConnection();
?>

<!DOCTYPE html>
<html>
<head>
    <title>New Sales Overview</title>
</head>
<body>
<form method="POST" action="">
    <label for="klant">Select a Klant:</label>
    <select name="klant" id="klant" onchange="this.form.submit()">
        <option value="" disabled selected>Choose here</option>
        <?php
        $klantenList = $klanten->getKlanten();
        foreach ($klantenList as $klant) {
            echo '<option value="' . $klant['klantId'] . '">' . $klant['klantId'] . ' - ' . $klant['klantNaam'] . '</option>';        }

        ?>
    </select>
    <noscript><input type="submit" value="Submit"></noscript>
</form>

</body>
</html>

