<?php
include_once "../class/db_config.php";
include_once "../class/DatabaseConnection.php";
include_once "../class/ClientHandler.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have the values available from the form submission
    $clientId = $_POST['klantId'];
    $newName = $_POST['klantNaam'];
    $newEmail = $_POST['klantEmail'];
    $newAddress = $_POST['klantAdres'];
    $newPostalCode = $_POST['klantPostcode'];
    $newCity = $_POST['klantWoonplaats'];


    // Assuming you have an instance of your SalesHandler class
    $ClientQueryHandler = new ClientHandler($database->getConnection());

    // Call the updateClient method
    $ClientQueryHandler->updateClient($clientId, $newName, $newEmail, $newAddress, $newPostalCode, $newCity);

    header("Location: ../selections/client.php");
    exit();
}

