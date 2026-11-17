const divMenuPrice = $("#menuPrice");
const divQuantity = $("#quantity");
const divQuantityPrice = $("#quantityPrice");
const divLivraison = $("#livraison");
const divLivraisonPrice = $("#livraisonPrice");
const divRemise = $("#remise");
const divRemisePrice = $("#remisePrice");
const divTotalPrice = $("#totalPrice");
const customInput = $(".customInput");
let quantity = $("#quantiteinput").val();
let menuPrice;
let livraisonPrice = 0;
let remisePrice = 0;
let totalPrice;

function multAxB (firstInput, secondInput){
    const result = firstInput * secondInput;
    return result;
}

function addValues (listValues){
    const initialValue = 0;
    const result = listValues.reduce(
        (accumulator, currentValue) => accumulator + currentValue,
        initialValue,
    );
    return result;
}

function calcTotal(){
    totalPrice = menuPrice + livraisonPrice - remisePrice;
    $(divTotalPrice).html(totalPrice + "€");
}

function calcMenuPrice(){
    menuPrice = multAxB(singleMenuPrice, quantity);
    $(divQuantityPrice).html(menuPrice + "€");
    $(divQuantity).html("Quantité " + quantity);
    calcTotal();
}

function detectInputChange(){
    $(customInput).on("change", function(){
        quantity = $("#quantiteinput").val();
        calcMenuPrice();
    })
}

// formule haversine / Calcul de distance sur une sphere
function getDistanceFromLatLonInKm(lat1, lon1, lat2, lon2) {
  var R = 6371; // Rayon de la terre en km
  var dLat = deg2rad(lat2-lat1);
  var dLon = deg2rad(lon2-lon1);
  var a = 
    Math.sin(dLat/2) * Math.sin(dLat/2) +
    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
    Math.sin(dLon/2) * Math.sin(dLon/2)
    ; 
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
  var d = R * c; // Distance en km
  return d;
}

function deg2rad(deg) {
  return deg * (Math.PI/180)
}

detectInputChange();