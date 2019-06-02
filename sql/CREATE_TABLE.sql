CREATE DATABASE  alkdb;

CREATE TABLE produkte (
	produktid INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(20) NOT NULL,

	PRIMARY KEY (produktid)
);

CREATE TABLE benutzer (
	userid INT NOT NULL AUTO_INCREMENT,
	username VARCHAR(20) NOT NULL,
	email VARCHAR(50) NOT NULL,
	new_email VARCHAR(50),
	passwort VARCHAR(255) NOT NULL,
	code VARCHAR(6),
	newemail_code VARCHAR(6),

	PRIMARY KEY (userid)
);

CREATE TABLE freunde (
	user1id INT NOT NULL,
	user2id INT NOT NULL,

	PRIMARY KEY (user1id, user2id),
	FOREIGN KEY (user1id) REFERENCES benutzer(userid),
	FOREIGN KEY (user2id) REFERENCES benutzer(userid)
);

CREATE TABLE projekte (
	projektid INT NOT NULL AUTO_INCREMENT,
	projektname VARCHAR(30) NOT NULL,
	termin DATE NOT NULL,
	zeit VARCHAR(30) NOT NULL,
	ort VARCHAR(30),
	beschreibung VARCHAR(500),

	PRIMARY KEY (projektid)
);

CREATE TABLE projektuser(
	projektid INT NOT NULL,
	userid INT NOT NULL,
	besitzer BOOLEAN,
	zugesagt BOOLEAN,

	PRIMARY KEY (projektid, userid),
	FOREIGN KEY (projektid) REFERENCES projekte(projektid),
	FOREIGN KEY (userid) REFERENCES benutzer(userid)
);

CREATE TABLE produktliste(
projektid INT NOT NULL,
userid INT NOT NULL,
produktid INT NOT NULL,
menge INT NOT NULL,

PRIMARY KEY (projektid, produktid, userid),
FOREIGN KEY (produktid) REFERENCES produkte(produktid),
FOREIGN KEY (userid) REFERENCES benutzer(userid),
FOREIGN KEY (projektid) REFERENCES projekte(projektid)
);
