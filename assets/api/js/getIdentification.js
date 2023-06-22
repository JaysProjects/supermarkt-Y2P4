function getSupplierId(artId) {
    const levIdField = document.getElementById('levId');
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
    levIdField.value = xhr.responseText;
}
};
    xhr.open('GET', ' ../assets/api/php/get_supplier_id.php?artId=' + artId, true);
    xhr.send();
}

function deleteOrder(verOrdId) {
    if (confirm("Are you sure you want to delete this order?")) {
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
            // Reload the page after successful deletion
                location.reload();
            }
        };
    xhr.open('GET', '../assets/api/php/delete_order.php?verOrdId=' + verOrdId, true);
    xhr.send();
    }
}

function deleteProduct(artId) {
    if (confirm("Are you sure you want to delete this product?")) {
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
            // Reload the page after successful deletion
                location.reload();
            }
        };
    xhr.open('GET', '../assets/api/php/delete_product.php?artId=' + artId, true);
    xhr.send();
    }
}

function deleteSupplier(levId) {
    if (confirm("Are you sure you want to delete this Supplier?")) {
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                location.reload();
            }
        };
    xhr.open('GET', '../assets/api/php/delete_supplier.php?levId=' + levId, true);
    xhr.send();
    }
}

function deleteInkoopOrder(inkOrdId) {
    if (confirm("Are you sure you want to delete this restock order?")) {
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                location.reload();
            }
        };
    xhr.open('GET', '../assets/api/php/delete_inkOrd.php?inkOrdId=' + inkOrdId, true);
    xhr.send();
    }
}

function deleteClientAndOrders(klantId) {
    if (confirm("Are you sure you want to delete this Client and their Orders?")) {
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                location.reload();
            }
        };
        xhr.open('GET', '../assets/api/php/delete_client.php?klantId=' + klantId, true);
        xhr.send();
    }
}
