<?php

$gast = htmlspecialchars($_POST["gast"]);
$projektID = htmlspecialchars($_POST["projektid"]);
$dsn = "mysql:host=localhost; dbname=alkdb";
$user = "root";
$password = "";


try {

    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    //Testen ob es den nutzer schon gibt
    $Stmt = $dbh->prepare("SELECT userid FROM benutzer WHERE username = :gast");
    $Stmt->bindParam(":gast", $gast, PDO::PARAM_STR, 12);
    $Stmt->execute();
    $gastIDDB = $Stmt->fetch();
    $gastID = $gastIDDB['userid'];



    $Stmt = $dbh->prepare("SELECT userid FROM projektuser WHERE userid = :gastID AND projektid = :projektid");
    $Stmt->bindParam(":gastID", $gastID, PDO::PARAM_STR, 12);
    $Stmt->bindParam(":projektid", $gastID, PDO::PARAM_STR, 12);
    $Stmt->execute();

    $prjektUser = $Stmt->fetch();

    if ($prjektUser) {
        if ($prjektUser['userid'] == $gastID) {
          header("Location: projekt_ansicht_orga.php?projektid=".$projektID);
        }else{
          $Stmt = $dbh->prepare("INSERT INTO projektuser (projektid, userid, besitzer, zugesagt) VALUES(?, ?, ?, ?)");
          $Stmt->execute($projektID, $gastID, 0, 0);

          header("Location: projekt_ansicht_orga.php?projektid=".$projektID);
        }

      }
}
catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    die();
}
 ?>
