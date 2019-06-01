<?php
session_start();
$dsn = "mysql:host=localhost;dbname=alkdb";
$user = "root";
$password = "";

try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    //Testen ob es den nutzer schon gibt
    //$Stmt = $dbh->prepare("DELETE FROM produktliste WHERE projektid = ?");
    //$Stmt->execute([intval($_POST['projektid'])]);
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
