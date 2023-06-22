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
            $stmt = $this->pdo->query('SELECT * FROM artikelen');

            $artikelen = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $artikelen;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getInkoopOrders()
    {
        try {
            $stmt = $this->pdo->query('SELECT * FROM inkooporders');

            $inkooporders = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $inkooporders;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function deleteInkOrder($inkOrdId) {
        try {
            $sql = 'DELETE FROM inkooporders WHERE inkOrdId = :inkOrdId';

            $stmt = $this->pdo->prepare($sql);

            $stmt->bindParam(':inkOrdId', $inkOrdId);

            $stmt->execute();

            return "test";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getProductSupplier($artId)
    {
        try {
            $sql = 'SELECT levId FROM artikelen WHERE artId = :artId';

            $stmt = $this->pdo->prepare($sql);

            $stmt->bindParam(':artId', $artId);

            $stmt->execute();

            $supplierId = $stmt->fetchColumn();

            return $supplierId;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function createPurchaseOrder($artId, $amount) {
        try {
            $levId = $this->getProductSupplier($artId);

            $sql = 'INSERT INTO inkooporders (Artikelen_artId, Leveranciers_levId, inkOrdDatum, inkOrdBestAantal, inkOrdStatus) 
                    VALUES (:artId, :levId, CURDATE(), :amount, 1)';

            $stmt = $this->pdo->prepare($sql);

            $stmt->bindParam(':artId', $artId);
            $stmt->bindParam(':levId', $levId);
            $stmt->bindParam(':amount', $amount);

            $stmt->execute();

            echo "Purchase order created successfully.";
        } catch (PDOException $e) {
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
            echo "Error: " . $e->getMessage();
        }
    }
}