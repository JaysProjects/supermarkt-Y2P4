<?php
include_once "../class/db_config.php";
include_once "../class/DatabaseConnection.php";
include_once "../class/SalesHandler.php";
include_once "../class/ClientHandler.php";
include_once "../class/ProductHandler.php";

$salesQueryHandler = new SalesHandler($database->getConnection());
$productQueryHandler = new ProductHandler($database->getConnection());
$klanten = new ClientHandler($database->getConnection());

$database->closeConnection();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sales Overview</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/overview.css">
    <script src="../assets/js/clear.js"></script>
    <script type="text/javascript" src="../assets/api/js/getIdentification.js"></script>
</head>
<body>
<a href="../index.php" class="home-link">Home</a><br>
<div class="container">

    <h2>Bestelling overzicht</h2>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $selectedKlantId = isset($_POST['klant']) ? $_POST['klant'] : '';
        if (!empty($selectedKlantId)) {
            $salesData = $salesQueryHandler->getSalesOrdersByKlantId($selectedKlantId);
        } else {
            $salesData = $salesQueryHandler->getSalesData();
        }
    } else {
        $salesData = $salesQueryHandler->getSalesData();
    }

    echo '<table class="order-table">';
    echo '<tr>';
    echo '<th>Order ID</th>';
    echo '<th>Klant ID</th>';
    echo '<th>Artikel ID</th>';
    echo '<th>Order Datum</th>';
    echo '<th>Bestel Aantal</th>';
    echo '<th>Order Status</th>';
    echo '<th>Actions</th>';
    echo '</tr>';

    foreach ($salesData as $sale) {
        echo '<tr>';
        echo '<td>' . $sale['verOrdId'] . '</td>';
        echo '<td>' . $sale['Klanten_klantId'] . '</td>';
        echo '<td>' . $sale['Artikelen_artId'] . '</td>';
        echo '<td>' . $sale['verOrdDatum'] . '</td>';
        echo '<td>' . $sale['verOrdBestAantal'] . '</td>';
        echo '<td>' . $sale['verOrdStatus'] . '</td>';
        echo '<td>';
        echo '<button class="button button-update" onclick="openUpdateModal(' . $sale['verOrdId'] . ')">Update</button>';
        echo '<button class="button button-delete" onclick="deleteOrder(' . $sale['verOrdId'] . ')">Delete</button>';
        echo '</td>';
        echo '</tr>';
    }
    echo '</table>';

    include_once "../assets/js/updateOrder.js.php";
    ?>

    <div class="current-klant">
        <?php
        if (!empty($selectedKlantId)) {
            // Retrieve and display the details of the selected klant
            $selectedKlant = $klanten->getKlantById($selectedKlantId);
            echo "<b>Selected Klant</b> <br><br> KlantId:" . $selectedKlant['klantId'] . "<br> Klant Naam:" . $selectedKlant['klantNaam'];
            echo '<br><button onclick="clearSelectedKlant()" style="">Clear</button><br><hr>';
        }
        ?>

        <br>
        <form method="POST" action="">
            <label for="klant">Select a Klant:</label>
            <select name="klant" id="klant" onchange="this.form.submit()">
                <option value="" disabled selected>Choose here</option>
                <?php
                $klantenList = $klanten->getClientsData();
                foreach ($klantenList as $klant) {
                    echo '<option value="' . $klant['klantId'] . '">' . $klant['klantId'] . ' - ' . $klant['klantNaam'] . '</option>';
                }
                ?>
            </select>
            <noscript><input type="submit" value="Submit"></noscript>
        </form>
    </div>
</div>
</body>
</html>

