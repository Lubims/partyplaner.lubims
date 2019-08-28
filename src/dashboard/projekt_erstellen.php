<?php

if(session_id() == ''){

    session_start();
}

//Variablen
$veranstaltung_name = htmlspecialchars($_POST["veranstaltung_name"]);
$veranstaltung_termin = htmlspecialchars($_POST["veranstaltung_termin"]);
$veranstaltung_uhrzeit = htmlspecialchars($_POST["veranstaltung_uhrzeit"]);
$veranstaltung_ort = htmlspecialchars($_POST["veranstaltung_ort"]);
$beschreibung = htmlspecialchars($_POST["beschreibung"]);
$dsn = "mysql:host=localhost;dbname=kd58916_alkdb";
$user = "kd58916_root";
$password = "At452B7L9s";

//Fügt ein Projekt in die db ein
try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $InsertStmt = $dbh->prepare("INSERT INTO projekte (ProjektName, Termin, Zeit, Ort, Beschreibung) VALUES(?, ?, ?, ?, ?)");
    $InsertStmt->execute([$veranstaltung_name, $veranstaltung_termin, $veranstaltung_uhrzeit,$veranstaltung_ort, $beschreibung]);

    $ID = $dbh->lastInsertId();


    $idStmt = $dbh->prepare("SELECT userid FROM benutzer WHERE username = :username LIMIT 1");
    $idStmt->bindParam(":username", $_SESSION['user'], PDO::PARAM_STR, 12);
    $idStmt->execute();
    $userID = $idStmt->fetch();

    $InsertStmt = $dbh->prepare("INSERT INTO projektuser (projektid, userid, zugesagt, besitzer) VALUES(?, ?, ?, ?)");
    $InsertStmt->execute([$ID, $userID['userid'],1,1]);

    header("Location: /php-2019/project-barney/src/dashboard/projekte.php");
    die();
  } catch (PDOException $e) {
      header("../error.html");
      die();
  }
?>
