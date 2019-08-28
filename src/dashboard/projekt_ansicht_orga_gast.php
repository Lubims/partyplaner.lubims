<?php
if(session_id() == ''){

    session_start();
}

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

    if($gastIDDB){



      $Stmt = $dbh->prepare("SELECT userid FROM projektuser WHERE userid = :gastID AND projektid = :projektid");
      $Stmt->bindParam(":gastID", $gastID, PDO::PARAM_STR, 12);
      $Stmt->bindParam(":projektid", $projektID, PDO::PARAM_STR, 12);
      $Stmt->execute();

      $projektUser = $Stmt->fetch();

      if ($Stmt->rowcount() > 0) {
        echo 'false_inprojekt';
      }else{
        $Stmt = $dbh->prepare("INSERT INTO projektuser (projektid, userid, besitzer, zugesagt) VALUES(:projektID, :gastID, 0, 0)");
        $Stmt->bindParam(":projektID", $projektID, PDO::PARAM_STR, 12);
        $Stmt->bindParam(":gastID", $gastID, PDO::PARAM_STR, 12);
        $Stmt->execute();

        echo 'true';
      }
    }else{
      echo 'false_exists';
    }
}
catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    die();
}

 ?>
