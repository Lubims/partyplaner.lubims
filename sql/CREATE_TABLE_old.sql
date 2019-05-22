CREATE DATABASE  AlkDB;

CREATE TABLE Produkte (
	ProduktID INT NOT NULL AUTO_INCREMENT,
	Name VARCHAR(20) NOT NULL,
	Firma VARCHAR(30) NOT NULL,
	Beschreibung VARCHAR(500),
	AlkWert DECIMAL(3,1) NOT NULL,

	PRIMARY KEY (ProduktID)
);

CREATE TABLE Benutzer (
	UserID INT NOT NULL AUTO_INCREMENT,
	Username VARCHAR(20) NOT NULL,
	Email VARCHAR(50) NOT NULL,
	New_Email VARCHAR(50),
	Passwort VARCHAR(255) NOT NULL,
	Code VARCHAR(6),
	NewEmail_Code VARCHAR(6),

	PRIMARY KEY (UserID)
);

CREATE TABLE Freunde (
	User1ID INT NOT NULL,
	User2ID INT NOT NULL,

	PRIMARY KEY (User1ID, User2ID),
	FOREIGN KEY (User1ID) REFERENCES Benutzer(UserID),
	FOREIGN KEY (User2ID) REFERENCES Benutzer(UserID)
);

CREATE TABLE Projekte (
	ProjektID INT NOT NULL AUTO_INCREMENT,
	ProjektName VARCHAR(30) NOT NULL,
	Termin DATE NOT NULL,
	Zeit VARCHAR(30) NOT NULL,
	Beschreibung VARCHAR(500),

	PRIMARY KEY (ProjektID)
);

CREATE TABLE ProjektUser(
	ProjektID INT NOT NULL,
	UserID INT NOT NULL,
	Besitzer BOOLEAN,

	PRIMARY KEY (ProjektID, UserID),
	FOREIGN KEY (ProjektID) REFERENCES Projekte(ProjektID),
	FOREIGN KEY (UserID) REFERENCES Benutzer(UserID)
);

CREATE TABLE Produktliste(
ProjekteID INT NOT NULL,
ProduktID INT NOT NULL,

PRIMARY KEY (ProjekteID, ProduktID),
FOREIGN KEY (ProduktID) REFERENCES Produkte(ProduktID),
FOREIGN KEY (ProjekteID) REFERENCES Projekte(ProjektID)
);