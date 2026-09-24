CREATE DATABASE IF NOT EXISTS dbvitegourmand;

CREATE USER '' IDENTIFIED BY '';
GRANT CREATE, SELECT, INSERT, UPDATE, DELETE ON dbvitegourmand.* TO '';

CREATE TABLE dbvitegourmand.horaire (
    horaire_id INT AUTO_INCREMENT PRIMARY KEY,
    jour VARCHAR(50) NOT NULL,
    ouverture VARCHAR(50) NOT NULL,
    fermeture VARCHAR(50) NOT NULL
);

CREATE TABLE dbvitegourmand.regime (
    regime_id INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(50) NOT NULL
);

CREATE TABLE dbvitegourmand.theme (
    theme_id INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(50) NOT NULL
);

CREATE TABLE dbvitegourmand.allergenes (
    allergene_id INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(50) NOT NULL
);

CREATE TABLE dbvitegourmand.entree (
    entree_id INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(255) NOT NULL
);

CREATE TABLE dbvitegourmand.plat (
    plat_id INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(255) NOT NULL
);

CREATE TABLE dbvitegourmand.dessert (
    dessert_id INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(255) NOT NULL
);

CREATE TABLE dbvitegourmand.entree_allergenes (
    entree_id INT NOT NULL,
    allergene_id INT NOT NULL,
    PRIMARY KEY (entree_id, allergene_id),
    FOREIGN KEY (entree_id) REFERENCES dbvitegourmand.entree(entree_id),
    FOREIGN KEY (allergene_id) REFERENCES dbvitegourmand.allergenes(allergene_id)
);

CREATE TABLE dbvitegourmand.plat_allergenes (
    plat_id INT NOT NULL,
    allergene_id INT NOT NULL,
    PRIMARY KEY (plat_id, allergene_id),
    FOREIGN KEY (plat_id) REFERENCES dbvitegourmand.plat(plat_id),
    FOREIGN KEY (allergene_id) REFERENCES dbvitegourmand.allergenes(allergene_id)
);

CREATE TABLE dbvitegourmand.dessert_allergenes (
    dessert_id INT NOT NULL,
    allergene_id INT NOT NULL,
    PRIMARY KEY (dessert_id, allergene_id),
    FOREIGN KEY (dessert_id) REFERENCES dbvitegourmand.dessert(dessert_id),
    FOREIGN KEY (allergene_id) REFERENCES dbvitegourmand.allergenes(allergene_id)
);

CREATE TABLE dbvitegourmand.menu (
    menu_id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    quantite_min INT DEFAULT 1,
    prix DECIMAL(10,2) NOT NULL,
    description VARCHAR(255) NOT NULL,
    quantite_dispo INT NOT NULL,
    conditions VARCHAR(255),
    regime INT NOT NULL,
    theme INT NOT NULL,
    entree INT,
    plat INT NOT NULL,
    dessert INT,
    FOREIGN KEY (regime) REFERENCES dbvitegourmand.regime(regime_id),
    FOREIGN KEY (theme) REFERENCES dbvitegourmand.theme(theme_id),
    FOREIGN KEY (entree) REFERENCES dbvitegourmand.entree(entree_id),
    FOREIGN KEY (plat) REFERENCES dbvitegourmand.plat(plat_id),
    FOREIGN KEY (dessert) REFERENCES dbvitegourmand.dessert(dessert_id)
);

CREATE TABLE dbvitegourmand.etat_commande (
    etat_id INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(50) NOT NULL
);

CREATE TABLE dbvitegourmand.user_statut (
    user_statut_id INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(50) NOT NULL
);

CREATE TABLE dbvitegourmand.role (
    role_id INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(50) NOT NULL
);

CREATE TABLE dbvitegourmand.avis_statut (
    avis_statut_id INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(50) NOT NULL
);

CREATE TABLE dbvitegourmand.user (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    prenom VARCHAR(50) NOT NULL,
    nom VARCHAR(50) NOT NULL,
    telephone VARCHAR(12) NOT NULL,
    mail VARCHAR(50) NOT NULL,
    adresse VARCHAR(255) NOT NULL,
    code_postale INT NOT NULL,
    ville VARCHAR(50) NOT NULL,
    pays VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role INT DEFAULT 1,
    statut INT DEFAULT 1,
    FOREIGN KEY (role) REFERENCES dbvitegourmand.role(role_id),
    FOREIGN KEY (statut) REFERENCES dbvitegourmand.user_statut(user_statut_id)
);

CREATE TABLE dbvitegourmand.avis (
    avis_id INT AUTO_INCREMENT PRIMARY KEY,
    note INT NOT NULL,
    description VARCHAR(255) NOT NULL,
    user INT NOT NULL,
    statut INT NOT NULL,
    FOREIGN KEY (user) REFERENCES dbvitegourmand.user(user_id),
    FOREIGN KEY (statut) REFERENCES dbvitegourmand.avis_statut(avis_statut_id)
);

CREATE TABLE dbvitegourmand.commande (
    commande_id INT AUTO_INCREMENT PRIMARY KEY,
    date_commande DATE NOT NULL,
    date_livraison DATE NOT NULL,
    heure_livraison TIME NOT NULL,
    adresse_livraison VARCHAR(255) NOT NULL,
    code_postale INT NOT NULL,
    ville VARCHAR(50) NOT NULL,
    quantite INT NOT NULL,
    prix_ttc DECIMAL(10,2) NOT NULL,
    prix_livraison DECIMAL(10,2) NOT NULL,
    remise DECIMAL(10,2) NOT NULL,
    materiel BOOL DEFAULT 0,
    retour_materiel BOOL DEFAULT 0,
    menu INT NOT NULL,
    user INT NOT NULL,
    etat INT NOT NULL,
    FOREIGN KEY (menu) REFERENCES dbvitegourmand.menu(menu_id),
    FOREIGN KEY (user) REFERENCES dbvitegourmand.user(user_id),
    FOREIGN KEY (etat) REFERENCES dbvitegourmand.etat_commande(etat_id)
);