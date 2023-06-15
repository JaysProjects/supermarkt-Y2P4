<?php

class ProductHandler
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getProducts()
    {
        try {
            // Prepare the SQL statement
            $stmt = $this->pdo->query('SELECT * FROM artikelen');

            // Fetch all rows as an associative array
            $artikelen = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $artikelen;
        } catch (PDOException $e) {
            // Handle any errors that occur during the query
            echo "Error: " . $e->getMessage();
        }
    }

    public function getInkoopOrders()
    {
        try {
            // Prepare the SQL statement
            $stmt = $this->pdo->query('SELECT * FROM inkooporders');

            // Fetch all rows as an associative array
            $inkooporders = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $inkooporders;
        } catch (PDOException $e) {
            // Handle any errors that occur during the query
            echo "Error: " . $e->getMessage();
        }
    }

    public function deleteInkOrder($inkOrdId) {
        try {
            // Prepare the SQL statement for deleting the order by verOrdId
            $sql = 'DELETE FROM inkooporders WHERE inkOrdId = :inkOrdId';

            // Prepare the statement
            $stmt = $this->pdo->prepare($sql);

            // Bind the parameter
            $stmt->bindParam(':inkOrdId', $inkOrdId);

            // Execute the statement
            $stmt->execute();

            return "test";
        } catch (PDOException $e) {
            // Handle any errors that occur during the deletion
            echo "Error: " . $e->getMessage();
        }
    }

    public function getProductSupplier($artId)
    {
        try {
            // Prepare the SQL statement to retrieve the supplier ID for the selected product
            $sql = 'SELECT levId FROM artikelen WHERE artId = :artId';

            // Prepare the statement
            $stmt = $this->pdo->prepare($sql);

            // Bind the parameter
            $stmt->bindParam(':artId', $artId);

            // Execute the statement
            $stmt->execute();

            // Fetch the supplier ID
            $supplierId = $stmt->fetchColumn();

            return $supplierId;
        } catch (PDOException $e) {
            // Handle any errors that occur during the query
            echo "Error: " . $e->getMessage();
        }
    }

    public function createPurchaseOrder($artId, $amount) {
        try {
            // Get the supplier ID for the selected product
            $levId = $this->getProductSupplier($artId);

            // Prepare the SQL statement for inserting a new purchase order
            $sql = 'INSERT INTO inkooporders (Artikelen_artId, Leveranciers_levId, inkOrdDatum, inkOrdBestAantal, inkOrdStatus) 
                    VALUES (:artId, :levId, CURDATE(), :amount, 1)';

            // Prepare the statement
            $stmt = $this->pdo->prepare($sql);

            // Bind the parameters
            $stmt->bindParam(':artId', $artId);
            $stmt->bindParam(':levId', $levId);
            $stmt->bindParam(':amount', $amount);

            // Execute the statement
            $stmt->execute();

            echo "Purchase order created successfully.";
        } catch (PDOException $e) {
            // Handle any errors that occur during the query
            echo "Error: " . $e->getMessage();
        }
    }

    public function deleteProduct($artId) {
        try {
            $sql = 'DELETE FROM artikelen WHERE artId = :artId';

            $stmt = $this->pdo->prepare($sql);

            $stmt->bindParam(':artId', $artId);

            $stmt->execute();
        } catch (PDOException $e) {
            // Handle any errors that occur during the deletion
            echo "Error: " . $e->getMessage();
        }
    }
}