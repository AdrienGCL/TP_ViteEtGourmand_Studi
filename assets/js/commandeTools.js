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
    console.log(menuPrice);
    $(divQuantityPrice).html(menuPrice + "€");
    $(divQuantity).html("Quantité : " + quantity);
    calcTotal();
}

function detectInputChange(){
    $(customInput).on("change", function(){
        quantity = $("#quantiteinput").val();
        calcMenuPrice();
    })
}

detectInputChange();