<script>
function openUpdateModal(verOrdId) {

    var modalOverlay = document.createElement('div');
    modalOverlay.className = 'overlay';

    var modalContent = document.createElement('div');
    modalContent.className = 'modal';

    var updateFormContainer = document.createElement('div');
    updateFormContainer.className = 'form-container';

    var updateForm = document.createElement('form');
    updateForm.id = 'updateForm';
    updateForm.method = 'POST';
    updateForm.action = '../update/update_order.php';

    var closeButton = document.createElement('span');
    closeButton.textContent = 'X';
    closeButton.className = 'close-button';
    closeButton.onclick = hideUpdateForm;
    updateFormContainer.appendChild(closeButton);

    updateFormContainer.appendChild(updateForm);
    modalContent.appendChild(updateFormContainer);
    modalOverlay.appendChild(modalContent);
    document.body.appendChild(modalOverlay);

    // Create the form elements and populate with existing values
    var verOrdIdInput = document.createElement('input');
    verOrdIdInput.type = 'hidden';
    verOrdIdInput.name = 'verOrdId';
    verOrdIdInput.value = verOrdId;
    verOrdIdInput.id = 'verOrdIdInput';
    updateForm.appendChild(verOrdIdInput);
    // document.getElementById("verOrdIdInput").value = verOrdId;

    var xhrStatus = new XMLHttpRequest();
    xhrStatus.onreadystatechange = function() {
        if (xhrStatus.readyState === XMLHttpRequest.DONE) {
            if (xhrStatus.status === 200) {
                var currentStatus = xhrStatus.responseText;

                // Set the current order status as the default selected radio button
                var radioButtons = [status1Input, status2Input, status3Input];
                radioButtons.forEach(function(radio) {
                    if (radio.value === currentStatus) {
                    radio.checked = true;
                    }
                });
            } else {
                console.error('Error fetching order status');
            }
        }
    };

    // Make a GET request to getOrderStatus.php to fetch the current order status
    xhrStatus.open('GET', '../assets/api/php/get_order_status.php?verOrdId=' + verOrdId, true);
    xhrStatus.send();


    var statusLabel = document.createElement('label');
    statusLabel.textContent = 'Order Status:';
    updateForm.appendChild(statusLabel);

    var status1Input = document.createElement('input');
    status1Input.type = 'radio';
    status1Input.name = 'status';
    status1Input.value = '1';
    status1Input.id = 'status1';
    updateForm.appendChild(status1Input);

    var status1Label = document.createElement('label');
    status1Label.textContent = '1';
    status1Label.htmlFor = 'status1';
    updateForm.appendChild(status1Label);

    var status2Input = document.createElement('input');
    status2Input.type = 'radio';
    status2Input.name = 'status';
    status2Input.value = '2';
    status2Input.id = 'status2';
    updateForm.appendChild(status2Input);

    var status2Label = document.createElement('label');
    status2Label.textContent = '2';
    status2Label.htmlFor = 'status2';
    updateForm.appendChild(status2Label);

    var status3Input = document.createElement('input');
    status3Input.type = 'radio';
    status3Input.name = 'status';
    status3Input.value = '3';
    status3Input.id = 'status3';
    updateForm.appendChild(status3Input);

    var status3Label = document.createElement('label');
    status3Label.textContent = '3';
    status3Label.htmlFor = 'status3';
    updateForm.appendChild(status3Label);



    updateForm.appendChild(document.createElement('br'));

    var amountLabel = document.createElement('label');
    amountLabel.textContent = 'Order Amount:';
    updateForm.appendChild(amountLabel);

    var amountInput = document.createElement('input');
    amountInput.type = 'number';
    amountInput.name = 'amount';

    // Fetch the current order amount using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../assets/api/php/get_order_amount.php?verOrdId=' + verOrdId, true);
    xhr.onload = function() {
        if (xhr.status === 200) {
        amountInput.value = xhr.responseText;
        }
    };
    xhr.send();

    updateForm.appendChild(amountInput);

    updateForm.appendChild(document.createElement('br'));


    var productLabel = document.createElement('label');
    productLabel.textContent = 'Product:';
    updateForm.appendChild(productLabel);

    var productSelect = document.createElement('select');
    productSelect.name = 'artId';

    <?php
    $salesQueryHandler = new SalesHandler($database->getConnection());
    $products = $productQueryHandler->getProducts();

    foreach ($products as $product) {
        echo 'var option = document.createElement("option");';
        echo 'option.value = ' . $product['artId'] . ';';
        echo 'option.textContent = "' . $product['artOmschrijving'] . '";';
        echo 'productSelect.appendChild(option);';
    }
    ?>

    updateForm.appendChild(productSelect);

    updateForm.appendChild(document.createElement('br'));

    var submitButton = document.createElement('input');
    submitButton.type = 'submit';
    submitButton.value = 'Update';
    updateForm.appendChild(submitButton);

    modalContent.appendChild(updateForm);
    modalOverlay.appendChild(modalContent);
    document.body.appendChild(modalOverlay);
}

function hideUpdateForm() {
    var modalOverlay = document.querySelector('.overlay');
    modalOverlay.parentNode.removeChild(modalOverlay);
}

</script>