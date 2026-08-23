<?php require_once _ROOTPATH_.'\templates\header.php'; ?>

<main>
    <div class="row margin-l-0 margin-t-l justify-content-center">
        <div class="col-10 m-0 p-0">
            <div class="filter d-flex justify-content-center p-0 tertiary-text">
                <i class="bi bi-chevron-left margin-l-s"></i>
                <a class="text text-decoration-underline margin-l-s margin-r-s tertiary-text" href="./index.php?controller=menu&action=showAll">Revenir à la carte</a>
            </div>
        </div>
    </div>
    <div class="bg-extra-dark margin-t-l padding-t-l">
        <div class="row justify-content-center">
            <p id="menuTitre" class="headline primary-text col-auto margin-b-s"><?php echo($menu->getTitre()) ?></p>
        </div>
        <div class="row justify-content-center">
            <p id="menuNbMin" class="text white-text col-auto m-0 mx-3"><?php echo($menu->getQuantiteMin()) ?> personnes minimum</p>
            <p id="menuTheme" class="text white-text col-auto m-0 mx-3"><?php echo($theme->getLibelle()) ?></p>
            <p id="menuRegime" class="text white-text col-auto m-0 mx-3"><?php echo($regime->getLibelle()) ?></p>
        </div>
        <div class="row justify-content-center margin-t-l">
            <p id="menuDescription" class="text white-text col-auto m-0"><?php echo($menu->getDescription()) ?></p>
        </div>
        <div id="menuImg" class="row justify-content-center margin-t-l">
            <img class='imgPlat p-0 mx-2' src='./uploads/images/entree/entree_<?php echo($menu->getEntree()) ?>.png' alt='photo d'un plat'>"
            <img class='imgPlat p-0 mx-2' src='./uploads/images/plat/plat_<?php echo($menu->getPlat()) ?>.png' alt='photo d'un plat'>"
            <img class='imgPlat p-0 mx-2' src='./uploads/images/dessert/dessert_<?php echo($menu->getDessert()) ?>.png' alt='photo d'un plat'>"
        </div>
        <div class="row justify-content-center margin-t-l">
            <p id="menuPlats" class="text primary-text text-center m-0">Entrée</p>
            <p id="menuPlats" class="text white-text text-center m-0 margin-b-s"><?php echo($entree->getlibelle()) ?></p>
            <p id="menuPlats" class="text primary-text text-center m-0">Plat</p>
            <p id="menuPlats" class="text white-text text-center m-0 margin-b-s"><?php echo($plat->getlibelle()) ?></p>
            <p id="menuPlats" class="text primary-text text-center m-0">Dessert</p>
            <p id="menuPlats" class="text white-text text-center m-0 margin-b-s"><?php echo($dessert->getlibelle()) ?></p>
        </div>
        <div class="row justify-content-center margin-t-l">
            <p id="menuAllergenes" class="text white-text text-center col-auto m-0">Liste des allergènes :<br>
                <?php
                    $i = 0;
                    foreach($allergenes as $allergene){
                        if(++$i === count($allergenes)){
                            echo($allergene->getlibelle().'.');
                        }
                        else{
                            echo($allergene->getlibelle().', ');
                        }
                        
                    }
                ?>
            </p>
        </div>
        <div class="row justify-content-center margin-t-l">
            <p id="menuPrix" class="headline tertiary-text col-auto m-0"><?php echo($menu->getConditions()) ?></p>
        </div>
        <div class="row justify-content-center margin-t-l">
            <p id="menuStock" class="text secondary-text col-auto m-0">Stock disponible : <?php echo($menu->getQuantiteDispo()) ?></p>
        </div>
        <div class="row justify-content-center margin-t-s">
            <div class="bouton bg-primary p-0 d-flex justify-content-center">
                <a class="text dark-text text-decoration-underline m-0 p-0" href="./index.php?controller=authenticator&action=commander&menuId=<?php echo($menu->getId()) ?>">Commander</a>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <svg class="col-10 margin-t-l margin-b-0 p-0" height="2" xmlns="http://www.w3.org/2000/svg">
                <line class="separator" x1="0" y1="0" x2="100%" y2="0"/>
                Sorry, your browser does not support inline SVG.
            </svg>
        </div>
    </div>
</main>

<?php require_once _ROOTPATH_.'\templates\footer.php'; ?>