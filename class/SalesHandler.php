<?php

class SalesHandler
{
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function handleCreateOrder() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $klantId = $_POST['klantId'];
            $artId = $_POST['artId'];
            $verOrdBestAantal = $_POST['verOrdBestAantal'];
            $verOrdStatus = 1;
            $verOrdDatum = date("Y-m-d");

            try {
                $stmt = $this->pdo->prepare("INSERT INTO verkooporders (Klanten_klantId, Artikelen_artId, verOrdDatum, verOrdBestAantal, verOrdStatus) VALUES (:klantId, :artId, :verOrdDatum, :verOrdBestAantal, :verOrdStatus)");

                $stmt->bindParam(':klantId', $klantId);
                $stmt->bindParam(':artId', $artId);
                $stmt->bindParam(':verOrdDatum', $verOrdDatum);
                $stmt->bindParam(':verOrdBestAantal', $verOrdBestAantal);
                $stmt->bindParam(':verOrdStatus', $verOrdStatus);

                $stmt->execute();

                echo "Sales record inserted successfully!";
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }

    public function getSalesData() {
        try {
            $stmt = $this->pdo->query('SELECT * FROM verkooporders');
            $sales = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $sales;
        } catch (PDOException $e) {
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
            $sql = 'DELETE FROM verkooporders WHERE verOrdId = :verOrdId';

            $stmt = $this->pdo->prepare($sql);

            $stmt->bindParam(':verOrdId', $verOrdId);

            $stmt->execute();
        } catch (PDOException $e) {
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