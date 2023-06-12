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

    public function getKlanten() {
        $stmt = $this->pdo->query("SELECT * FROM klanten");

        echo "successfully fetched all clients: <br> ";

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getKlantById($klantId) {

        $query = "SELECT * FROM Klanten WHERE klantId = :klantId";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':klantId', $klantId);
        $stmt->execute();
        $klant = $stmt->fetch(PDO::FETCH_ASSOC);

        return $klant;
    }
}