DROP DATABASE IF EXISTS LBC;
CREATE DATABASE LBC;
USE LBC;

-- STRUCTURE DE LA BASE DE DONNÉES

CREATE TABLE User (
    ident INT(10) AUTO_INCREMENT,
    pseudo VARCHAR(50) NOT NULL,
    mail VARCHAR(320) NOT NULL,
    mdp VARCHAR(255) NOT NULL CHECK(LENGTH(mdp) > 12),
    date_inscription TIMESTAMP NOT NULL,
    PRIMARY KEY(ident)
);

CREATE TABLE Admin(
    id INT(10) AUTO_INCREMENT,
    ident INT(10),
    date_Admin TIMESTAMP NOT NULL,
    PRIMARY KEY(id,ident),
    FOREIGN KEY (ident) REFERENCES User(ident)
);

CREATE TABLE Categorie (
    code INT(10) AUTO_INCREMENT,
    libelle VARCHAR(255) NOT NULL,
    PRIMARY KEY(code)
);

CREATE TABLE sousCategorie (
    code INT(10) AUTO_INCREMENT,
    codeCat INT(10),
    libelle VARCHAR(255) NOT NULL,
    PRIMARY KEY(code,codeCat),
    FOREIGN KEY (codeCat) REFERENCES Categorie(code)
);


CREATE TABLE Item (
    ref INT(10) AUTO_INCREMENT,
    identVendeur INT(10),
    nom VARCHAR(255) NOT NULL,
    prix INT(10) NOT NULL,
    description TEXT,
    codeSousCat INT(10),
    dateMiseEnLigne TIMESTAMP NOT NULL,
    PRIMARY KEY(ref),
    FOREIGN KEY (identVendeur) REFERENCES User(ident),
    FOREIGN KEY (codeSousCat) REFERENCES sousCategorie(code)
);

CREATE TABLE Conversation (
    idConv INT(10) AUTO_INCREMENT,
    refItem INT(10),
    identAcheteur INT,
    PRIMARY KEY(idConv),
    FOREIGN KEY (refItem) REFERENCES Item(ref),
    FOREIGN KEY (identAcheteur) REFERENCES User(ident)
);

CREATE TABLE Message (
    codeMess INT(10) AUTO_INCREMENT,
    idConv INT(10),
    message VARCHAR(200),
    identEnvoyeur INT(10),
    dateMess TIMESTAMP NOT NULL,
    PRIMARY KEY(codeMess),
    FOREIGN KEY (idConv) REFERENCES Conversation(idConv),
    FOREIGN KEY (identEnvoyeur) REFERENCES User(ident)
);


-- INSERTS

INSERT INTO USER (pseudo, mail, mdp, date_inscription) VALUES 
("User1", "user1@gmail.com", "59029276955677351421b3ff6bf5ee4c", current_date()),
("User2", "user2@gmail.com", "fa7c3fcb670a58aa3e90a391ea533c99", current_date()),
("User3", "user3@gmail.com", "a3012064ea70afa9351e80e4a62b5dcb", current_date()),
("User4", "user4@gmail.com", "de934b5a66b34c72636d2e34ad075e8d", current_date());

INSERT INTO ADMIN (ident, date_Admin) VALUES 
(1, current_date());

INSERT INTO Categorie (libelle) VALUES 
("Sports De Raquette"),
("Sports De Combat"),
("Sports Collectifs"),
("Sports Extremes");

INSERT INTO sousCategorie (codeCat, libelle) VALUES 
(1, "Badminton"),
(1, "Tennis"),
(1, "PingPong"),
(2, "Boxe"),
(2, "Judo"),
(2, "Karate"),
(3, "Football"),
(3, "Rugby"),
(3, "Handball"),
(3, "Basket"),
(4, "Escalade"),
(4, "Slack Line"),
(4, "Ski Alpin"),
(4, "Parachute");

INSERT INTO Item (identVendeur, nom, prix, description, codeSousCat, dateMiseEnLigne) VALUES
(2,"Grigri", 60, "descendeur d'escalade", 11, current_date()),
(3,"Gants Boxe", 30, "bon etat, gants de boxe taille 11", 4, current_date()),
(4,"Ballon de Handball", 10, "Ballon de handball pour enfant taille 00", 9, current_date());

INSERT INTO Conversation (refItem, identAcheteur) VALUES
(1,2),
(1,3),
(1,4);

INSERT INTO Message (idConv, message, identEnvoyeur, dateMess) VALUES
(1,"HELLO", 1, current_date()),
(1,"HELLO", 2, current_date());

-- PROCEDURES STOCKÉES 

DELIMITER //

-- ITEMS
CREATE PROCEDURE GetItems()
BEGIN
    SELECT ref, identVendeur, nom, prix, description, codeSousCat, dateMiseEnLigne FROM Item;
END //

CREATE PROCEDURE GetItemByRef(IN _ref INT(10))
BEGIN
    SELECT ref, identVendeur, nom, prix, description, codeSousCat, dateMiseEnLigne FROM Item WHERE ref= _ref;
END //

CREATE PROCEDURE GetItemsByUser(IN _ident INT(10))
BEGIN
    SELECT ref, identVendeur, nom, prix, description, codeSousCat, dateMiseEnLigne FROM Item WHERE identVendeur = _ident;
END //

CREATE PROCEDURE GetLastItemUser(IN _ident INT(10))
BEGIN
    SELECT ref, identVendeur, nom, prix, description, codeSousCat, dateMiseEnLigne FROM Item WHERE identVendeur = _ident ORDER BY dateMiseEnLigne DESC, ref DESC LIMIT 1;
END //

CREATE PROCEDURE GetItemsByCategorie(IN _codeCat INT(10), IN _prixMin INT(10), IN _prixMax INT(10))
BEGIN
    SELECT ref, identVendeur, nom, prix, description, codeSousCat, dateMiseEnLigne 
    FROM Item inner join sousCategorie on item.codeSousCat = sousCategorie.code 
    inner Join Categorie on sousCategorie.codeCat = Categorie.code
    WHERE Categorie.code = _codeCat
    AND prix >= _prixMin 
    AND prix <= _prixMax;
END //

CREATE PROCEDURE GetItemsBySousCategorie(IN _codeSousCat INT(10), IN _prixMin INT(10), IN _prixMax INT(10))
BEGIN
    SELECT ref, identVendeur, nom, prix, description, codeSousCat, dateMiseEnLigne 
    FROM Item inner join sousCategorie on item.codeSousCat = sousCategorie.code 
    WHERE sousCategorie.code = _codeSousCat
    AND prix >= _prixMin 
    AND prix <= _prixMax;
END //

CREATE PROCEDURE GetItemsByRangePrix(IN _prixMin INT(10), IN _prixMax INT(10))
BEGIN
    SELECT ref, identVendeur, nom, prix, description, codeSousCat, dateMiseEnLigne 
    FROM Item 
    WHERE prix BETWEEN _prixMin AND _prixMax;
END //

CREATE PROCEDURE addItem(IN _identVendeur INT(10), IN _nom VARCHAR(255), IN _prix INT(10), IN _description TEXT, IN _codeSousCat INT(10))
BEGIN
    INSERT INTO Item (identVendeur, nom, prix, description, codeSousCat, dateMiseEnLigne) VALUES 
    (_identVendeur, _nom, _prix, _description, _codeSousCat, current_date());
END //

CREATE PROCEDURE deleteItem (IN _ref INT(10))
BEGIN
    DELETE FROM item WHERE ref = _ref;
END//

CREATE PROCEDURE updateItem (IN itemID INT(10), IN newItemName VARCHAR(255), IN newPrice INT(10), IN newDescription TEXT, IN newSubCategoryCode INT(10))
BEGIN
    UPDATE item
    SET nom = newItemName,
        prix = newPrice,
        description = newDescription,
        codeSousCat = newSubCategoryCode
    WHERE ref = itemID;
END//

-- USERS
CREATE PROCEDURE GetUsers()
BEGIN
    SELECT ident, pseudo, mail, mdp, date_inscription FROM User;
END //

CREATE PROCEDURE GetUserById(IN _ident INT(10))
BEGIN
    SELECT ident, pseudo, mail, mdp, date_inscription FROM User WHERE ident = _ident;
END //

CREATE PROCEDURE GetUserByMail(IN _mail VARCHAR(320))
BEGIN
    SELECT ident, pseudo, mail, mdp, date_inscription FROM User WHERE mail = _mail;
END //

CREATE PROCEDURE InsertUser(IN _pseudo VARCHAR(50), IN _mail VARCHAR(320), IN _mdp VARCHAR(255))
BEGIN
    INSERT INTO USER (pseudo, mail, mdp, date_inscription) VALUES (_pseudo, _mail, _mdp, current_date());
END //

CREATE PROCEDURE updateUser(IN _ident INT(10), IN _pseudo VARCHAR(50), IN _mail VARCHAR(320), IN _mdp VARCHAR(255))
BEGIN
    UPDATE User
    SET pseudo = _pseudo,
    mail = _mail,
    mdp = _mdp
    WHERE ident = _ident;
END //

CREATE PROCEDURE GetAdminIdent(IN _ident INT(10))
BEGIN
    SELECT admin.id, admin.ident, pseudo, mail, mdp, date_inscription 
    FROM User INNER JOIN Admin on user.ident = admin.ident 
    WHERE admin.ident = _ident;
END //

CREATE PROCEDURE deleteUser (IN _ident INT(10))
BEGIN
    DELETE FROM users WHERE ident = _ident;
END//

-- Conversations & MESSAGES
CREATE PROCEDURE GetConversationsUser(IN _ident INT(10))
BEGIN
    SELECT idConv, refItem, identAcheteur 
    FROM Conversation INNER JOIN Item on refItem = ref
    WHERE identAcheteur = _ident
    OR identVendeur = _ident;
END //

CREATE PROCEDURE GetMessagesConversation(IN _idConv INT(10))
BEGIN
    SELECT codeMess, idConv, message, identEnvoyeur, dateMess FROM Message WHERE idConv = _idConv;
END //

CREATE PROCEDURE createConversation(IN _refItem INT(10), IN _ident INT(10))
BEGIN
    INSERT INTO Conversation (refItem, identAcheteur) VALUES 
    (_refItem, _ident);
END //

CREATE PROCEDURE sendMessage(IN _idConv INT(10), IN _mess VARCHAR(200), IN _identEnvoyeur INT(10))
BEGIN
    INSERT INTO Message (idConv, message, identEnvoyeur, dateMess) VALUES (_idConv, _mess, _identEnvoyeur, current_date());
END //

-- Categories
CREATE PROCEDURE GetCats()
BEGIN
    SELECT code, libelle FROM Categorie;
END //

CREATE PROCEDURE GetCatByCode(IN _code INT(10))
BEGIN
    SELECT code, libelle FROM Categorie WHERE code = _code;
END //

CREATE PROCEDURE GetSousCats()
BEGIN
    SELECT code, codeCat, libelle FROM sousCategorie;
END //

CREATE PROCEDURE GetSousCatsByCat(IN _codeCat INT(10))
BEGIN
    SELECT code, codeCat, libelle FROM sousCategorie WHERE codeCat = _codeCat;
END //

CREATE PROCEDURE GetSousCatByCode(IN _code INT(10))
BEGIN
    SELECT code, codeCat, libelle FROM sousCategorie WHERE code = _code;
END //

CREATE PROCEDURE DeleteCat(IN _code INT(10))
BEGIN
    DELETE FROM Categorie WHERE code = _code;
END //

CREATE PROCEDURE UpdateCat(IN _code INT(10), IN _libelle VARCHAR(50))
BEGIN
    UPDATE Categorie
    SET libelle = _libelle
    WHERE code = _code;
END //

CREATE PROCEDURE DeleteSousCat(IN _code INT(10))
BEGIN
    DELETE FROM sousCategorie WHERE code = _code;
END //

CREATE PROCEDURE UpdateSousCat(IN _code INT(10), IN _codeCat INT(10), IN _libelle VARCHAR(50))
BEGIN
    UPDATE sousCategorie
    SET codeCat = _codeCat,
    libelle = _libelle
    WHERE code = _code;
END //
