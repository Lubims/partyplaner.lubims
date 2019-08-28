<?php
session_start();
$dsn = "mysql:host=localhost;dbname=kd58916_alkdb";
$user = "kd58916_root";
$password = "At452B7L9s";

try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    //Testen ob es den nutzer schon gibt
    $Stmt = $dbh->prepare("DELETE FROM produktliste WHERE projektid = ?");
    $Stmt->execute([intval($_POST['projektid'])]);
    $Stmt = $dbh->prepare("DELETE FROM projektuser WHERE projektid = ?");
    $Stmt->execute([intval($_POST['projektid'])]);
    $Stmt = $dbh->prepare("DELETE FROM projekte WHERE projektid = ?");
    $Stmt->execute([intval($_POST['projektid'])]);

    header("Location: ../projekte.php");
    die();
}
catch (PDOException $e) {
    header("Location: ../error.html");
    die();
}
?>
