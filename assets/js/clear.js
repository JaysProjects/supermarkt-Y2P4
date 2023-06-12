function clearSelectedKlant() {
    // Clear the selected klant by resetting the dropdown value
    document.getElementById("klant").selectedIndex = '';
    // Submit the form to reload the page with the cleared selection
    document.querySelector("form").submit();
}

