<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . '/class/db_config.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/class/DatabaseConnection.php');

if (isset($_GET['artId'])) {
    $artId = $_GET['artId'];

    try {
        // Prepare the SQL statement to retrieve the supplier ID for the selected product
        $sql = 'SELECT levId FROM artikelen WHERE artId = :artId';

        // Prepare the statement
        $stmt = $pdo->prepare($sql);

        // Bind the parameter
        $stmt->bindParam(':artId', $artId);

        // Execute the statement
        $stmt->execute();

        // Fetch the supplier ID
        $supplierId = $stmt->fetchColumn();

        // Return the supplier ID as the response
        echo $supplierId;
    } catch (PDOException $e) {
        // Handle any errors that occur during the query
        echo "Error: " . $e->getMessage();


    }
}
