<?php

class SalesHandler
{
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function handleCreateOrder() {
        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form data
            $klantId = $_POST['klantId'];
            $artId = $_POST['artId'];
            $verOrdBestAantal = $_POST['verOrdBestAantal'];
//            $verOrdStatus = $_POST['verOrdStatus'];
            $verOrdStatus = 1;
            $verOrdDatum = date("Y-m-d"); // Current date

            try {
                // Prepare the SQL statement for insertion
                $stmt = $this->pdo->prepare("INSERT INTO verkooporders (Klanten_klantId, Artikelen_artId, verOrdDatum, verOrdBestAantal, verOrdStatus) VALUES (:klantId, :artId, :verOrdDatum, :verOrdBestAantal, :verOrdStatus)");

                // Bind the parameters
                $stmt->bindParam(':klantId', $klantId);
                $stmt->bindParam(':artId', $artId);
                $stmt->bindParam(':verOrdDatum', $verOrdDatum);
                $stmt->bindParam(':verOrdBestAantal', $verOrdBestAantal);
                $stmt->bindParam(':verOrdStatus', $verOrdStatus);

                // Execute the statement
                $stmt->execute();

                // Provide feedback to the user
                echo "Sales record inserted successfully!";
            } catch (PDOException $e) {
                // Handle any errors that occur during the insertion
                echo "Error: " . $e->getMessage();
            }
        }
    }

    public function getSalesData() {
        try {
            // Prepare the SQL statement
            $stmt = $this->pdo->query('SELECT * FROM verkooporders');
            // Fetch all rows as an associative array
            $sales = $stmt->fetchAll(PDO::FETCH_ASSOC);

//            echo "successfully fetched all orders: <br> ";

            return $sales;
        } catch (PDOException $e) {
            // Handle any errors that occur during the query
            echo "Error: " . $e->getMessage();
        }

        return null;
    }

    public function getSalesOrdersByKlantId($klantId) {
        $stmt = $this->pdo->prepare("SELECT * FROM verkooporders WHERE verkooporders.Klanten_klantId IN (SELECT klantId FROM klanten WHERE klantId = :klantId)");
        $stmt->bindParam(':klantId', $klantId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteOrder($verOrdId) {
        try {
            // Prepare the SQL statement for deleting the order by verOrdId
            $sql = 'DELETE FROM verkooporders WHERE verOrdId = :verOrdId';

            // Prepare the statement
            $stmt = $this->pdo->prepare($sql);

            // Bind the parameter
            $stmt->bindParam(':verOrdId', $verOrdId);

            // Execute the statement
            $stmt->execute();
        } catch (PDOException $e) {
            // Handle any errors that occur during the deletion
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateOrder($verOrdId, $newStatus, $newAmount, $newArtId) {
        try {
            $sql = 'UPDATE verkooporders SET verOrdStatus = :verOrdStatus, verOrdBestAantal = :verOrdBestAantal, Artikelen_artId = :artId WHERE verOrdId = :verOrdId';

            $stmt = $this->pdo->prepare($sql);

            $stmt->bindParam(':verOrdStatus', $newStatus);
            $stmt->bindParam(':verOrdBestAantal', $newAmount);
            $stmt->bindParam(':artId', $newArtId);
            $stmt->bindParam(':verOrdId', $verOrdId);

            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getOrderById($verOrdId) {
        try {
            $sql = 'SELECT * FROM verkooporders WHERE verOrdId = :verOrdId';

            $stmt = $this->pdo->prepare($sql);

            $stmt->bindParam(':verOrdId', $verOrdId);

            $stmt->execute();

            $order = $stmt->fetch(PDO::FETCH_ASSOC);

            $artId = $order['Artikelen_artId'];
            $verOrdStatus = $order['verOrdStatus'];
            $verOrdBestAantal = $order['verOrdBestAantal'];

            return $order;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}