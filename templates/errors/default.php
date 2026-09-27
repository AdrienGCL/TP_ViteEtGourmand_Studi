<?php require_once _ROOTPATH_.'/templates/header.php'; ?>

<?php if($error) { ?>
    <div class="alert alert-danger text-center">
        <?= htmlspecialchars($error, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>
    </div>
<?php } ?>

<?php require_once _ROOTPATH_.'/templates/footer.php'; ?>