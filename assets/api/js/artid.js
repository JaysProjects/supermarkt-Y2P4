function getSupplierId(artId) {
    const levIdField = document.getElementById('levId');

    // Make an AJAX request to retrieve the supplier ID for the selected product
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
    levIdField.value = xhr.responseText;
}
};
    xhr.open('GET', ' ../assets/api/php/get_supplier_id.php?artId=' + artId, true);
    xhr.send();
}

