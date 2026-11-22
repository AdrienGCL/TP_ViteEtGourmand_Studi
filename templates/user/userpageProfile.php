<?php require_once _ROOTPATH_.'/templates/header.php'; ?>

<main>
    <div class="row justify-content-center margin-t-l">
        <p class="col-auto headline primary-text m-0">Bienvenue <?php echo $user->getPrenom(); ?></p>
    </div>
    <div class="row justify-content-center margin-t-l">
        <div class="col-10 d-flex">
            <div id="commandesBtn" class="bouton primary-border p-0 d-flex justify-content-center">
                <a href="./index.php?controller=userpage&action=showCommandes" class="text primary-text text-decoration-underline m-0 p-0">Mes commandes</a>
            </div>
            <div id="profilBtn" class="bouton bg-primary p-0 d-flex justify-content-center margin-l-m">
                <a href="./index.php?controller=userpage&action=showProfile" class="text dark-text text-decoration-underline m-0 p-0">Mon profil</a>
            </div>
        </div>
    </div>
    <div id="profilDiv" class="row justify-content-center bg-extra-dark margin-t-l">
        <div class="col-auto margin-t-l margin-b-l">
            <p class="headline primary-text text-center m-0"><?php echo $user->getPrenom() . ' ' . $user->getNom(); ?></p>
            <p class="text white-text text-center margin-t-s"><?php echo $user->getMail(); ?></p>
            <p class="text white-text text-center margin-t-s">Mot de passe : **********</p>
            <p class="text white-text text-center margin-t-s"><?php echo $user->getTelephone(); ?></p>
            <p class="text white-text text-center margin-t-s"><?php echo $user->getAdresse() . '<br>' . $user->getCodePostale() . ' ' . $user->getVille() .'<br>' . $user->getPays(); ?></p>
            
            <form action="" method="post" class="m-0">
                <div class="row justify-content-center margin-t-l">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf->getToken(), ENT_QUOTES, 'UTF-8') ?>">
                    <button type="submit" class="modify-btn primary-border bg-dark radius-m" name="modifyProfile">
                        <i class="bi bi-pencil-fill primary-text fit"></i>
                    </button>
                </div>
            </form>
        </div>
        <?php require _ROOTPATH_.'/templates/separator.php'; ?>
    </div>
</main>

<?php require_once _ROOTPATH_.'/templates/footer.php'; ?>