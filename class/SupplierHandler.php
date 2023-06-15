<?php

class SupplierHandler
{
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getSupplierData() {
        try {
            // Prepare the SQL statement
            $stmt = $this->pdo->query('SELECT * FROM leveranciers');
            // Fetch all rows as an associative array
            $suppliers = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $suppliers;
        } catch (PDOException $e) {
            // Handle any errors that occur during the query
            echo "Error: " . $e->getMessage();
        }

        return null;
    }

    public function deleteSupplier($levId) {
        try {
            $sql = 'DELETE FROM leveranciers WHERE levId = :levId';

            // Prepare the statement
            $stmt = $this->pdo->prepare($sql);

            // Bind the parameter
            $stmt->bindParam(':levId', $levId);

            // Execute the statement
            $stmt->execute();
        } catch (PDOException $e) {
            // Handle any errors that occur during the deletion
            echo "Error: " . $e->getMessage();
        }
    }

}