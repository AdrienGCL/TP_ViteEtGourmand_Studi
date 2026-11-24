<?php require_once _ROOTPATH_.'/templates/header.php'; ?>

<main>
    <div class="row justify-content-center margin-t-l">
        <p class="col-auto headline primary-text m-0">Commande n° <?= htmlspecialchars($commande->getId()) ?> du <?= date('d/m/Y', strtotime(htmlspecialchars($commande->getDateCommande(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'))) ?></p>
    </div>

    <div class="row justify-content-center margin-b-l">
        <div class="col-10 col-md-4 col-">
            <div class="row justify-content-between margin-t-l">
                <p class="col-auto text white-text m-0"><?= htmlspecialchars($commande->getQuantite()) ?> menus <?= htmlspecialchars($menu->getTitre(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></p>
                <p id="menuPrice" class="col-auto text white-text m-0"><?= htmlspecialchars($menu->getPrix()*$commande->getQuantite()) ?>€</p>
            </div>
            <div class="row justify-content-between margin-t-l">
                <p id="livraison" class="col-auto text white-text m-0">Livraison (5€ + 0,59€/km)</p>
            <?php
                if($commande->getPrixLivraison() == 0){ ?>
                    <p id="livraisonPrice" class="col-auto text white-text m-0">Offerte</p>
                <?php 
                } else { ?>
                    <p id="livraisonPrice" class="col-auto text white-text m-0"><?= htmlspecialchars($commande->getPrixLivraison()) ?>€</p>
                <?php } ?>
            </div>
            <?php if($commande->getRemise() > 0){ ?>
                <div class="row justify-content-between margin-t-l">
                    <p id="remise" class="col-auto text white-text m-0">Remise 10%</p>
                    <p id="remisePrice" class="col-auto text white-text m-0"><?= htmlspecialchars($commande->getRemise()) ?>€</p>
                </div>
            <?php } ?>
            <div class="row justify-content-between margin-t-l">
                <p class="col-auto headline primary-text m-0">Total</p>
                <p id="totalPrice" class="col-auto headline primary-text m-0"><?= htmlspecialchars($commande->getPrix()) ?>€</p>
            </div>
            <div class="row justify-content-center margin-t-l">
                <p class="row headline white-text text-center justify-content-center m-0">Menu <?= htmlspecialchars($menu->getTitre(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></p>
                <p class="row white-text text-center justify-content-center m-0">Thème  <?= htmlspecialchars($theme->getLibelle(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?> / Régime  <?= htmlspecialchars($regime->getLibelle(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></p>
            </div>
            <div class="row justify-content-center margin-t-l">
                <p class="row text white-text text-center justify-content-center text-decoration-underline m-0">Entrée :</p>
                <p class="row text white-text text-center justify-content-center margin-b-s"><?= htmlspecialchars($entree->getLibelle(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></p>
                <p class="row text white-text text-center justify-content-center text-decoration-underline m-0">Plat principal :</p>
                <p class="row text white-text text-center justify-content-center margin-b-s"><?= htmlspecialchars($plat->getLibelle(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></p>
                <p class="row text white-text text-center justify-content-center text-decoration-underline m-0">Dessert :</p>
                <p class="row text white-text text-center justify-content-center margin-b-s"><?= htmlspecialchars($dessert->getLibelle(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></p>
            </div>
            <div class="row justify-content-center margin-t-l">
                <div class="col-auto">
                    <p class="col-auto text white-text text-center m-0">Livraison le <?= htmlspecialchars($commande->getDateLivraison(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?> à <?= htmlspecialchars($commande->getHeureLivraison(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></p>
                    <p></p>
                    <p class="col-auto text white-text text-center m-0">Adresse de livraison : <?= htmlspecialchars($commande->getAdresseLivraison(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>, <?= htmlspecialchars($commande->getCodePostale(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>, <?= htmlspecialchars($commande->getVille(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center margin-b-l">
        <form action="" method="post" class="row mx-0 align-items-center justify-content-center">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf->getToken(), ENT_QUOTES, 'UTF-8') ?>">
            <div class="col d-flex p-0 justify-content-center">
                <div class="row justify-content-center">
                    <button type="submit" class="modify-btn primary-border bg-dark radius-m margin-r-m" name="modifyCommande">
                        <i class="bi bi-pencil-fill primary-text fit"></i>
                    </button>
                    <button type="submit" class="modify-btn border-tertiary bg-dark radius-m" name="deleteCommande">
                        <i class="bi bi-trash-fill tertiary-text fit"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <?php require _ROOTPATH_.'/templates/separator.php'; ?>

</main>

<?php require_once _ROOTPATH_.'/templates/footer.php'; ?>