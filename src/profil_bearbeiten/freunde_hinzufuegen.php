<?php session_start();

$dsn = "mysql:host=localhost;dbname=kd58916_alkdb";
$user = "kd58916_root";
$password = "At452B7L9s";
$freund = htmlspecialchars($_POST["freund_username"]);

try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    //Testen ob es den nutzer schon gibt

    $Stmt = $dbh->prepare("SELECT userid FROM benutzer WHERE username = :username LIMIT 1");
    $Stmt->bindParam(":username", $freund, PDO::PARAM_STR, 12);
    $Stmt->execute();
    $ID = $Stmt->fetch();
    if ($ID) {
      $freundID = $ID["userid"];

      $Stmt = $dbh->prepare("SELECT userid FROM benutzer WHERE username = :username LIMIT 1");
      $Stmt->bindParam(":username", $_SESSION['user'], PDO::PARAM_STR, 12);
      $Stmt->execute();
      $ID = $Stmt->fetch();
      if ($ID) {
        $userID = $ID["userid"];
      }
      if($userID == $freundID){
        echo 'false_own_user';
      }else{
        $Stmt = $dbh->prepare("SELECT * FROM Freunde WHERE user1id = :userID AND user2id = :freundID");
        $Stmt->bindParam(":userID", $userID, PDO::PARAM_STR, 12);
        $Stmt->bindParam(":freundID", $freundID, PDO::PARAM_STR, 12);
        $Stmt->execute();
        $freunde = $Stmt->fetch();

        if($freunde){
          echo 'false_exists';
        }else{
          $Stmt = $dbh->prepare("INSERT INTO Freunde(user1id, user2id) VALUES (:userID,:freundID)");
          $Stmt->bindParam(":userID", $userID, PDO::PARAM_STR, 12);
          $Stmt->bindParam(":freundID", $freundID, PDO::PARAM_STR, 12);
          $Stmt->execute();
          echo 'true';
        }
      }
    }else{
      echo 'false_not_exists';
    }

} catch (PDOException $e) {
    header("Location: ../error.html");
}

die();
?>
