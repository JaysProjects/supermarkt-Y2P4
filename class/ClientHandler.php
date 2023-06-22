<?php

class ClientHandler{

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function handleFormSubmission() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['klantNaam'];
            $email = $_POST['klantEmail'];
            $adres = $_POST['klantAdres'];
            $postcode = $_POST['klantPostcode'];
            $woonplaats = $_POST['klantWoonplaats'];

            try {
                $stmt = $this->pdo->prepare("INSERT INTO klanten (klantNaam, klantEmail, klantAdres, klantPostcode, klantWoonplaats) VALUES (:klantNaam, :klantEmail, :klantAdres, :klantPostcode, :klantWoonplaats)");

                $stmt->bindParam(':klantNaam', $name);
                $stmt->bindParam(':klantEmail', $email);
                $stmt->bindParam(':klantAdres', $adres);
                $stmt->bindParam(':klantPostcode', $postcode);
                $stmt->bindParam(':klantWoonplaats', $woonplaats);

                $stmt->execute();

                echo "Client inserted successfully!";
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }

    public function getClientsData() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM klanten");


            $client = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $client;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return null;
    }

    public function getKlantById($klantId) {

        $query = "SELECT * FROM Klanten WHERE klantId = :klantId";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':klantId', $klantId);
        $stmt->execute();
        $client = $stmt->fetch(PDO::FETCH_ASSOC);

        $clientId = $client['klantId'];
        $clientName = $client['klantNaam'];

        return $client;
    }

    public function updateClient($clientId, $newName, $newEmail, $newAddress, $newPostalCode, $newCity) {
        try {
            $sql = 'UPDATE klanten SET klantNaam = :klantNaam, klantEmail = :klantEmail, klantAdres = :klantAdres, klantPostcode = :klantPostcode, klantWoonplaats = :klantWoonplaats WHERE klantId = :klantId';

            $stmt = $this->pdo->prepare($sql);

            $stmt->bindParam(':klantNaam', $newName);
            $stmt->bindParam(':klantEmail', $newEmail);
            $stmt->bindParam(':klantAdres', $newAddress);
            $stmt->bindParam(':klantPostcode', $newPostalCode);
            $stmt->bindParam(':klantWoonplaats', $newCity);
            $stmt->bindParam(':klantId', $clientId);

            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function deleteClientAndOrders($klantId) {
        // Delete the client's orders
        $deleteOrdersQuery = "DELETE FROM verkooporders WHERE Klanten_klantId = :klantId";
        $deleteOrdersStmt = $this->pdo->prepare($deleteOrdersQuery);
        $deleteOrdersStmt->bindValue(':klantId', $klantId, PDO::PARAM_INT);
        $deleteOrdersResult = $deleteOrdersStmt->execute();

        // Delete the client
        $deleteClientQuery = "DELETE FROM klanten WHERE klantId = :klantId";
        $deleteClientStmt = $this->pdo->prepare($deleteClientQuery);
        $deleteClientStmt->bindValue(':klantId', $klantId, PDO::PARAM_INT);
        $deleteClientResult = $deleteClientStmt->execute();

        return $deleteClientResult && $deleteOrdersResult;
    }

    public function getClientsDataByFirstLetterOfId($searchValue) {
        $sql = 'SELECT * FROM klanten WHERE klantId LIKE :searchValue';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':searchValue', $searchValue . '%');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getClientsDataByFirstLetterOfName($searchValue) {
        $sql = 'SELECT * FROM klanten WHERE klantNaam LIKE :searchValue';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':searchValue', $searchValue . '%');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}