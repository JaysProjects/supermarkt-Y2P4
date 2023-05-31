<?php
include_once "../class/db_config.php";
include_once "../class/DatabaseConnection.php";
include_once "../class/SalesHandler.php";

$salesFormHandler = new SalesHandler($database->getConnection());
$salesFormHandler->handleFormSubmission();

$database->closeConnection();
?>

<!DOCTYPE html>
<html>
<head>
    <title>New Sales Form</title>
</head>
<body>
    <h2>New Sales Form</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="klantId">Klanten_klantId:</label>
        <input type="text" id="klantId" name="klantId" required><br><br>

        <label for="artId">Artikelen_artId:</label>
        <input type="text" id="artId" name="artId" required><br><br>

        <label for="verOrdBestAantal">verOrdBestAantal:</label>
        <input type="text" id="verOrdBestAantal" name="verOrdBestAantal" required><br><br>

        <label for="verOrdStatus">verOrdStatus:</label>
        <input type="text" id="verOrdStatus" name="verOrdStatus" required><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>


