<?php

include_once ($_SERVER['DOCUMENT_ROOT'] . '/class/db_config.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/class/DatabaseConnection.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/class/ClientHandler.php');

$clientQueryHandler = new ClientHandler($database->getConnection());


$klantId = $_GET['klantId'];
echo $klantId;


$result = $clientQueryHandler->deleteClientAndOrders($klantId);

if ($result) {
    http_response_code(200); // Success status code
} else {
    http_response_code(500); // Internal server error status code
}



