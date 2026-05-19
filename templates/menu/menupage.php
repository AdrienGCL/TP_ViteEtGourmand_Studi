<?php require_once _ROOTPATH_.'\templates\header.php'; ?>

<main>
    <section>
        <div class="row margin-l-0 margin-t-l justify-content-center">
            <div class="col-10 m-0 p-0">
                <div class="filter d-flex justify-content-center p-0 dark-text bg-secondary cursor-pointer">
                    <p class="text text-decoration-underline margin-l-s">Filtrer</p>
                    <i class="bi bi-chevron-down margin-l-s margin-r-s"></i>
                </div>
            </div>
        </div>
        <div class="filterDiv row margin-l-0 margin-r-0 justify-content-center">
            <div class="col-10 m-0 padding-m bg-secondary">
                <div class="row m-0 p-0 justify-content-around">
                    <div class="col-auto d-flex bg-white padding-s m-0 radius-m border-tertiary">
                        <input class="customInput" type="number" name="minPrice" id="minPrice" min="0" placeholder="Prix min">
                        <label class="dark-text" for="minPrice">€</label>
                    </div>
                    <div class="col-auto d-flex bg-white padding-s m-0 radius-m border-tertiary">
                        <input class="customInput" type="number" name="maxPrice" id="maxPrice" min="0" placeholder="Prix max">
                        <label class="dark-text" for="maxPrice">€</label>
                    </div>
                    <div class="col-auto d-flex bg-white padding-s m-0 radius-m border-tertiary">
                        <select class="customInput" name="themeList" id="themeList">
                            <option value="">Thème</option>
                            <?php for($i = 0; $i<count($themes); $i++){ ?>
                            <option value="<?php echo($themes[$i]->getId()) ?>"><?php echo($themes[$i]->getLibelle()) ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-auto d-flex bg-white padding-s m-0 radius-m border-tertiary">
                        <select class="customInput" name="regimeList" id="regimeList">
                            <option value="">Régime</option>
                            <?php for($i = 0; $i<count($regimes); $i++){ ?>
                            <option value="<?php echo($regimes[$i]->getId()) ?>"><?php echo($regimes[$i]->getLibelle()) ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-auto d-flex bg-white padding-s m-0 radius-m border-tertiary">
                        <input class="customInput" type="number" name="nbParts" id="nbParts" min="0" placeholder="Quantité">
                    </div>
                </div>
                <!-- <div class="row justify-content-center padding-t-m">
                    <div class="bouton bg-dark p-0 d-flex justify-content-center">
                        <a class="text primary-text text-decoration-underline m-0 p-0" href="">Rechercher</a>
                    </div>
                </div> -->
            </div>
        </div>
    </section>
            
    <section id="menusListeDiv">
        <?php for($i = 0; $i<count($menus); $i++){ ?>
            <div class="menuShort margin-t-l" data-prix="<?php echo($menus[$i]->getPrix()) ?>" data-theme="<?php echo($menus[$i]->getTheme()) ?>" data-regime="<?php echo($menus[$i]->getRegime()) ?>" data-quantite="<?php echo($menus[$i]->getQuantiteDispo()) ?>">
                <div class="row justify-content-center">
                    <p class="headline primary-text col-auto margin-b-s"><?php echo($menus[$i]->getTitre()) ?></p>
                </div>
                <div class="row justify-content-center">
                    <p class="text white-text col-auto m-0"><?php echo($menus[$i]->getDescription()) ?></p>
                </div>
                <div class="row justify-content-center padding-t-l">
                    <p class="text white-text col-auto m-0"><?php echo($menus[$i]->getQuantiteMin()) ?> minimum</p>
                    <p class="headline secondary-text col-auto m-0"><?php echo($menus[$i]->getPrix()) ?>€/personne</p>
                </div>
                <div class="row justify-content-center padding-t-l">
                    <div class="bouton bg-primary p-0 d-flex justify-content-center">
                        <a class="text dark-text text-decoration-underline m-0 p-0" href="./index.php?controller=menuDetail&action=showDetail&id=<?php echo($menus[$i]->getId()) ?>">Voir le menu</a>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <svg class="col-10 margin-t-l margin-b-0 p-0" height="2" xmlns="http://www.w3.org/2000/svg">
                        <line class="separator" x1="0" y1="0" x2="100%" y2="0"/>
                        Sorry, your browser does not support inline SVG.
                    </svg>
                </div>
            </div>
        <?php } ?>
        <div class="noResultDiv margin-t-l d-none">
                <div class="row justify-content-center">
                    <p class="text white-text col-auto m-0">Veuillez nous excuser, aucun de nos menus ne correspond à ces critères actuellement.</p>
                </div>
            </div>
    </section>
</main>

<script src=".\assets\js\menuFilter.js" defer></script>


<?php require_once _ROOTPATH_.'\templates\footer.php'; ?>