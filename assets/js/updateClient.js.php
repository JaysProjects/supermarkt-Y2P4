<script>
    function openUpdateModal(klantId) {
    var modalOverlay = document.createElement('div');
    modalOverlay.className = 'overlay';

    var modalContent = document.createElement('div');
    modalContent.className = 'modal';

    var updateFormContainer = document.createElement('div');
    updateFormContainer.className = 'form-container';

    var updateForm = document.createElement('form');
    updateForm.id = 'updateForm';
    updateForm.method = 'POST';
    updateForm.action = '../update/update_client.php';

    var titleForm = document.createElement('p');
    titleForm.textContent = 'Update Client';
    titleForm.style.fontSize = '20px';
    titleForm.style.fontWeight = 'bold';
    titleForm.style.marginBottom = '0';
    updateForm.appendChild(titleForm);

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
    var klantIdLabel = document.createElement('label');
    klantIdLabel.textContent = 'Editing Client: ' + klantId;
    klantIdLabel.style.fontSize = '10px';
    klantIdLabel.style.top = '-20px';
    updateForm.appendChild(klantIdLabel);

    updateForm.appendChild(document.createElement('br'));
    updateForm.appendChild(document.createElement('br'));

    var klantIdInput = document.createElement('input');
    klantIdInput.type = 'hidden';
    klantIdInput.name = 'klantId';
    klantIdInput.value = klantId;
    klantIdInput.id = 'klantIdInput';
    updateForm.appendChild(klantIdInput);

    var klantNaamLabel = document.createElement('label');
    klantNaamLabel.textContent = 'Name:';
    updateForm.appendChild(klantNaamLabel);

    var klantNaamInput = document.createElement('input');
    klantNaamInput.type = 'text';
    klantNaamInput.name = 'klantNaam';
    updateForm.appendChild(klantNaamInput);

    updateForm.appendChild(document.createElement('br'));

    var klantEmailLabel = document.createElement('label');
    klantEmailLabel.textContent = 'Email:';
    updateForm.appendChild(klantEmailLabel);

    var klantEmailInput = document.createElement('input');
    klantEmailInput.type = 'email';
    klantEmailInput.name = 'klantEmail';
    updateForm.appendChild(klantEmailInput);

    updateForm.appendChild(document.createElement('br'));

    var klantAdresLabel = document.createElement('label');
    klantAdresLabel.textContent = 'Address:';
    updateForm.appendChild(klantAdresLabel);

    var klantAdresInput = document.createElement('input');
    klantAdresInput.type = 'text';
    klantAdresInput.name = 'klantAdres';
    updateForm.appendChild(klantAdresInput);

    updateForm.appendChild(document.createElement('br'));

    var klantPostcodeLabel = document.createElement('label');
    klantPostcodeLabel.textContent = 'Postal Code:';
    updateForm.appendChild(klantPostcodeLabel);

    var klantPostcodeInput = document.createElement('input');
    klantPostcodeInput.type = 'text';
    klantPostcodeInput.name = 'klantPostcode';
    updateForm.appendChild(klantPostcodeInput);

    updateForm.appendChild(document.createElement('br'));

    var klantWoonplaatsLabel = document.createElement('label');
    klantWoonplaatsLabel.textContent = 'City:';
    updateForm.appendChild(klantWoonplaatsLabel);

    var klantWoonplaatsInput = document.createElement('input');
    klantWoonplaatsInput.type = 'text';
    klantWoonplaatsInput.name = 'klantWoonplaats';
    updateForm.appendChild(klantWoonplaatsInput);

    updateForm.appendChild(document.createElement('br'));

    var submitButton = document.createElement('input');
    submitButton.type = 'submit';
    submitButton.value = 'Update';
    updateForm.appendChild(submitButton);

    modalContent.appendChild(updateForm);
    modalOverlay.appendChild(modalContent);
    document.body.appendChild(modalOverlay);

    // Fetch client data based on klantId using AJAX
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
    if (xhr.status === 200) {
    var clientDetails = JSON.parse(xhr.responseText);

    klantNaamInput.value = clientDetails.klantNaam;
    klantEmailInput.value = clientDetails.klantEmail;
    klantAdresInput.value = clientDetails.klantAdres;
    klantPostcodeInput.value = clientDetails.klantPostcode;
    klantWoonplaatsInput.value = clientDetails.klantWoonplaats;
} else {
    console.error('Error: Unable to fetch client data');
}
}
};

    xhr.open('GET', '../assets/api/php/get_client_data.php?klantId=' + klantId, true);
    xhr.send();
}

    function hideUpdateForm() {
    var modalOverlay = document.querySelector('.overlay');
    modalOverlay.parentNode.removeChild(modalOverlay);
}
</script>
