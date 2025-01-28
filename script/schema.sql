CREATE TABLE sexes (
    id_sexe SERIAL PRIMARY KEY,
    sexe VARCHAR(50) NOT NULL
);


CREATE TABLE configurations (
    id_configuration SERIAL PRIMARY KEY,
    cle VARCHAR(255) NOT NULL,
    valeur TEXT NOT NULL
);





CREATE TABLE tokens (
    id_token SERIAL PRIMARY KEY,
    token VARCHAR(255) NOT NULL,
    date_expiration TIMESTAMP NOT NULL,
    id_utilisateurs INTEGER NOT NULL,
    CONSTRAINT fk_token_utilisateur FOREIGN KEY (id_utilisateurs) REFERENCES utilisateurs (id_utilisateurs) ON DELETE CASCADE
);


CREATE TABLE utilisateurs (
    id_utilisateurs SERIAL PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    date_naissance DATE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    etat BOOLEAN DEFAULT FALSE,
    nb_tentative INTEGER DEFAULT 0,
    id_sexe INTEGER,
    CONSTRAINT fk_sexe FOREIGN KEY (id_sexe) REFERENCES sexes (id_sexe) ON DELETE SET NULL
);


CREATE TABLE code_pin (
    id_code_pin SERIAL PRIMARY KEY,
    codepin VARCHAR(255) NOT NULL,
    date_expiration TIMESTAMP NOT NULL,
    id_utilisateurs INTEGER NOT NULL,
    CONSTRAINT fk_code_pin_utilisateur FOREIGN KEY (id_utilisateurs) REFERENCES utilisateurs (id_utilisateurs) ON DELETE CASCADE
);