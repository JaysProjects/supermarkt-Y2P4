<?php
include_once "../class/db_config.php";
include_once "../class/DatabaseConnection.php";
include_once "../class/ClientHandler.php";

$clientQueryHandler = new ClientHandler($database->getConnection());
$clients = $clientQueryHandler->getClientsData();


$database->closeConnection();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Client Overview</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/overview.css">
    <script type="text/javascript" src="../assets/api/js/getIdentification.js"></script>
    <script>
        function searchClients() {
            var searchOption = document.getElementById('search-option').value;
            var searchValue = document.getElementById('search-input').value;

            // Perform the AJAX request
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Handle the response
                    var filteredClients = JSON.parse(xhr.responseText);
                    updateClientTable(filteredClients);
                }
            };

            // Define the URL for the AJAX request
            var url = '../assets/api/php/search_clients.php?searchOption=' + encodeURIComponent(searchOption) + '&searchValue=' + encodeURIComponent(searchValue);

            // Open and send the AJAX request
            xhr.open('GET', url, true);
            xhr.send();
        }



        function displaySearchResults(clients) {
            var searchResultsContainer = document.getElementById('search-results');

            // Create a div for each client and append it to the search results container
            clients.forEach(function(client) {
                var resultItem = document.createElement('div');
                resultItem.className = 'result-item';
                resultItem.textContent = client.klantId + ' - ' + client.klantNaam;

                resultItem.addEventListener('click', function() {
                    // Set the selected client in the search input
                    document.getElementById('search-input').value = client.klantId;

                    // Hide the search results
                    searchResultsContainer.style.display = 'none';

                    // Perform any additional actions with the selected client
                    // For example, you can fetch more details about the client or navigate to their profile page
                    // You can customize this based on your requirements
                });

                searchResultsContainer.appendChild(resultItem);
            });

            // Display the search results container
            searchResultsContainer.style.display = 'block';
        }

        function updateClientTable(clients) {
            var tableBody = document.getElementById('client-table-body');

            // Clear the table body
            tableBody.innerHTML = '';

            if (clients.length === 0) {
                // Display a message when no clients are found
                var row = tableBody.insertRow();
                var cell = row.insertCell();
                cell.colSpan = 7;
                cell.textContent = 'No clients found.';
            } else {
                // Populate the table with the filtered clients
                clients.forEach(function(client) {
                    var row = tableBody.insertRow();
                    row.innerHTML = '<td>' + client.klantId + '</td>' +
                        '<td>' + client.klantNaam + '</td>' +
                        '<td>' + client.klantEmail + '</td>' +
                        '<td>' + client.klantAdres + '</td>' +
                        '<td>' + client.klantPostcode + '</td>' +
                        '<td>' + client.klantWoonplaats + '</td>' +
                        '<td>' +
                        '<button class="button button-update" onclick="openUpdateModal(' + client.klantId + ')">Update</button>' +
                        '<button class="button button-delete" onclick="deleteClientAndOrders(' + client.klantId + ')">Delete</button>' +
                        '</td>';
                });
            }
        }



    </script>
    <style>
        #search-input {
            width: 300px;
            padding: 5px;
            font-size: 16px;
        }

        #search-results {
            position: absolute;
            width: 300px;
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #ccc;
            background-color: #fff;
            display: none;
        }

        #search-results .result-item {
            padding: 5px;
            cursor: pointer;
        }

        #search-results .result-item:hover {
            background-color: #f5f5f5;
        }

    </style>
</head>
<body>
<a href="../index.php" class="home-link">Home</a><br>
<div class="container">
    <h2>Klanten Overzicht</h2>

    <div class="search-container">
        <select id="search-option">
            <option value="id">ID</option>
            <option value="name">Name</option>
        </select>

        <input type="text" id="search-input" onkeyup="searchClients()">

<!--        <input type="text" id="search-input" placeholder="Search by ID or Name" onkeyup="searchClients()">-->
        <div id="search-results"></div>

        <!--        <label for="search-input">Search:</label>-->
<!--        <input type="text" id="search-input" placeholder="Enter klantId or klantName">-->
<!--        <button onclick="searchClients()">Search</button>-->
    </div>
    <table id="client-table" class="order-table">
        <thead>
        <tr>
            <th>Client ID</th>
            <th>Client Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Postal Code</th>
            <th>City</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody id="client-table-body">
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $selectedKlantId = isset($_POST['search-input']) ? $_POST['search-input'] : '';
            echo $selectedKlantId;
            if (!empty($selectedKlantId)) {
                $clientData = $clientQueryHandler->getKlantById($selectedKlantId);
            } else {
                $clientData = $clientQueryHandler->getClientsData();
            }
        } else {
            $clientData = $clientQueryHandler->getClientsData();

        }

        foreach ($clients as $client) {
            echo '<tr>';
            echo '<td>' . $client['klantId'] . '</td>';
            echo '<td>' . $client['klantNaam'] . '</td>';
            echo '<td>' . $client['klantEmail'] . '</td>';
            echo '<td>' . $client['klantAdres'] . '</td>';
            echo '<td>' . $client['klantPostcode'] . '</td>';
            echo '<td>' . $client['klantWoonplaats'] . '</td>';
            echo '<td>';
            echo '<button class="button button-update" onclick="openUpdateModal(' . $client['klantId'] . ')">Update</button>';
            echo '<button class="button button-delete" onclick="deleteClientAndOrders(' . $client['klantId'] . ')">Delete</button>';
            echo '</td>';
            echo '</tr>';
        }
        include_once "../assets/js/updateclient.js.php";

        ?>
        </tbody>
    </table>

</div>
</body>
</html>

