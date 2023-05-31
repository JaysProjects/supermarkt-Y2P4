<?php

class SalesHandler
{
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }



    public function handleFormSubmission() {
        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form data
            $klantId = $_POST['klantId'];
            $artId = $_POST['artId'];
            $verOrdBestAantal = $_POST['verOrdBestAantal'];
            $verOrdStatus = $_POST['verOrdStatus'];
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

            echo "successfully fetched all orders: <br> ";

            return $sales;
        } catch (PDOException $e) {
            // Handle any errors that occur during the query
            echo "Error: " . $e->getMessage();
        }

        return  $sales;
    }
}