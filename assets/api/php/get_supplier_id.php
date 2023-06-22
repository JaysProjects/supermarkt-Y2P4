<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . '/class/db_config.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/class/DatabaseConnection.php');

if (isset($_GET['artId'])) {
    $artId = $_GET['artId'];

    try {
        $sql = 'SELECT levId FROM artikelen WHERE artId = :artId';

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':artId', $artId);

        $stmt->execute();

        $supplierId = $stmt->fetchColumn();

        echo $supplierId;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
