<?php

class SupplierHandler
{
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getSupplierData() {
        try {
            $stmt = $this->pdo->query('SELECT * FROM leveranciers');
            $suppliers = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $suppliers;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        return null;
    }

    public function deleteSupplier($levId) {
        try {
            $sql = 'DELETE FROM leveranciers WHERE levId = :levId';

            $stmt = $this->pdo->prepare($sql);

            $stmt->bindParam(':levId', $levId);

            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

}