<?php require_once _ROOTPATH_.'\templates\header.php'; ?>

<main>
    <form id="registerForm" class="row text justify-content-center" action="" method="post">
        <div class="row justify-content-center margin-t-l">
            <p class="col-auto headline primary-text m-0">Inscription</p>
        </div>
        <div class="row justify-content-center margin-t-l">
            <div class="col-4 bg-white radius-m">
                <input class="customInput w-100" type="text" name="nameregister" id="nameRegisterinput" placeholder="Nom" required>
            </div>
        </div>
        <div class="row justify-content-center margin-t-l">
            <div class="col-4 bg-white radius-m">
                <input class="customInput w-100" type="text" name="firstnameregister" id="firstnameRegisterinput" placeholder="Prénom" required>
            </div>
        </div>
        <div class="row justify-content-center margin-t-l">
            <div class="col-4 bg-white radius-m">
                <input class="customInput w-100" type="tel" name="phoneregister" id="phoneRegisterinput" placeholder="Numéro de téléphone" pattern="[0-9]{10}" required>
            </div>
        </div>
        <div class="row justify-content-center margin-t-l">
            <div class="col-4 bg-white radius-m">
                <input class="customInput w-100" type="email" name="mail" id="mailinput" placeholder="Adresse mail" required>
            </div>
        </div>
        <div class="row justify-content-center margin-t-l">
            <div class="col-4 bg-white radius-m">
                <input class="customInput w-100" type="text" name="adresseregister" id="adresseRegisterinput" placeholder="Adresse" required>
            </div>
        </div>
        <div class="row justify-content-center margin-t-l">
            <div class="col-4 bg-white radius-m">
                <input class="customInput w-100" type="text" inputmode="numeric" pattern="[0-9]{5}" name="cpregister" id="cpRegisterinput" placeholder="Code postale" autocomplete="postal-code" required>
            </div>
        </div>
        <div class="row justify-content-center margin-t-l">
            <div class="col-4 bg-white radius-m">
                <input class="customInput w-100" type="text" name="villeregister" id="villeRegisterinput" placeholder="Ville" required>
            </div>
        </div>
        <div class="row justify-content-center margin-t-l">
            <div class="col-4 bg-white radius-m">
                <input class="customInput w-100" type="text" name="paysregister" id="PaysRegisterinput" placeholder="Pays" required>
            </div>
        </div>
        <div class="row justify-content-center margin-t-l">
            <div class="col-4 bg-white radius-m">
                <input class="customInput w-100" type="password" name="mdpregister" id="mdpRegisterinput" placeholder="Mot de passe" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" oninvalid="this.setCustomValidity('Veuillez utiliser au minimum 8 caractères, 1 majuscule, 1 minuscule et 1 chiffre.')" oninput="this.setCustomValidity('')" required>
            </div>
        </div>
        <div class="row justify-content-center margin-t-l">
            <a class="col-auto text primary-text" href="./index.php?controller=connexion&action=connexion">Déjà un compte ? Connectez-vous !</a>
        </div>
        <div class="row justify-content-center margin-t-l margin-b-l">
            <div class="col-auto">
                <input class="customSubmit bouton text text-decoration-underline" type="submit" name="Signin" value="S'inscrire">
            </div>
        </div>
        <?php if(isset($existingUser) && $existingUser === true){ ?>
        <div class="d-flex alert alert-danger justify-content-center" role="alert">
            <?="Un utilisateur existe déjà pour cette adresse mail."; ?>
        </div>
        <?php } ?>
    </form>
    <?php require _ROOTPATH_.'\templates\separator.php'; ?>
</main>

<?php require_once _ROOTPATH_.'\templates\footer.php'; ?>