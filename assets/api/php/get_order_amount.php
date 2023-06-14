<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . '/class/db_config.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/class/DatabaseConnection.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/class/SalesHandler.php');

$verOrdId = $_GET['verOrdId'];
$salesQueryHandler = new SalesHandler($database->getConnection());

$salesData = $salesQueryHandler->getSalesData($verOrdId);

if (isset($_GET['verOrdId'])) {
    $verOrdId = $_GET['verOrdId'];
    $orderDetails = $salesQueryHandler->getOrderById($verOrdId);
    $verOrdBestAantal = $orderDetails['verOrdBestAantal'];

    echo $verOrdBestAantal;
}