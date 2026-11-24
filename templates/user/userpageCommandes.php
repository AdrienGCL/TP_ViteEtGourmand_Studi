<?php require_once _ROOTPATH_.'/templates/header.php'; ?>

<main>
    <div class="row justify-content-center margin-t-l">
        <p class="col-auto headline primary-text m-0">Bienvenue <?php echo $userFirstName; ?></p>
    </div>
    <div class="row justify-content-center margin-t-l">
        <div class="col-10 d-flex">
            <div id="commandesBtn" class="bouton bg-primary p-0 d-flex justify-content-center">
                <a href="./index.php?controller=userpage&action=showCommandes" class="text dark-text text-decoration-underline m-0 p-0">Mes commandes</a>
            </div>
            <div id="profilBtn" class="bouton primary-border p-0 d-flex justify-content-center margin-l-m">
                <a href="./index.php?controller=userpage&action=showProfile" class="text primary-text text-decoration-underline m-0 p-0">Mon profil</a>
            </div>
        </div>
    </div>
    <div id="commandesDiv" class="row justify-content-center margin-t-l">
        <div class="col-10">
            <div class="row bg-extra-dark">
                <div class="row margin-t-l margin-b-l">
                    <?php $nbCommandesEnAttente = 0; ?>
                    <?php foreach($commandes as $commande) {
                        if($commande->getEtat() === 1) { $nbCommandesEnAttente++; } } ?>
                    <p class="col-auto headline primary-text m-0">En attente de validation (<?php echo $nbCommandesEnAttente; ?>)</p>
                </div>
                <?php foreach($commandes as $commande) {
                    if($commande->getEtat() === 1) { ?>
                        <div>
                            <form action="" method="post" class="row margin-b-s mx-0 align-items-center justify-content-between m-0">
                                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf->getToken(), ENT_QUOTES, 'UTF-8') ?>">
                                <input type="hidden" name="commande_id" value="<?= htmlspecialchars($commande->getId(), ENT_QUOTES, 'UTF-8') ?>">
                                <input type="submit" class="col text white-text p-0 m-0 fit bg-transparent border-0 text-start text-decoration-underline" name="viewCommande" value="Commande n°<?= htmlspecialchars((int) $commande->getId(), ENT_QUOTES, 'UTF-8') ?> du <?= date('d/m/Y', strtotime(htmlspecialchars($commande->getDateCommande(), ENT_QUOTES, 'UTF-8'))) ?>">
                                <p class="col text white-text p-0 m-0 fit text-center"><?= htmlspecialchars($etatCommandes[0]->getLibelle(), ENT_QUOTES, 'UTF-8') ?></p>
                                <div class="col d-flex p-0 justify-content-end margin-r-s">
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
                <?php } } ?>
                
                <?php require _ROOTPATH_.'/templates/separator.php'; ?>
            </div>
            <div class="row">
                <div class="row margin-t-l margin-b-l">
                    <?php $nbCommandesEnCours = 0; ?>
                    <?php foreach($commandes as $commande) {
                        if($commande->getEtat() > 1 && $commande->getEtat() < count($etatCommandes)) { $nbCommandesEnCours++; } } ?>
                    <p class="col-auto headline primary-text m-0">En cours (<?php echo $nbCommandesEnCours; ?>)</p>
                </div>
                <?php foreach($commandes as $commande) {
                    if($commande->getEtat() > 1 && $commande->getEtat() < count($etatCommandes)) { ?>
                        <div class="row margin-b-s mx-0 align-items-center justify-content-between">
                            <p class="col text white-text p-0 m-0 fit">Commande n°<?= htmlspecialchars((int) $commande->getId(), ENT_QUOTES, 'UTF-8') ?> du <?= date('d/m/Y', strtotime(htmlspecialchars($commande->getDateCommande(), ENT_QUOTES, 'UTF-8'))) ?></p>
                            <p class="col text white-text p-0 m-0 fit text-center"><?= htmlspecialchars($etatCommandes[$commande->getEtat()]->getLibelle(), ENT_QUOTES, 'UTF-8') ?></p>
                            <div class="col d-flex m-0 p-0 justify-content-end"></div>
                        </div>
                <?php } } ?>
                <?php require _ROOTPATH_.'/templates/separator.php'; ?>
            </div>
            <div class="row bg-extra-dark">
                <div class="row margin-t-l margin-b-l">
                    <?php $nbCommandesTerminees = 0; ?>
                    <?php foreach($commandes as $commande) {
                        if($commande->getEtat() === count($etatCommandes)) { $nbCommandesTerminees++; } } ?>
                    <p class="col-auto headline primary-text m-0">Terminées (<?php echo $nbCommandesTerminees; ?>)</p>
                </div>
                <?php foreach($commandes as $commande) {
                    if($commande->getEtat() === count($etatCommandes)) { ?>  
                        <div class="row mx-0 align-items-center justify-content-between">
                            <p class="col text white-text p-0 m-0 fit cursor-default" href="./index.php?controller=commande&action=reviewCommande&commande_id=<?= htmlspecialchars((int) $commande->getId(), ENT_QUOTES, 'UTF-8') ?>">Commande n° <?= htmlspecialchars((int) $commande->getId(), ENT_QUOTES, 'UTF-8') ?> du <?= date('d/m/Y', strtotime(htmlspecialchars($commande->getDateCommande(), ENT_QUOTES, 'UTF-8'))) ?></p>
                        </div>
                <?php } } ?>
                <?php require _ROOTPATH_.'/templates/separator.php'; ?>
            </div>
        </div>
    </div>
</main>

<?php require_once _ROOTPATH_.'/templates/footer.php'; ?>