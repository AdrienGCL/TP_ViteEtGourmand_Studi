const customInput = $(".customInput");
let minPrice;
let maxPrice;
let selectedTheme;
let selectedRegime;
let quantity;

function switchFilterVisibility(){
    $(".filter").on("click", function(){
        $(".filterDiv").toggle();
        $(".filter").toggleClass("dark-text bg-secondary tertiary-text");
        $(".filter").children(".bi").toggleClass("bi-chevron-down bi-chevron-up");
    })
}

function detectFilterChange(){
    $(customInput).on("change", function(){
        let inputValueList = [];
        $(customInput).each(function(i){
            let thisValue = parseInt($(customInput[i]).val());
            if(Number.isInteger(thisValue)){
                inputValueList.push(thisValue);
            }
            else{
                inputValueList.push(false);
            }
        });
        updateFilterParams(inputValueList);
    })
};

function updateFilterParams(listOfValue){
    $(listOfValue).each(function(i){
        if(listOfValue[i] === false){
            switch(i){
                case 0:
                    minPrice = null;
                    break;
                case 1:
                    maxPrice = null;
                    break;
                case 2:
                    selectedTheme = null;
                    break;
                case 3:
                    selectedRegime = null;
                    break;
                case 4:
                    quantity = null;
                    break;
            }
        }
        else {
            switch(i){
                case 0:
                    minPrice = listOfValue[i];
                    break;
                case 1:
                    maxPrice = listOfValue[i];
                    break;
                case 2:
                    selectedTheme = listOfValue[i];
                    break;
                case 3:
                    selectedRegime = listOfValue[i];
                    break;
                case 4:
                    quantity = listOfValue[i];
                    break;
            }
        }
    })
    updateView();
}

function updateView(){
    $(".noResultDiv").addClass("d-none");
    let menuCard = $(".menuShort")
    menuCard.show();
    menuCard.each(function(i){
        if($(menuCard[i]).data("prix") < minPrice && minPrice != null){
            $(menuCard[i]).hide();
        }
        if($(menuCard[i]).data("prix") > maxPrice && maxPrice != null){
            $(menuCard[i]).hide();
        }
        if($(menuCard[i]).data("theme") != selectedTheme && selectedTheme != null){
            $(menuCard[i]).hide();
        }
        if($(menuCard[i]).data("regime") != selectedRegime && selectedRegime != null){
            $(menuCard[i]).hide();
        }
        if($(menuCard[i]).data("quantite") < quantity && quantity != null){
            $(menuCard[i]).hide();
        }
    })
    if($(".menuShort:visible").length === 0){
        $(".noResultDiv").removeClass("d-none");
    }
}

detectFilterChange();
switchFilterVisibility();