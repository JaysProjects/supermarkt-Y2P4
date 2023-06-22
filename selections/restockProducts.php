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
    <title>Restock Overview</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/overview.css">
    <script type="text/javascript" src="../assets/api/js/getIdentification.js"></script>
</head>
<body>
<a href="../index.php" class="home-link">Home</a><br>
<div class="container">
    <h2>Restock Overview</h2>
    <?php
    echo '<table class="order-table">';
    echo '<tr>';
    echo '<th>Restock ID</th>';
    echo '<th>Product ID</th>';
    echo '<th>Supplier ID</th>';
    echo '<th>Order date</th>';
    echo '<th>Order amount</th>';
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
        echo '<button class="button button-delete" onclick="deleteInkoopOrder(' . $inkoopOrder['inkOrdId'] . ')">Delete</button>';
        echo '</td>';
        echo '</tr>';
    }
    echo '</table>';
    ?>

    <script type="text/javascript">
        function openUpdateModal(inkOrdId) {
            console.log("Update modal opened for inkooporder ID: " + inkOrdId);
        }
    </script>
</div>
</body>
</html>
