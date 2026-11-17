const commandeForm = document.getElementById("commandeForm");

commandeForm.addEventListener("submit", (event) => {
    if (zipcodeInput.value.trim() === "") {
        event.preventDefault();

        zipcodeInput.setCustomValidity("Le code postal est requis.");

        state.textContent = "Veuillez sélectionner une adresse dans la liste des suggestions.";

        return;
    }
    else if (cityInput.value.trim() === "") {
        event.preventDefault();

        cityInput.setCustomValidity("La ville est requise.");

        state.textContent = "Veuillez sélectionner une adresse dans la liste des suggestions.";

        return;
    }

    zipcodeInput.setCustomValidity("");
    cityInput.setCustomValidity("");
});