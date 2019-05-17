<?php
session_start();
$dsn = "mysql:host=localhost;dbname=alkdb";
$user = "root";
$password = "";

try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    //Testen ob es den nutzer schon gibt
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
