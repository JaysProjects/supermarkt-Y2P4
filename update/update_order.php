<?php
include_once "../class/db_config.php";
include_once "../class/DatabaseConnection.php";
include_once "../class/SalesHandler.php";
include_once "../class/ProductHandler.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $verOrdId = $_POST['verOrdId'];
    $newStatus = $_POST['status'];
    $newAmount = $_POST['amount'];
    $newArtId = $_POST['artId'];

    $salesQueryHandler = new SalesHandler($database->getConnection());

    $salesQueryHandler->updateOrder($verOrdId, $newStatus, $newAmount, $newArtId);

    header("Location: ../selections/sales.php");
    exit();
}

