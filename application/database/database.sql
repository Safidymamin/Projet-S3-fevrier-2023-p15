DROP DATABASE echange;
CREATE DATABASE echange;
USE echange;

CREATE TABLE Categorie(
    idCategorie INTEGER PRIMARY KEY auto_increment,
    categorie VARCHAR(100)
    );

CREATE TABLE Utilisateur(
    idUtilisateur INTEGER PRIMARY KEY auto_increment,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    email VARCHAR(100),
    motDePasse VARCHAR(100),
    estAdmin INTEGER
    );


CREATE TABLE Article(
    idArticle INTEGER PRIMARY KEY auto_increment,
    idUtilisateur INTEGER REFERENCES Utilisateur(idUtilisateur),
    idCategorie INTEGER REFERENCES Categorie(idCategorie),
    titre VARCHAR(255),
    description VARCHAR(500),
    prix FLOAT
    );

CREATE TABLE Proprietaire(
    idUtilisateur INTEGER REFERENCES Utilisateur(idUtilisateur),
    idArticle INTEGER REFERENCES Article(idArticle),
    dateTransfert TIMESTAMP
    );

CREATE TABLE Article_history(
    idArticle INTEGER PRIMARY KEY auto_increment,
    idUtilisateur INTEGER REFERENCES Utilisateur(idUtilisateur),
    idCategorie INTEGER REFERENCES Categorie(idCategorie),
    titre VARCHAR(255),
    description VARCHAR(500),
    prix FLOAT,
    datePossession TIMESTAMP
    );

CREATE TABLE Article_Photo(
    idArticle_Photo INTEGER PRIMARY KEY auto_increment,
    idArticle INTEGER REFERENCES Article(idArticle),
    nom VARCHAR(255)
    );

CREATE TABLE DemandeEchange_History(
    idDemandeEchange INTEGER PRIMARY KEY auto_increment,
    idArticle1 INTEGER REFERENCES Article(idArticle),
    idArticle2 INTEGER REFERENCES Article(idArticle),
    dateDemandeEchange TIMESTAMP,
    confirmation INTEGER
    );

CREATE TABLE DemandeEchange(
    idDemandeEchange INTEGER PRIMARY KEY auto_increment,
    idArticle1 INTEGER REFERENCES Article(idArticle),
    idArticle2 INTEGER REFERENCES Article(idArticle),
    dateDemandeEchange TIMESTAMP,
    confirmation INTEGER
    );


CREATE TABLE Echange(
    idEchange INTEGER PRIMARY KEY auto_increment,
    idDemandeEchange INTEGER REFERENCES DemandeEchange(idDemandeEchange),
    dateEchange TIMESTAMP
    );

CREATE TABLE Echange_history(
    idEchange INTEGER PRIMARY KEY auto_increment,
    idDemandeEchange INTEGER REFERENCES DemandeEchange(idDemandeEchange),
    dateEchange TIMESTAMP
    );



-- CREATE VIEW v_Demande as 
--     SELECT idDemandeEchange, idArticle1, idArticle2, a1.idUtilisateur as idUtilisateur1, a2.idUtilisateur as idUtilisateur2, a1.titre, a1.description, a2.titre as monTitre, a2.description as monDescription FROM DemandeEchange de JOIN article a1 ON de.idArticle1=a1.idArticleJOIN article a2 ON de.idArticle2=a2.idArticle
--     ;

-- CREATE VIEW v_proprietaire AS
--     SELECT pr.idUtilisateur, pr.idArticle, nom, prenom, titre, description, prix, dateTransfert FROM Proprietaire pr
--     JOIN Utilisateur ut on pr.idUtilisateur = ut.idUtilisateur
--     JOIN Article ar on pr.idArticle = ar.idArticle
--     ;

-- CREATE view liste_article as 
        -- SELECT ar.idArticle,ar.idUtilisateur,ar.idCategorie,ar.titre,ar.description,ar.prix,ap.nom
        --  from Article ar join Article_Photo ap on ar.idArticle=ap.idArticle;  



INSERT INTO Utilisateur VALUES (null,'Anthony','Johary','anthony@gmail.com','anthony',1);
INSERT INTO Utilisateur VALUES (null,'Safidy','Maminirina','safidy@gmail.com','safidy',1);

INSERT INTO Categorie VALUES (null,'Vetements');
INSERT INTO Categorie VALUES (null,'Chaussures');
INSERT INTO Categorie VALUES (null,'Electronique');
INSERT INTO Categorie VALUES (null,'Cuisine');
INSERT INTO Categorie VALUES (null,'Mecanique');

INSERT INTO Article_history VALUES (null,1,2,'Vans OffWhite','Portee une fois','100000.5',NOW());
INSERT INTO Article_history VALUES (null,1,5,'Echappement','Silencieux, occasion','160000',NOW());
INSERT INTO Article_history VALUES (null,2,1,'Chemise','2nd main tres bon etat','40000',NOW());
INSERT INTO Article_history VALUES (null,2,1,'Pantalon jean','Cargo ideal pour 1m80','85000',NOW());

INSERT INTO Article VALUES (null,1,2,'Vans OffWhite','Portee une fois','100000.5');
INSERT INTO Article VALUES (null,1,5,'Echappement','Silencieux, occasion','160000');
INSERT INTO Article VALUES (null,2,1,'Chemise','2nd main tres bon etat','40000');
INSERT INTO Article VALUES (null,2,1,'Pantalon jean','Cargo ideal pour 1m80','85000');


INSERT INTO Article_Photo VALUES (null,1,'vans_offwhite.jpeg');
INSERT INTO Article_Photo VALUES (null,2,'echappement.jpeg');
INSERT INTO Article_Photo VALUES (null,3,'chemise.jpeg');
INSERT INTO Article_Photo VALUES (null,4,'Cargo.jpeg');

INSERT INTO Proprietaire VALUES(1,1,now());
INSERT INTO Proprietaire VALUES(1,2,now());
INSERT INTO Proprietaire VALUES(2,3,now());
INSERT INTO Proprietaire VALUES(2,4,now());
