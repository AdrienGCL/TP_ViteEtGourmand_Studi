        <footer class="padding-t-l position-relative bottom-0">
            <h2 class="row justify-content-center headline primary-text m-0 margin-b-m">Nos horaires</h2>
            <?php foreach($horaire as $obj){ ?>
                <p class="row justify-content-center m-0 p-0 text white-text"><?= htmlspecialchars($obj->getJour(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?> de <?= htmlspecialchars($obj->getOuverture(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?> à <?= htmlspecialchars($obj->getFermeture(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></p>
            <?php } ?>
            <div class="row justify-content-center">
                <a class="col mx-0 margin-t-l p-0 text white-text text-center text-decoration-none" href="">Mentions légales</a>
                <a class="col mx-0 margin-t-l p-0 text white-text text-center text-decoration-none" href="">Conditions générales de vente</a>
                <a class="col mx-0 margin-t-l p-0 text white-text text-center text-decoration-none" href="">Nous contacter</a>
            </div>
        </footer>
    </div>
    
</body>
</html>