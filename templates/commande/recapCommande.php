<?php require_once _ROOTPATH_.'/templates/header.php'; ?>

<main>
            <form id="commandeForm" class="row text justify-content-center" action="" method="post">
                <div class="row justify-content-center margin-t-l">
                    <p class="col-auto headline primary-text m-0">Votre commande</p>
                </div>
                <div class="row justify-content-center margin-t-l">
                    <p class="col-auto text white-text m-0">Vos informations</p>
                </div>
                <div class="row justify-content-center margin-t-l">
                    <div class="col-10 col-md-4 bg-white radius-m">
                        <input class="customInput w-100" type="text" name="name" id="nameinput" placeholder="Nom" value="<?php echo($user->getNom()) ?>" required>
                    </div>
                </div>
                <div class="row justify-content-center margin-t-l">
                    <div class="col-10 col-md-4 bg-white radius-m">
                        <input class="customInput w-100" type="text" name="firstname" id="firstnameinput" placeholder="Prénom" value="<?php echo($user->getPrenom()) ?>" required>
                    </div>
                </div>
                <div class="row justify-content-center margin-t-l">
                    <div class="col-10 col-md-4 bg-white radius-m">
                        <input class="customInput w-100" type="text" name="mail" id="mailinput" placeholder="Adresse mail" value="<?php echo($user->getMail()) ?>" required>
                    </div>
                </div>
                <div class="row justify-content-center margin-t-l">
                    <div class="col-10 col-md-4 bg-white radius-m">
                        <input class="customInput w-100" type="tel" name="phone" id="phoneinput" placeholder="Numéro de téléphone" pattern="[0-9]{10}" value="<?php echo($user->getTelephone()) ?>" required>
                    </div>
                </div>
                <div class="row justify-content-center margin-t-l">
                    <p class="col-auto text white-text m-0">Votre évènement</p>
                </div>
                <div class="row justify-content-center margin-t-l">
                    <div class="col-10 col-md-4 bg-white radius-m">
                        <input class="customInput w-100" type="text" name="adresseprestation" id="adresseprestationinput" placeholder="Adresse de l'évènement" required>
                    </div>
                </div>
                <div class="row justify-content-center margin-t-l">
                    <div class="col-10 col-md-4 bg-white radius-m">
                            <label class="col-auto light-text m-0" for="dateprestationinput">Date de l'évènement</label>
                            <input class="customInput w-100" type="date" name="dateprestation" id="dateprestationinput" required>
                    </div>
                </div>
                <div class="row justify-content-center margin-t-l">
                    <p class="col-auto text white-text m-0">Votre livraison</p>
                </div>
                <div class="row justify-content-center margin-t-l">
                    <div class="col-10 col-md-4 bg-white radius-m">
                            <label class="col-auto light-text m-0" for="datelivraisoninput">Date de livraison souhaitée</label>
                            <input class="customInput w-100" type="date" name="datelivraison" id="datelivraisoninput" required>
                    </div>
                </div>
                <div class="row justify-content-center margin-t-l">
                    <div class="col-10 col-md-4 bg-white radius-m">
                            <label class="col-auto light-text m-0" for="heurelivraisoninput">Heure de livraison souhaitée</label>
                            <input class="customInput w-100" type="time" name="heurelivraison" id="heurelivraisoninput" required>
                    </div>
                </div>
                <div class="row justify-content-center margin-t-l">
                    <div class="col-10 col-md-4 bg-white radius-m">
                        <input class="customInput w-100" type="text" name="adresselivraison" id="adresselivraisoninput" placeholder="Adresse de livraison (si différente)">
                    </div>
                </div>
                <div class="row justify-content-center margin-t-l">
                    <p class="col-auto text white-text m-0">Votre menu</p>
                </div>
                <div class="row justify-content-center margin-t-l">
                    <div class="col-10 col-md-4 bg-white radius-m">
                        <input class="customInput w-100" type="text" name="menu" id="menuinput" placeholder="Menu sélectionné" value="<?php echo($menu->getTitre()) ?>" required>
                    </div>
                </div>
                <div class="row justify-content-center margin-t-l margin-b-l">
                    <div class="col-10 col-md-4 bg-white radius-m">
                        <input class="customInput w-100" type="number" name="quantite" id="quantiteinput" placeholder="Quantité (minimum <?php echo($menu->getQuantiteMin()) ?>)" min="<?php echo($menu->getQuantiteMin()) ?>" max="<?php echo($menu->getQuantiteDispo()) ?>" required>
                    </div>
                </div>

                <?php require _ROOTPATH_.'/templates/separator.php'; ?>

                <div class="row justify-content-center">
                    <div class="col-10 col-md-4 col-">
                        <div class="row justify-content-center margin-t-l">
                            <p class="col-auto headline primary-text text-center m-0">Récapitulatif de votre commande</p>
                        </div>
                        <div class="row justify-content-between margin-t-l">
                            <p class="col-auto text white-text m-0">Menu : <?php echo($menu->getTitre()) ?></p>
                            <p id="menuPrice" class="col-auto text white-text m-0"><?php echo($menu->getPrix()) ?>€/pers</p>
                        </div>
                        <div class="row justify-content-between">
                            <p id="quantity" class="col-auto text white-text m-0">Quantité : --</p>
                            <p id="quantityPrice" class="col-auto text white-text m-0">--€</p>
                        </div>
                        <div class="row justify-content-between margin-t-l">
                            <p id="livraison" class="col-auto text white-text m-0">Livraison (WIP)</p>
                            <p id="livraisonPrice" class="col-auto text white-text m-0">0€</p>
                        </div>
                        <div class="row justify-content-between margin-t-l">
                            <p id="remise" class="col-auto text white-text m-0">Remise (WIP)</p>
                            <p id="remisePrice" class="col-auto text white-text m-0">0€</p>
                        </div>
                        <div class="row justify-content-between margin-t-l">
                            <p class="col-auto headline primary-text m-0">Total</p>
                            <p id="totalPrice" class="col-auto headline primary-text m-0">--€</p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center margin-t-l">
                    <div class="col-auto">
                        <p class="col-auto text white-text text-center m-0">Rappel :</p>
                        <p class="col-auto text white-text text-center m-0">
                            <?php echo($entree->getlibelle()) ?>,<br><?php echo($plat->getlibelle()) ?>,<br><?php echo($dessert->getlibelle()) ?>
                            <br><br>Allergènes : 
                            <?php
                                $i = 0;
                                foreach($allergenes as $allergene){
                                    if(++$i === count($allergenes)){
                                        echo($allergene->getlibelle().'.');
                                    }
                                    else{
                                        echo($allergene->getlibelle().', ');
                                    }
                                }
                            ?><br><br>
                            <?php echo($menu->getConditions()) ?>
                        </p>
                    </div>
                </div>
                <div class="row justify-content-center margin-t-l margin-b-l">
                    <div class="col-auto">
                        <!-- <input class="customSubmit bouton text text-decoration-underline" type="submit" name="Commander" value="Commander"> -->
                         <div class="bouton bg-primary p-0 d-flex justify-content-center">
                            <a class="text dark-text text-decoration-underline m-0 p-0" href="./confirmation.php">Commander</a>
                        </div>
                    </div>
                </div>
            </form>

            <?php require _ROOTPATH_.'/templates/separator.php'; ?>

        </main>

        <script>
            let singleMenuPrice = <?php echo($menu->getPrix()) ?>;
        </script>

        <script src="./assets/js/commandeTools.js" defer></script>

        <?php require_once _ROOTPATH_.'/templates/footer.php'; ?>