<?php require_once _ROOTPATH_.'\templates\header.php'; ?>

<main>
    <form id="connexionForm" class="row text justify-content-center" action="" method="post">
        <div class="row justify-content-center margin-t-l">
            <p class="col-auto headline primary-text m-0">Connexion</p>
        </div>
        <div class="row justify-content-center margin-t-l">
            <div class="col-4 bg-white radius-m">
                <input class="customInput w-100" type="text" name="identifiant" id="idinput" placeholder="Adresse mail">
            </div>
        </div>
        <div class="row justify-content-center margin-t-l">
            <div class="col-4 bg-white radius-m">
                <input class="customInput w-100" type="password" name="mdp" id="mdpinput" placeholder="Mot de passe">
            </div>
        </div>
        <div class="row justify-content-center margin-t-l">
            <a class="col-auto text tertiary-text text-decoration-underline" href="">Mot de passe oublié ?</a>
        </div>
        <div class="row justify-content-center margin-t-l">
            <a class="col-auto text primary-text" href="./index.php?controller=connexion&action=inscription">Pas encore de compte ? Créez en un !</a>
        </div>
        <div class="row justify-content-center margin-t-l">
            <div class="col-auto">
                <input class="customSubmit bouton text text-decoration-underline" type="submit" name="loginUser" value="Se connecter">
            </div>
        </div>
        <?php if(isset($existingUser) && $existingUser === false OR isset($wrongPassword)){ ?>
        <div class="d-flex col-auto alert alert-danger justify-content-center margin-t-l" role="alert">
            <p><?="Utilisateur ou mot de passe incorrect, merci de bien vouloir vérifier les champs et réessayer.<br>Si vous n'avez pas encore de compte, "; ?><a href="./index.php?controller=connexion&action=inscription">inscrivez-vous !</a></p>
        </div>
        <?php } ?>
        
    </form>
    <div class="d-flex justify-content-center margin-t-l">
        <svg class="col-10 margin-b-0 p-0" height="2" xmlns="http://www.w3.org/2000/svg">
            <line class="separator" x1="0" y1="0" x2="100%" y2="0"/>
            Sorry, your browser does not support inline SVG.
        </svg>
    </div>
</main>

<?php require_once _ROOTPATH_.'\templates\footer.php'; ?>