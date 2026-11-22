<?php require_once _ROOTPATH_.'/templates/header.php'; ?>

<main>
    <div class="row justify-content-center margin-t-l">
        <p class="col-auto headline primary-text m-0">Votre commande</p>
    </div>

    <div class="row justify-content-center">
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
            <?php if($commande->getQuantite() >= $menu->getQuantiteMin() + 5){ ?>
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
                <div class="col-auto">
                    <p class="col-auto text white-text text-center m-0">Livraison le <?= htmlspecialchars($commande->getDateLivraison(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?> à <?= htmlspecialchars($commande->getHeureLivraison(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></p>
                    <p></p>
                    <p class="col-auto text white-text text-center m-0">Adresse de livraison : <?= htmlspecialchars($commande->getAdresseLivraison(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>, <?= htmlspecialchars($commande->getCodePostale(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>, <?= htmlspecialchars($commande->getVille(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></p>
                </div>
            </div>
        </div>
    </div>

    <?php require _ROOTPATH_.'/templates/separator.php'; ?>

</main>

<?php require_once _ROOTPATH_.'/templates/footer.php'; ?>