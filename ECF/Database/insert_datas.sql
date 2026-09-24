INSERT INTO dbvitegourmand.etat_commande(libelle)
VALUES
    ('En attente'),
    ('Acceptée'),
    ('En préparation'),
    ('En cours de livraison'),
    ('Livrée'),
    ('En attente du retour de matériel'),
    ('Terminée');

INSERT INTO dbvitegourmand.user_statut(libelle)
VALUES
    ('Autorisé'),
    ('Suspendu');

INSERT INTO dbvitegourmand.role(libelle)
VALUES
    ('Utilisateur'),
    ('Employé'),
    ('Administrateur');

INSERT INTO dbvitegourmand.avis_statut(libelle)
VALUES
    ('En attente'),
    ('Validé'),
    ('Refusé');

INSERT INTO dbvitegourmand.theme(libelle)
VALUES
    ('Classique'),
    ('Noël'),
    ('Pâques'),
    ('Evènements');

INSERT INTO dbvitegourmand.regime(libelle)
VALUES
    ('Classique'),
    ('Végétarien'),
    ('Végan');

INSERT INTO dbvitegourmand.allergenes(libelle)
VALUES
    ('Lait'),
    ('Gluten'),
    ('Fruits à coque'),
    ('Oeufs'),
    ('Sésame'),
    ('Poisson'),
    ('Soja');

INSERT INTO dbvitegourmand.entree(libelle)
VALUES
    ('Salade de chèvre chaud'),
    ('Velouté de potimarron'),
    ('Foie gras de canard, chutney de figues'),
    ('Feuilleté aux champignons'),
    ('Œufs mimosa'),
    ('Houmous et crudités'),
    ('Tartare de saumon'),
    ('Salade de pâtes'),
    ('Gaspacho de tomates'),
    ('Taboulé libanais'),
    ('Soupe à l’oignon'),
    ('Carottes râpées'),
    ('Bruschetta tomate'),
    ('Saint-Jacques poêlées'),
    ('Asperges vinaigrette'),
    ('Terrine de campagne'),
    ('Soupe de légumes'),
    ('Salade caprese'),
    ('Wrap au thon'),
    ('Carpaccio de légumes');

INSERT INTO dbvitegourmand.plat(libelle)
VALUES
    ('Suprême de poulet rôti, pommes grenailles'),
    ('Lasagnes aux légumes grillés'),
    ('Dinde farcie aux marrons'),
    ('Risotto aux cèpes'),
    ('Gigot d’agneau, légumes de saison'),
    ('Curry de légumes et pois chiches'),
    ('Filet de bœuf sauce morilles'),
    ('Sauté de volaille'),
    ('Quiche aux légumes'),
    ('Burger végan'),
    ('Boeuf bourguignon'),
    ('Nuggets de poulet'),
    ('Ratatouille maison'),
    ('Chapon rôti'),
    ('Omelette aux fines herbes'),
    ('Saucisse purée'),
    ('Tofu mariné, riz'),
    ('Spaghetti bolognaise'),
    ('Sandwich club'),
    ('Parmentier végétal');

INSERT INTO dbvitegourmand.dessert(libelle)
VALUES
    ('Tarte aux pommes maison'),
    ('Mousse au chocolat'),
    ('Bûche chocolat-praliné'),
    ('Bûche aux fruits rouges'),
    ('Nid de Pâques au chocolat'),
    ('Compote de fruits frais'),
    ('Entremets vanille-framboise'),
    ('Brownie chocolat'),
    ('Salade de fruits frais'),
    ('Cake citron végétal'),
    ('Crème brûlée'),
    ('Yaourt sucré'),
    ('Panna cotta'),
    ('Opéra au chocolat'),
    ('Fraises au sucre'),
    ('Riz au lait'),
    ('Compote pomme-poire'),
    ('Tiramisu'),
    ('Cookie chocolat'),
    ('Brownie végan');

INSERT INTO dbvitegourmand.entree_allergenes(entree_id, allergene_id)
VALUES
    ('1','1'),
    ('4','2'),
    ('5','4'),
    ('7','6'),
    ('8','2'),
    ('8','4'),
    ('10','2'),
    ('13','2'),
    ('14','6'),
    ('19','6'),
    ('19','2');

INSERT INTO dbvitegourmand.plat_allergenes(plat_id, allergene_id)
VALUES
    ('2','1'),
    ('2','2'),
    ('3','3'),
    ('6','5'),
    ('9','4'),
    ('9','2'),
    ('9','1'),
    ('10','2'),
    ('12','2'),
    ('15','4'),
    ('16','1'),
    ('17','7'),
    ('18','2'),
    ('18','4'),
    ('19','2');

INSERT INTO dbvitegourmand.dessert_allergenes(dessert_id, allergene_id)
VALUES
    ('1','2'),
    ('2','1'),
    ('2','2'),
    ('3','1'),
    ('3','2'),
    ('4','1'),
    ('4','2'),
    ('5','1'),
    ('7','1'),
    ('8','1'),
    ('8','2'),
    ('8','3'),
    ('10','2'),
    ('11','1'),
    ('12','1'),
    ('14','1'),
    ('16','1'),
    ('18','1'),
    ('18','2'),
    ('19','1'),
    ('19','2'),
    ('20','2');

INSERT INTO dbvitegourmand.menu(titre, quantite_min, prix, description, quantite_dispo, conditions, regime, theme, entree, plat, dessert)
VALUES
    ('Tradition Gourmande','10', '15', 'Un menu équilibré et convivial, idéal pour tous types d’événements.', '45', 'Commande 48h à l’avance', '1', '1', '1', '1', '1'),
    ('Saveurs Végétariennes','8', '14', 'Une alternative végétarienne savoureuse et colorée.', '60', 'Conservation au frais (+4°C)', '2', '1', '2', '2', '2'),
    ('Festin de Noël','12', '25', 'Un menu festif aux saveurs traditionnelles de fin d’année.', '20', 'Délai de préparation 72h', '1', '2', '3', '3', '3'),
    ('Noël Végétarien','10', '22', 'Un menu de fêtes sans viande, tout en gourmandise.', '15', 'À consommer sous 24h', '2', '2', '4', '4', '4'),
    ('Printemps Pascal','12', '23', 'Des saveurs douces et printanières pour célébrer Pâques.', '18', 'Préparation 48h minimum', '1', '3', '5', '5', '5'),
    ('Pâques Végétal','8', '16', 'Un menu pascal 100 % végétal.', '50', 'Stockage à +4°C', '3', '3', '6', '6', '6'),
    ('Événement Prestige','20', '25', 'Menu raffiné pour réceptions et soirées professionnelles.', '30', 'Livraison incluse, délai 72h', '1', '4', '7', '7', '7'),
    ('Buffet Convivial','30', '12', 'Menu simple et efficace pour grands groupes.', '80', 'Vaisselle non incluse', '1', '4', '8', '8', '8'),
    ('Menu Fraîcheur','10', '13', 'Léger et équilibré pour événements estivaux.', '55', 'À maintenir au frais', '2', '1', '9', '9', '9'),
    ('Menu Vegan Urbain','10', '18', 'Cuisine végétale moderne et savoureuse.', '40', 'Consommation sous 24h', '3', '4', '10', '10', '10'),
    ('Classique Français','12', '20', 'Les incontournables de la cuisine française.', '30', 'Réchauffage nécessaire', '1', '1', '11', '11', '11'),
    ('Menu Enfants','15', '10', 'Menu simple et apprécié des plus jeunes.', '90', 'Portions adaptées enfants', '1', '4', '12', '12', '12'),
    ('Menu Méditerranéen','10', '17', 'Saveurs du sud et cuisine ensoleillée.', '35', 'À conserver au frais', '2', '1', '13', '13', '13'),
    ('Menu Prestige Noël','15', '25', 'Menu haut de gamme pour repas de fin d’année.', '32', 'Préparation 72h', '1', '2', '14', '14', '14'),
    ('Menu Printanier','8', '15', 'Fraîcheur et légèreté de saison.', '50', 'À consommer rapidement', '2', '3', '15', '15', '15'),
    ('Menu Campagnard','12', '18', 'Cuisine rustique et généreuse.', '40', 'Réchauffage conseillé', '1', '1', '16', '16', '16'),
    ('Menu Bio Végétal','10', '19', 'Menu végan à base de produits simples.', '30', 'Stockage au frais', '3', '1', '17', '17', '17'),
    ('Menu Italien','10', '18', 'Inspiration italienne traditionnelle.', '35', 'À consommer sous 24h', '1', '1', '18', '18', '18'),
    ('Menu Express','20', '11', 'Menu rapide pour réunions professionnelles.', '70', 'Livraison froide', '1', '4', '19', '19', '19'),
    ('Menu Gourmand Vegan','10', '21', 'Menu végan généreux et créatif.', '25', 'Réchauffage possible', '3', '4', '20', '20', '20');

