<?php

class ClientHandler{

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function handleFormSubmission() {
        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form data
            $name = $_POST['klantNaam'];
            $email = $_POST['klantEmail'];
            $adres = $_POST['klantAdres'];
            $postcode = $_POST['klantPostcode'];
            $woonplaats = $_POST['klantWoonplaats'];

            try {
                // Prepare the SQL statement for insertion
                $stmt = $this->pdo->prepare("INSERT INTO klanten (klantNaam, klantEmail, klantAdres, klantPostcode, klantWoonplaats) VALUES (:klantNaam, :klantEmail, :klantAdres, :klantPostcode, :klantWoonplaats)");

                // Bind the parameters
                $stmt->bindParam(':klantNaam', $name);
                $stmt->bindParam(':klantEmail', $email);
                $stmt->bindParam(':klantAdres', $adres);
                $stmt->bindParam(':klantPostcode', $postcode);
                $stmt->bindParam(':klantWoonplaats', $woonplaats);

                // Execute the statement
                $stmt->execute();

                // Provide feedback to the user
                echo "Client inserted successfully!";
            } catch (PDOException $e) {
                // Handle any errors that occur during the insertion
                echo "Error: " . $e->getMessage();
            }
        }
    }

    public function getClientsData() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM klanten");

//        echo "successfully fetched all clients: <br> ";

            $client = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $client;
        } catch (PDOException $e) {
            // Handle any errors that occur during the query
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

        // Return true if both delete operations were successful, false otherwise
        return $deleteClientResult && $deleteOrdersResult;
    }

    public function getClientsDataByFirstLetterOfId($searchValue) {
        // Prepare the SQL query to fetch clients filtered by the first letter or number of the ID
        $sql = 'SELECT * FROM klanten WHERE klantId LIKE :searchValue';
//        echo "<script>console.log(" . $sql . ")></script>";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':searchValue', $searchValue . '%');
        $stmt->execute();

        // Fetch and return the filtered clients as an array
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getClientsDataByFirstLetterOfName($searchValue) {
        // Prepare the SQL query to fetch clients filtered by the first letter or number of the name
        $sql = 'SELECT * FROM klanten WHERE klantNaam LIKE :searchValue';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':searchValue', $searchValue . '%');
        $stmt->execute();

        // Fetch and return the filtered clients as an array
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}