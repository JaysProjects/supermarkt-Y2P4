<?php
include_once "../class/db_config.php";
include_once "../class/DatabaseConnection.php";
include_once "../class/SalesHandler.php";
include_once "../class/ClientHandler.php";
include_once "../class/ProductHandler.php";

$salesFormHandler = new SalesHandler($database->getConnection());
$klanten = new ClientHandler($database->getConnection());
$productHandler = new ProductHandler($database->getConnection());

$salesFormHandler->handleCreateOrder();

$database->closeConnection();
?>

<!DOCTYPE html>
<html>
<head>
    <title>New Sales Form</title>
    <link href="../assets/css/addproduct.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">
    <h2>New order</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="klantId">Client:</label>
        <select name="klantId" id="klantId" required>
            <option value="" disabled selected>Choose here</option>
            <?php
            $klantenList = $klanten->getClientsData();
            foreach ($klantenList as $klant) {
                echo '<option value="' . $klant['klantId'] . '">' . $klant['klantId'] . ' - ' . $klant['klantNaam'] . '</option>';
            }
            ?>
        </select><br><br>

        <label for="artId">Product:</label>
        <select name="artId" id="artId" required>
            <option value="" disabled selected>Choose here</option>
            <?php
            $productList = $productHandler->getProducts();
            foreach ($productList as $product) {
                echo '<option value="' . $product['artId'] . '">' . $product['artOmschrijving'] . '</option>';
            }
            ?>
        </select><br><br>

        <label for="verOrdBestAantal">Order amount: </label>
        <input type="text" id="verOrdBestAantal" name="verOrdBestAantal" required><br><br>

        <input type="submit" value="Submit">
        <a href="../selections/sales.php" class="back-button">Back</a>
    </form>
</div>
</body>
</html>
