<?php require_once _ROOTPATH_.'\templates\header.php'; ?>

<main>
    <div class="margin-t-l margin-b-l">
        <div class="row justify-content-center">
            <p class="headline primary-text col-auto margin-b-s">Bienvenue !</p>
        </div>
        <div class="row justify-content-center">
            <p class="text white-text col-auto m-0">Votre inscription a bien été prise en compte, vous pouvez dès à présent vous connecter.</p>
        </div>
        <div class="row justify-content-center padding-t-l">
            <div class="bouton bg-primary p-0 d-flex justify-content-center">
                <a class="text dark-text text-decoration-underline m-0 p-0" href="./index.php?controller=connexion&action=connexion">Se connecter</a>
            </div>
        </div>
    </div>
    <?php require _ROOTPATH_.'\templates\separator.php'; ?>
</main>

<?php require_once _ROOTPATH_.'\templates\footer.php'; ?>