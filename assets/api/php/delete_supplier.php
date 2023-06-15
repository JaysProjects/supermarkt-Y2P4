<?php

include_once ($_SERVER['DOCUMENT_ROOT'] . '/class/db_config.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/class/DatabaseConnection.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/class/SupplierHandler.php');


if (isset($_GET['levId'])) {
    $levId = $_GET['levId'];

    $SupplierQueryHandler = new SupplierHandler($database->getConnection());

    $SupplierQueryHandler->deleteSupplier($levId);
}


