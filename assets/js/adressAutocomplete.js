const addressInput = document.getElementById("adresselivraisoninput");
const zipcodeInput = document.getElementById("cplivraisoninput");
const cityInput = document.getElementById("villelivraisoninput");
const suggestionsList = document.getElementById("suggestions");
const state = document.getElementById("status");

let debounceTimer;
let currentController;
let selectedAddress = null;

addressInput.addEventListener("input", () => {
    selectedAddress = null;

    zipcodeInput.value = "";
    cityInput.value = "";

    // selection.hidden = true;
    
    clearTimeout(debounceTimer);

    if (currentController) {
        currentController.abort();
    }

    suggestionsList.replaceChildren();

    const text = addressInput.value.trim();

    if (text.length < 3) {
        state.textContent ="Saisir au moins 3 caractères.";
        return;
    }

    state.textContent = "Recherche en cours...";

    debounceTimer = setTimeout(() => {searchAddresses(text);}, 350);
});


async function searchAddresses(text) {
    currentController = new AbortController();

    const url =
        "/public/api/autocomplete.php?q=" + encodeURIComponent(text);

    try {
        const response = await fetch(url, {
            signal: currentController.signal
        });

        const data = await response.json();

        if (!response.ok) {
            throw new Error(
                data.error ?? "Une erreur est survenue."
            );
        }

        console.log("Réponse du serveur PHP :", data);

        displaySuggestions(data.results ?? []);

    } catch (error) {
        if (error.name === "AbortError") {
            return;
        }

        console.error(error);

        status.textContent =
            "Impossible de récupérer les adresses.";

        suggestionsList.replaceChildren();
    }
}


function displaySuggestions(results) {
    suggestionsList.replaceChildren();

    if (results.length === 0) {
        state.textContent = "Aucune suggestion trouvée.";
        return;
    }

    results.forEach((result) => {
        const item = document.createElement("li");

        item.setAttribute("role", "option");
        item.tabIndex = 0;
        item.textContent = result.fulltext;

        item.addEventListener("click", () => {
            selectAddress(result);
        });

        item.addEventListener("keydown", (event) => {
            if (event.key === "Enter") {
                selectAddress(result);
            }
        });

        suggestionsList.appendChild(item);
    });

    state.textContent =`${results.length} suggestion(s) trouvée(s).`;
}

function selectAddress(result) {
    selectedAddress = result;

    let streetNumber = result.fulltext.split(",")[0];
    addressInput.value = streetNumber ?? "";
    zipcodeInput.value = result.zipcode ?? "";
    cityInput.value = result.city ?? "";

    state.textContent ="";
    zipcodeInput.setCustomValidity("");
    cityInput.setCustomValidity("");

    suggestionsList.replaceChildren();
}