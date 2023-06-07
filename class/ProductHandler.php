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

            echo "successfully fetched all products: <br> ";


            return $artikelen;
        } catch (PDOException $e) {
            // Handle any errors that occur during the query
            echo "Error: " . $e->getMessage();
        }
    }
}