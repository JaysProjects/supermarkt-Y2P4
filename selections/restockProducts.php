<?php
include_once "../class/db_config.php";
include_once "../class/DatabaseConnection.php";
include_once "../class/ProductHandler.php";

$inkoopOrderQueryHandler = new productHandler($database->getConnection());
$inkoopOrders = $inkoopOrderQueryHandler->getInkoopOrders();

$database->closeConnection();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inkooporder Overview</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/overview.css">
    <script type="text/javascript" src="../assets/api/js/getIdentification.js"></script>
</head>
<body>
<a href="../index.php" class="home-link">Home</a><br>
<div class="container">
    <h2>Inkooporder Overzicht</h2>
    <?php
    echo '<table class="order-table">';
    echo '<tr>';
    echo '<th>Inkooporder ID</th>';
    echo '<th>Artikel ID</th>';
    echo '<th>Leverancier ID</th>';
    echo '<th>Datum</th>';
    echo '<th>Bestel Aantal</th>';
    echo '<th>Status</th>';
    echo '<th>Actions</th>';
    echo '</tr>';

    foreach ($inkoopOrders as $inkoopOrder) {
        echo '<tr>';
        echo '<td>' . $inkoopOrder['inkOrdId'] . '</td>';
        echo '<td>' . $inkoopOrder['Artikelen_artId'] . '</td>';
        echo '<td>' . $inkoopOrder['Leveranciers_levId'] . '</td>';
        echo '<td>' . $inkoopOrder['inkOrdDatum'] . '</td>';
        echo '<td>' . $inkoopOrder['inkOrdBestAantal'] . '</td>';
        echo '<td>' . $inkoopOrder['inkOrdStatus'] . '</td>';
        echo '<td>';
//        echo '<button class="button button-update" onclick="openUpdateModal(' . $inkoopOrder['inkOrdId'] . ')">Update</button>';
        echo '<button class="button button-delete" onclick="deleteInkoopOrder(' . $inkoopOrder['inkOrdId'] . ')">Delete</button>';
        echo '</td>';
        echo '</tr>';
    }
    echo '</table>';
    ?>

    <script type="text/javascript">
        function openUpdateModal(inkOrdId) {
            // Add your code to open the update modal for the given inkooporder ID
            console.log("Update modal opened for inkooporder ID: " + inkOrdId);
        }

        // function deleteInkoopOrder(inkOrdId) {
        //     // Add your code to delete the inkooporder with the given inkooporder ID
        //     console.log("Inkooporder deleted with ID: " + inkOrdId);
        // }
    </script>
</div>
</body>
</html>
