<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . '/class/db_config.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/class/DatabaseConnection.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/class/ClientHandler.php');

$clientId = $_GET['klantId'];
$clientQueryHandler = new clientHandler($database->getConnection());

if (isset($_GET['klantId'])) {
    $verOrdId = $_GET['klantId'];

    $clientDetails = $clientQueryHandler->getKlantById($clientId);
    header('Content-Type: application/json');
    echo json_encode($clientDetails);
}