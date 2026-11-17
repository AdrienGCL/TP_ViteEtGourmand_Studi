<?php require_once _ROOTPATH_.'/templates/header.php'; ?>


<div class="alert alert-danger text-center">
    <h2>Oups !</h2>
    <p>Aucune correspondance trouvée pour l'adresse saisie. Veuillez vérifier l'adresse et réessayer.</p>
</div>

<div class="row justify-content-center padding-t-l margin-b-l">
    <div class="bouton bg-primary p-0 d-flex justify-content-center">
        <form action="./index.php?controller=authenticator&action=commander" method="post" class="m-0">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf->getToken(), ENT_QUOTES, 'UTF-8') ?>">

            <input type="hidden" name="menuId" value="<?= htmlspecialchars((string) $menuId, ENT_QUOTES, 'UTF-8') ?>">

            <button type="submit" class="text dark-text text-decoration-underline m-0 p-0 border-0 bg-transparent">Continuer</button>
        </form>
    </div>
</div>

<?php require_once _ROOTPATH_.'/templates/footer.php'; ?>