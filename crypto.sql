CREATE TABLE compte(
   Id_compte SERIAL,
   email VARCHAR(150)  NOT NULL,
   Id_utilisateur VARCHAR(50)  NOT NULL,
   PRIMARY KEY(Id_compte),
   UNIQUE(Id_utilisateur)
);

CREATE TABLE portefeuille(
   Id_portefeuille SERIAL,
   montant NUMERIC(18,2)  ,
   Id_compte INTEGER NOT NULL,
   PRIMARY KEY(Id_portefeuille),
   FOREIGN KEY(Id_compte) REFERENCES compte(Id_compte)
);

CREATE TABLE crypto(
   Id_crypto SERIAL,
   nom VARCHAR(50)  NOT NULL,
   PRIMARY KEY(Id_crypto)
);

CREATE TABLE taux(
   Id_taux SERIAL,
   prix NUMERIC(18,2)  ,
   date_taux DATE NOT NULL,
   Id_crypto INTEGER NOT NULL,
   PRIMARY KEY(Id_taux),
   FOREIGN KEY(Id_crypto) REFERENCES crypto(Id_crypto)
);

CREATE TABLE type_transaction(
   Id_type_transaction SERIAL,
   nom VARCHAR(150)  NOT NULL,
   PRIMARY KEY(Id_type_transaction)
);

CREATE TABLE transaction(
   Id_transaction SERIAL,
   montant NUMERIC(15,2)  ,
   date_transaction TIMESTAMP,
   Id_crypto INTEGER NOT NULL,
   Id_type_transaction INTEGER NOT NULL,
   Id_compte INTEGER NOT NULL,
   PRIMARY KEY(Id_transaction),
   FOREIGN KEY(Id_crypto) REFERENCES crypto(Id_crypto),
   FOREIGN KEY(Id_type_transaction) REFERENCES type_transaction(Id_type_transaction),
   FOREIGN KEY(Id_compte) REFERENCES compte(Id_compte)
);
