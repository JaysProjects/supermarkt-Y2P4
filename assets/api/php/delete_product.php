<?php

include_once ($_SERVER['DOCUMENT_ROOT'] . '/class/db_config.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/class/DatabaseConnection.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/class/ProductHandler.php');


if (isset($_GET['artId'])) {
    $artId = $_GET['artId'];

    $productQueryHandler = new ProductHandler($database->getConnection());

    $productQueryHandler->deleteProduct($artId);
}


