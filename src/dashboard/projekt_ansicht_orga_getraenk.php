<?php
if(session_id() == ''){

    session_start();
}

$getraenk = htmlspecialchars($_POST["getraenk"]);
$menge = htmlspecialchars($_POST["menge"]);
$projektID = htmlspecialchars($_POST["projektid"]);
$dsn = "mysql:host=localhost;dbname=kd58916_alkdb";
$user = "kd58916_root";
$password = "At452B7L9s";


if(is_numeric($menge)){

  $menge = $menge * 100;
//  $menge = str_replace(',', '.',htmlspecialchars($_POST["menge"])) * 100;

  try {

      $dbh = new PDO($dsn, $user, $password);
      $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
      //Testen ob es den nutzer schon gibt
      $Stmt = $dbh->prepare("SELECT userid FROM benutzer WHERE username = :username");
      $Stmt->bindParam(":username", $_SESSION['user'], PDO::PARAM_STR, 12);
      $Stmt->execute();
      $userIDDB = $Stmt->fetch();
      $userID = $userIDDB['userid'];

      $Stmt = $dbh->prepare("SELECT produktid FROM produkte WHERE name = :getraenk");
      $Stmt->bindParam(":getraenk", $getraenk, PDO::PARAM_STR, 12);
      $Stmt->execute();
      $getraenkIDDB = $Stmt->fetch();
      $getraenkID = $getraenkIDDB['produktid'];

      if($getraenkIDDB){

        $Stmt = $dbh->prepare("SELECT menge FROM produktliste WHERE projektID = :projektID AND produktID = :getraenkID AND userID = :userid");
        $Stmt->bindParam(":projektID", $projektID, PDO::PARAM_STR, 12);
        $Stmt->bindParam(":getraenkID", $getraenkID, PDO::PARAM_STR, 12);
        $Stmt->bindParam(":userid", $userID, PDO::PARAM_STR, 12);
        $Stmt->execute();

        $alteMenge = $Stmt->fetch();
        if($Stmt->rowcount() > 0){

          $menge = $alteMenge['menge'] + $menge;

        $Stmt = $dbh->prepare("UPDATE produktliste SET menge = :menge WHERE projektid = :projektID AND userid = :userID AND produktid = :getraenkID");
          $Stmt->bindParam(":projektID", $projektID, PDO::PARAM_STR, 12);
          $Stmt->bindParam(":getraenkID", $getraenkID, PDO::PARAM_STR, 12);
          $Stmt->bindParam(":userID", $userID, PDO::PARAM_STR, 12);
          $Stmt->bindParam(":menge", $menge, PDO::PARAM_STR, 12);
          $Stmt->execute();
          echo 'true';

        }else{
        $Stmt = $dbh->prepare("INSERT INTO produktliste (projektid, userid, produktid, menge) VALUES(:projektID, :userID, :getraenkID, :menge)");
          $Stmt->bindParam(":projektID", $projektID, PDO::PARAM_STR, 12);
          $Stmt->bindParam(":getraenkID", $getraenkID, PDO::PARAM_STR, 12);
          $Stmt->bindParam(":userID",$userID, PDO::PARAM_STR, 12);
          $Stmt->bindParam(":menge", $menge, PDO::PARAM_STR, 12);
          $Stmt->execute();
          echo 'true';
        }
      }else{
        $Stmt = $dbh->prepare("INSERT INTO produkte (name) VALUES(:getraenk)");
        $Stmt->bindParam(":getraenk", $getraenk, PDO::PARAM_STR, 12);
        $Stmt->execute();

        $getraenkID = $dbh->lastInsertId();

        $Stmt = $dbh->prepare("INSERT INTO produktliste (projektid, userid, produktid, menge) VALUES(:projektID, :userID, :getraenkID, :menge)");
        $Stmt->bindParam(":projektID", $projektID, PDO::PARAM_STR, 12);
        $Stmt->bindParam(":getraenkID", $getraenkID, PDO::PARAM_STR, 12);
        $Stmt->bindParam(":userID", $userID, PDO::PARAM_STR, 12);
        $Stmt->bindParam(":menge", $menge, PDO::PARAM_STR, 12);
        $Stmt->execute();
        echo 'true';

      }
    }
  catch (PDOException $e) {
      echo 'Connection failed: ' . $e->getMessage();
      die();
  }
} else {
  echo 'false_numeric';
}
 ?>
