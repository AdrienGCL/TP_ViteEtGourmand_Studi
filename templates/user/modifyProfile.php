<?php require_once _ROOTPATH_.'/templates/header.php'; ?>

<main>
    <form id="registerForm" class="row text justify-content-center" action="" method="post">
        <input
            type="hidden"
            name="csrf_token"
            value="<?= htmlspecialchars($csrf->getToken(), ENT_QUOTES, 'UTF-8') ?>"
        >
        <div class="row justify-content-center margin-t-l">
            <p class="col-auto headline primary-text m-0">Modifiez vos informations</p>
        </div>
        <div class="row justify-content-center margin-t-l">
            <div class="col-4 bg-white radius-m">
                <input class="customInput w-100" type="text" name="nameregister" id="nameRegisterinput" value="<?= htmlspecialchars($user->getNom(), ENT_QUOTES, 'UTF-8') ?>" required>
            </div>
        </div>
        <div class="row justify-content-center margin-t-l">
            <div class="col-4 bg-white radius-m">
                <input class="customInput w-100" type="text" name="firstnameregister" id="firstnameRegisterinput" placeholder="Prénom" value="<?= htmlspecialchars($user->getPrenom(), ENT_QUOTES, 'UTF-8') ?>" required>
            </div>
        </div>
        <div class="row justify-content-center margin-t-l">
            <div class="col-4 bg-white radius-m">
                <input class="customInput w-100" type="tel" name="phoneregister" id="phoneRegisterinput" placeholder="Numéro de téléphone" pattern="[0-9]{10}" value="<?= htmlspecialchars($user->getTelephone(), ENT_QUOTES, 'UTF-8') ?>" required>
            </div>
        </div>
        <div class="row justify-content-center margin-t-l">
            <div class="col-4 bg-white radius-m">
                <input class="customInput w-100" type="email" name="mail" id="mailinput" placeholder="Adresse mail" value="<?= htmlspecialchars($user->getMail(), ENT_QUOTES, 'UTF-8') ?>" required>
            </div>
        </div>
        <div class="row justify-content-center margin-t-l">
            <div class="col-4 bg-white radius-m">
                <input class="customInput w-100" type="text" name="adresseregister" id="adresseRegisterinput" placeholder="Adresse" value="<?= htmlspecialchars($user->getAdresse(), ENT_QUOTES, 'UTF-8') ?>" required>
            </div>
        </div>
        <div class="row justify-content-center margin-t-l">
            <div class="col-4 bg-white radius-m">
                <input class="customInput w-100" type="text" inputmode="numeric" pattern="[0-9]{5}" name="cpregister" id="cpRegisterinput" placeholder="Code postale" autocomplete="postal-code" value="<?= htmlspecialchars($user->getCodePostale(), ENT_QUOTES, 'UTF-8') ?>" required>
            </div>
        </div>
        <div class="row justify-content-center margin-t-l">
            <div class="col-4 bg-white radius-m">
                <input class="customInput w-100" type="text" name="villeregister" id="villeRegisterinput" placeholder="Ville" value="<?= htmlspecialchars($user->getVille(), ENT_QUOTES, 'UTF-8') ?>" required>
            </div>
        </div>
        <div class="row justify-content-center margin-t-l">
            <div class="col-4 bg-white radius-m">
                <input class="customInput w-100" type="text" name="paysregister" id="PaysRegisterinput" placeholder="Pays" value="<?= htmlspecialchars($user->getPays(), ENT_QUOTES, 'UTF-8') ?>" required>
            </div>
        </div>
        <div class="row justify-content-center margin-t-l">
            <div class="col-4 bg-white radius-m">
                <input class="customInput w-100" type="password" name="mdp" id="mdp" placeholder="Votre mot de passe" required>
            </div>
        </div>
        <div class="row justify-content-center margin-t-l">
            <div class="col-4 bg-white radius-m">
                <input class="customInput w-100" type="password" name="mdpconfirmregister" id="mdpConfirmRegisterinput" placeholder="Nouveau mot de passe (facultatif)" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" oninvalid="this.setCustomValidity('Veuillez utiliser au minimum 8 caractères, 1 majuscule, 1 minuscule et 1 chiffre.')" oninput="this.setCustomValidity('')">
            </div>
        </div>
        <div class="row justify-content-center margin-t-l margin-b-l">
            <div class="col-auto">
                <input class="customSubmit bouton text text-decoration-underline" type="submit" name="Valider" value="Confirmer">
            </div>
        </div>
        <?php if(isset($wrongPassword)){ ?>
        <div class="d-flex col-auto alert alert-danger justify-content-center margin-t-l" role="alert">
            <p><?="Mot de passe incorrect, merci de bien vouloir vérifier les champs et réessayer."; ?></p>
        </div>
        <?php } ?>
    </form>
    <div class="row justify-content-center margin-b-l">
        <div class="bouton bg-primary p-0 justify-content-center d-flex">
            <form action="" method="post" class="m-0">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf->getToken(), ENT_QUOTES, 'UTF-8') ?>">
                <input type="submit"class="text dark-text text-decoration-underline m-0 p-0 border-0 bg-transparent" value="Annuler" name="Annuler">
            </form>
        </div>
    </div>
    <?php require _ROOTPATH_.'/templates/separator.php'; ?>
</main>

<?php require_once _ROOTPATH_.'/templates/footer.php'; ?>