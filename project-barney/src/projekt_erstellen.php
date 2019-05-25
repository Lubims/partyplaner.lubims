<?php

if(session_id() == ''){

    session_start();
}

//Variablen
$veranstaltung_name = htmlspecialchars($_POST["veranstaltung_name"]);
$veranstaltung_termin = htmlspecialchars($_POST["veranstaltung_termin"]);
$veranstaltung_uhrzeit = htmlspecialchars($_POST["veranstaltung_uhrzeit"]);
$beschreibung = htmlspecialchars($_POST["beschreibung"]);
$dsn = "mysql:host=localhost; dbname=alkdb";
$user = "root";
$password = "";

try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $InsertStmt = $dbh->prepare("INSERT INTO projekte (ProjektName, Termin, Zeit, Beschreibung) VALUES(?, ?, ?, ?)");
    $InsertStmt->execute([$veranstaltung_name, $veranstaltung_termin, $veranstaltung_uhrzeit, $beschreibung]);

    $ID = $dbh->lastInsertId();

    echo $ID;

    $InsertStmt = $dbh->prepare("INSERT INTO projektuser (ProjektName, Termin, Zeit, Beschreibung) VALUES(?, ?, ?, ?)");
  } catch (PDOException $e) {
      header("../error.html");
      die();
  }
?>
