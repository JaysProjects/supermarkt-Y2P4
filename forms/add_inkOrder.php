<?php
include_once "../class/db_config.php";
include_once "../class/DatabaseConnection.php";
include_once "../class/SalesHandler.php";
include_once "../class/ClientHandler.php";
include_once "../class/ProductHandler.php";

$productHandler = new ProductHandler($database->getConnection());
?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Create Purchase Order</title>
        <link href="../assets/css/addproduct.css" rel="stylesheet" type="text/css">
    </head>
    <body>
    <div class="container">
        <h2>Create Purchase Order</h2>
        <form method="POST" action="">
            <label for="artId">Product:</label>
            <select name="artId" id="artId" required onchange="getSupplierId(this.value)">
                <option value="" disabled selected>Choose here</option>

                <?php
                $productList = $productHandler->getProducts();
                foreach ($productList as $product) {
                    echo '<option value="' . $product['artId'] . '">' . $product['artOmschrijving'] . '</option>';
                }
                ?>
            </select><br><br>
            <script src="../assets/api/js/getIdentification.js"></script>

            <label for="levId">Supplier ID:</label>
            <input type="text" name="levId" id="levId" required readonly><br><br>

            <label for="amount">Order Amount:</label>
            <input type="number" name="amount" id="amount" required><br><br>

            <input type="submit" name="submit" value="Create Purchase Order">
            <a href="../selections/artikelen.php" class="back-button">Back</a>
        </form>

    </div>
    </body>
    </html>

<?php
if (isset($_POST['submit'])) {
    $artId = $_POST['artId'];
    $amount = $_POST['amount'];

    $productHandler->createPurchaseOrder($artId, $amount);
}
?>