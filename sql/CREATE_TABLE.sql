CREATE TABLE Produkte (
	ProduktID INT NOT NULL,
	Name VARCHAR(20) NOT NULL,
	Firma VARCHAR(30) NOT NULL,
	Beschreibung VARCHAR(500),
	AlkWert DECIMAL(3,1) NOT NULL,

	PRIMARY KEY (ProduktID)
);

CREATE TABLE Benutzer (
	UserID INT NOT NULL,
	Username VARCHAR(20) NOT NULL,
	Passwort VARCHAR(20) NOT NULL,

	PRIMARY KEY (UserID)
);

CREATE TABLE Warenkorb (
	UserID INT NOT NULL,
	ProduktID INT NOT NULL,
	AnzahlProdukt INT NOT NULL,

	PRIMARY KEY (UserID, ProduktID),
	FOREIGN KEY (ProduktID) REFERENCES Produkte(ProduktID),
	FOREIGN KEY (UserID) REFERENCES Benutzer(UserID)
);

CREATE TABLE Historie (
	UserID INT NOT NULL,
	ProduktID INT NOT NULL,
	AnzahlProdukt INT NOT NULL,
	DatumGekauft DATE NOT NULL,
	IstGekauft BIT NOT NULL,

	PRIMARY KEY (UserID, ProduktID),
	FOREIGN KEY (ProduktID) REFERENCES Produkte(ProduktID),
	FOREIGN KEY (UserID) REFERENCES Benutzer(UserID)
);