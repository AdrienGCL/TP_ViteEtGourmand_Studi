<?php require_once _ROOTPATH_.'\templates\header.php'; ?>

<main>
    <div class="row justify-content-center margin-t-l">
        <p class="col-auto headline primary-text m-0">Bienvenue [username]</p>
    </div>
    <div class="row justify-content-center margin-t-l">
        <div class="col-10 d-flex">
            <div id="commandesBtn" class="bouton bg-primary p-0 d-flex justify-content-center">
                <p class="text dark-text text-decoration-underline m-0 p-0">Mes commandes</p>
            </div>
            <div id="profilBtn" class="bouton primary-border p-0 d-flex justify-content-center margin-l-m">
                <p class="text primary-text text-decoration-underline m-0 p-0">Mon profil</p>
            </div>
        </div>
    </div>
    <div id="commandesDiv" class="row justify-content-center margin-t-l">
        <div class="col-10">
            <div class="row bg-extra-dark">
                <div class="row margin-t-l margin-b-l">
                    <p class="col-auto headline primary-text m-0">En attente de validation (nb)</p>
                </div>
                <div class="row margin-b-s mx-0 align-items-center justify-content-between">
                    <a class="col text white-text p-0 m-0 fit" href="./detail_commande.php">Commande n° xxxxx du xx/xx/xxxx</a>
                    <p class="col text white-text p-0 m-0 fit text-center">En attente</p>
                    <div class="col d-flex m-0 p-0 justify-content-end">
                        <div class="modify-btn primary-border padding-xs radius-m">
                            <i class="bi bi-pencil-fill primary-text fit"></i>
                        </div>
                        <div class="modify-btn border-tertiary padding-xs radius-m margin-l-s">
                            <i class="bi bi-trash-fill tertiary-text fit"></i>
                        </div>
                    </div>
                </div>
                <div class="row mx-0 align-items-center justify-content-between">
                    <a class="col text white-text p-0 m-0 fit" href="./detail_commande.php">Commande n° xxxxx du xx/xx/xxxx</a>
                    <p class="col text white-text p-0 m-0 fit text-center">En attente</p>
                    <div class="col d-flex p-0 m-0 justify-content-end">
                        <div class="modify-btn primary-border radius-m">
                            <i class="bi bi-pencil-fill primary-text fit"></i>
                        </div>
                        <div class="modify-btn border-tertiary radius-m margin-l-s">
                            <i class="bi bi-trash-fill tertiary-text fit"></i>
                        </div>
                    </div>
                </div>
                <?php require _ROOTPATH_.'\templates\separator.php'; ?>
            </div>
            <div class="row">
                <div class="row margin-t-l margin-b-l">
                    <p class="col-auto headline primary-text m-0">En cours (nb)</p>
                </div>
                <div class="row mx-0 align-items-center justify-content-between">
                    <a class="col text white-text p-0 m-0 fit cursor-default" href="">Commande n° xxxxx du xx/xx/xxxx</a>
                    <p class="col text white-text p-0 m-0 fit text-center">En préparation</p>
                    <div class="col d-flex p-0 m-0 justify-content-end"></div>
                </div>
                <?php require _ROOTPATH_.'\templates\separator.php'; ?>
            </div>
            <div class="row bg-extra-dark">
                <div class="row margin-t-l margin-b-l">
                    <p class="col-auto headline primary-text m-0">Terminées (nb)</p>
                </div>
                <div class="row mx-0 align-items-center justify-content-between">
                    <a class="col text white-text p-0 m-0 fit cursor-default" href="">Commande n° xxxxx du xx/xx/xxxx</a>
                </div>
                <div class="row mx-0 align-items-center justify-content-between">
                    <a class="col text white-text p-0 m-0 fit cursor-default" href="">Commande n° xxxxx du xx/xx/xxxx</a>
                </div>
                <div class="row mx-0 align-items-center justify-content-between">
                    <a class="col text white-text p-0 m-0 fit cursor-default" href="">Commande n° xxxxx du xx/xx/xxxx</a>
                </div>
                <div class="row mx-0 align-items-center justify-content-between">
                    <a class="col text white-text p-0 m-0 fit cursor-default" href="">Commande n° xxxxx du xx/xx/xxxx</a>
                </div>
                <?php require _ROOTPATH_.'\templates\separator.php'; ?>
            </div>
        </div>
    </div>
    <div id="profilDiv" class="row justify-content-center bg-extra-dark margin-t-l d-none">
        <div class="col-auto margin-t-l margin-b-l">
            <p class="headline primary-text text-center m-0">Prénom Nom</p>
            <p class="text white-text text-center margin-t-s">N° de téléphone : 06XXXXXXXX</p>
            <p class="text white-text text-center margin-t-s">Adresse mail : username@mail.com</p>
            <p class="text white-text text-center margin-t-s">Mot de passe : **********</p>
            <div class="row justify-content-center margin-t-l">
                <div class="modify-btn primary-border radius-m">
                    <i class="bi bi-pencil-fill primary-text fit"></i>
                </div>
            </div>
        </div>
        <?php require _ROOTPATH_.'\templates\separator.php'; ?>
    </div>
</main>

<?php require_once _ROOTPATH_.'\templates\footer.php'; ?>