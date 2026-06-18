<?php require_once _ROOTPATH_.'\templates\header.php'; ?>


    <main>
            <section class="bg-extra-dark">
                <div class="row justify-content-center padding-t-l">
                    <article class="col-4 margin-r-m p-0">
                        <h2 class="row justify-content-center brand-m primary-text">Vite & Gourmand</h2>
                        <p class="mx-0 margin-t-l p-0 text white-text">Vite & Gourmand, traiteur d’exception à Bordeaux depuis 25 ans, est le fruit de la passion et du savoir-faire de Julie et José. Animés par l’amour des beaux produits et du travail bien fait, ils imaginent des créations culinaires raffinées pour sublimer chaque événement.<br><br>Mariages, réceptions privées, repas d’entreprise, fêtes de fin d’année ou célébrations familiales : chaque prestation est conçue comme une expérience sur mesure, alliant élégance, créativité et exigence. Au fil des saisons, la carte évolue pour mettre à l’honneur des produits soigneusement sélectionnés et des associations de saveurs délicates.<br><br>Avec Vite & Gourmand, l’art de recevoir prend toute sa dimension.</p>
                    </article>
                    <div class="col-4 margin-l-m p-0">
                        <img class="img-main" src="<?php _ROOTPATH_ ?>/assets/img/table.jpg" alt="Photographie d'un repas">
                    </div>
                </div>
                <div class="row justify-content-center padding-t-l margin-b-l">
                    <div class="bouton bg-primary p-0 d-flex justify-content-center">
                        <a class="text dark-text text-decoration-underline m-0 p-0" href="./index.php?controller=menu">Commander</a>
                    </div>
                </div>
                <?php require _ROOTPATH_.'\templates\separator.php'; ?>
            </section>
            <section>
                <div class="row justify-content-center padding-t-l">
                    <div class="col-4 margin-r-m p-0">
                        <img class="img-main" src="<?php _ROOTPATH_ ?>/assets/img/equipe.jpg" alt="Photographie de l'équipe">
                    </div>
                    <article class="col-4 margin-l-m p-0">
                        <h2 class="row justify-content-center headline primary-text">L'équipe</h2>
                        <p class="mx-0 margin-t-l p-0 text white-text">Derrière Vite & Gourmand, il y a avant tout une équipe de professionnels passionnés, animés par le goût de l’excellence et le sens du détail.<br><br>À sa tête, Julie et José mettent leur expertise culinaire et leur parfaite connaissance de l’événementiel au service de prestations sur mesure. Leur maîtrise des techniques traditionnelles, alliée à une créativité constamment renouvelée, leur permet d’imaginer des créations élégantes, équilibrées et raffinées.<br><br>Autour d’eux, une brigade engagée et rigoureuse œuvre chaque jour avec précision et exigence. Cuisiniers, pâtissiers et personnel de service partagent des valeurs communes : sélection attentive des produits, maîtrise des savoir-faire, organisation irréprochable et sens du service attentif.<br><br>Chaque événement est préparé avec soin et coordination afin de garantir une expérience fluide, harmonieuse et mémorable. Chez Vite & Gourmand, l’excellence est avant tout un travail d’équipe.</p>
                    </article>
                </div>
                <div class="row justify-content-center padding-t-l margin-b-l">
                    <div class="bouton bg-primary p-0 d-flex justify-content-center">
                        <a class="text dark-text text-decoration-underline m-0 p-0" href="./index.php?controller=menu">Commander</a>
                    </div>
                </div>
                <?php require _ROOTPATH_.'\templates\separator.php'; ?>
            </section>

            <section class="padding-t-l bg-extra-dark">
                <h2 class="row justify-content-center headline primary-text m-0">Ce que nos clients en pensent</h2>
                <div id="myCarousel" class="carousel slide m-0 p-0" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <!-- Création d'un bouton pour chaque item du carousel -->
                        <?php for($i = 0; $i<count($avis); $i++){ ?>
                        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="<?php echo($i) ?>" aria-label="Slide <?php echo($i+1) ?>" <?php if($i==0){?>class="active" aria-current="true"<?php } ?>></button>
                        <?php } ?>
                    </div>
                    <div class="carousel-inner">
                        <!-- Création d'un item dans le carousel pour chaque avis  -->
                        <?php for($i=0; $i<count($avis); $i++){ ?>
                            <div class="carousel-item <?php if($i==0){?>active<?php } ?> margin-b-l  margin-l-l">
                                <div class="d-flex full-width justify-content-center">
                                    <div class="bg-primary padding-s margin-t-l radius-m">
                                        <h3 class="headline dark-text m-0 margin-b-s">
                                            <?php echo($avis[$i]->getUserFirstname())?> <?php echo(substr($avis[$i]->getUserName(), 0, 1)) ?>. - <?php echo($avis[$i]->getNote()) ?>/5
                                        </h3>
                                        <div class="bg-light padding-m radius-m">
                                            <p class="m-0 p-0 text white-text text-center"><?php echo($avis[$i]->getDescription())?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <?php require _ROOTPATH_.'\templates\separator.php'; ?>
            </section>
        </main>

<?php require_once _ROOTPATH_.'\templates\footer.php'; ?>