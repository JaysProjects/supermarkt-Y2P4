<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . '/class/db_config.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/class/DatabaseConnection.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/class/SalesHandler.php');

$verOrdId = $_GET['verOrdId'];
$salesQueryHandler = new SalesHandler($database->getConnection());

if (isset($_GET['verOrdId'])) {
    $verOrdId = $_GET['verOrdId'];

    $orderDetails = $salesQueryHandler->getOrderById($verOrdId);
    $verOrdStatus = $orderDetails['verOrdStatus'];

    echo $verOrdStatus;
}