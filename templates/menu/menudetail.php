<?php require_once _ROOTPATH_.'/templates/header.php'; ?>

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
            <p id="menuTitre" class="headline primary-text col-auto margin-b-s"><?= htmlspecialchars($menu->getTitre(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></p>
        </div>
        <div class="row justify-content-center">
            <p id="menuNbMin" class="text white-text col-auto m-0 mx-3"><?= $menu->getQuantiteMin() ?> personnes minimum</p>
            <p id="menuTheme" class="text white-text col-auto m-0 mx-3"><?= htmlspecialchars($theme->getLibelle(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></p>
            <p id="menuRegime" class="text white-text col-auto m-0 mx-3"><?= htmlspecialchars($regime->getLibelle(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></p>
        </div>
        <div class="row justify-content-center margin-t-l">
            <p id="menuDescription" class="text white-text col-auto m-0"><?= htmlspecialchars($menu->getDescription(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></p>
        </div>
        <div id="menuImg" class="row justify-content-center margin-t-l">
            <img class='imgPlat p-0 mx-2' src='./uploads/images/entree/entree_<?= $menu->getEntree() ?>.png' alt='photo d'un plat'>"
            <img class='imgPlat p-0 mx-2' src='./uploads/images/plat/plat_<?= $menu->getPlat() ?>.png' alt='photo d'un plat'>"
            <img class='imgPlat p-0 mx-2' src='./uploads/images/dessert/dessert_<?= $menu->getDessert() ?>.png' alt='photo d'un plat'>"
        </div>
        <div class="row justify-content-center margin-t-l">
            <p id="menuPlats" class="text primary-text text-center m-0">Entrée</p>
            <p id="menuPlats" class="text white-text text-center m-0 margin-b-s"><?= htmlspecialchars($entree->getLibelle(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></p>
            <p id="menuPlats" class="text primary-text text-center m-0">Plat</p>
            <p id="menuPlats" class="text white-text text-center m-0 margin-b-s"><?= htmlspecialchars($plat->getLibelle(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></p>
            <p id="menuPlats" class="text primary-text text-center m-0">Dessert</p>
            <p id="menuPlats" class="text white-text text-center m-0 margin-b-s"><?= htmlspecialchars($dessert->getLibelle(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></p>
        </div>
        <div class="row justify-content-center margin-t-l">
            <p id="menuAllergenes" class="text white-text text-center col-auto m-0">Liste des allergènes :<br>
                <?php
                    $i = 0;
                    foreach($allergenes as $allergene){
                        if(++$i === count($allergenes)){
                            echo(htmlspecialchars($allergene->getLibelle(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8').'.');
                        }
                        else{
                            echo(htmlspecialchars($allergene->getLibelle(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8').', ');
                        }
                        
                    }
                ?>
            </p>
        </div>
        <div class="row justify-content-center margin-t-l">
            <p id="menuPrix" class="headline tertiary-text col-auto m-0"><?= htmlspecialchars($menu->getConditions(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></p>
        </div>
        <div class="row justify-content-center margin-t-l">
            <p id="menuStock" class="text secondary-text col-auto m-0">Stock disponible : <?= $menu->getQuantiteDispo() ?></p>
        </div>
        <div class="row justify-content-center margin-t-s">
            <div class="bouton bg-primary p-0 d-flex justify-content-center">
                <form
                    action="./index.php?controller=authenticator&action=commander"
                    method="post"
                    class="m-0"
                >
                    <input
                        type="hidden"
                        name="csrf_token"
                        value="<?= htmlspecialchars($csrf->getToken(), ENT_QUOTES, 'UTF-8') ?>"
                    >

                    <input
                        type="hidden"
                        name="menuId"
                        value="<?= htmlspecialchars((string) $menu->getId(), ENT_QUOTES, 'UTF-8') ?>"
                    >

                    <button
                        type="submit"
                        class="text dark-text text-decoration-underline m-0 p-0 border-0 bg-transparent"
                    >
                        Commander
                    </button>
                </form>
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

<?php require_once _ROOTPATH_.'/templates/footer.php'; ?>