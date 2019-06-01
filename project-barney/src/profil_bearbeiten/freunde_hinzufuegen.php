<?php session_start();

$new_username = $_POST["new_username"];
$dsn = "mysql:host=localhost; dbname=alkdb";
$user = "root";
$password = "";
$freund = htmlspecialchars($_POST["freund_usernam"]);

try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    //Testen ob es den nutzer schon gibt

    $Stmt = $dbh->prepare("SELECT userid FROM benutzer WHERE username = :username LIMIT 1");
    $Stmt->bindParam(":username", $_SESSION['user'], PDO::PARAM_STR, 12);
    $Stmt->execute();
    $ID = $Stmt->fetch();
    if ($ID) {
      $userID = $ID["userid"];
    }

    $Stmt = $dbh->prepare("SELECT userid FROM benutzer WHERE username = :username LIMIT 1");
    $Stmt->bindParam(":username", $freund, PDO::PARAM_STR, 12);
    $Stmt->execute();
    $ID = $Stmt->fetch();
    if ($ID) {
      $freundID = $ID["userid"];
    }

    Stmt = $dbh->prepare("INSERT INTO Freunde(user1id, user2id) VALUES (?,?)");
    $Stmt->execute($userID,$freundID);

} catch (PDOException $e) {
    header("Location: ../error.html");
}

die();
?>
