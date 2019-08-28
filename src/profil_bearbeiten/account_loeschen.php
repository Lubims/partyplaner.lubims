<?php
session_start();
$dsn = "mysql:host=localhost;dbname=alkdb";
$user = "root";
$password = "";

try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    $Stmt = $dbh->prepare("SELECT userid FROM benutzer WHERE username = :username");
    $Stmt->bindParam(":username", $_SESSION['user'], PDO::PARAM_STR, 12);
    $Stmt->execute();
    $userid = $Stmt->fetch();

    $Stmt = $dbh->prepare("DELETE FROM produktliste WHERE userid = ?");
    $Stmt->execute([$userid['userid']]);

    $Stmt = $dbh->prepare("DELETE FROM freunde WHERE user1id = ? OR user2id = ?");
    $Stmt->execute([$userid['userid'], $userid['userid']]);

    $Stmt = $dbh->prepare("DELETE FROM projektuser WHERE userid = ?");
    $Stmt->execute([$userid['userid']]);

    $Stmt = $dbh->prepare("DELETE FROM benutzer WHERE Username = ?");
    $Stmt->execute([$_SESSION['user']]);

    echo 'Success';
    header("Location: ../logout.php");
    die();
}
catch (PDOException $e) {
    header("Location: ../error.html");
    die();
}
?>
