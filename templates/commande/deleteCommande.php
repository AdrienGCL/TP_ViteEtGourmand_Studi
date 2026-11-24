<?php require_once _ROOTPATH_.'/templates/header.php'; ?>

<main>
            <form id="commandeForm" class="row text justify-content-center" action="" method="post">
                <input
                    type="hidden"
                    name="csrf_token"
                    value="<?= htmlspecialchars($csrf->getToken(), ENT_QUOTES, 'UTF-8') ?>"
                >
                <div class="row justify-content-center margin-t-l">
                    <p class="col-auto headline primary-text m-0">Commande n° <?= htmlspecialchars($commande->getId(), ENT_QUOTES, 'UTF-8') ?> du <?= htmlspecialchars($commande->getDateCommande(), ENT_QUOTES, 'UTF-8') ?></p>
                </div>
                <div class="row justify-content-center margin-t-l">
                    <p class="col-auto text-white m-0">Etes-vous sûr de vouloir supprimer cette commande ?</p>
                </div>
                <div class="row justify-content-center margin-t-l margin-b-l">
                    <div class="col-auto">
                        <input class="customSubmit bouton text text-decoration-underline" type="submit" name="confirmer" value="Confirmer">
                    </div>
                    <div class="col-auto">
                        <input class="customSubmit bouton text text-decoration-underline" type="submit" name="annuler" value="Annuler">
                    </div>
                </div>
            </form>

    <?php require _ROOTPATH_.'/templates/separator.php'; ?>

</main>

<?php require_once _ROOTPATH_.'/templates/footer.php'; ?>