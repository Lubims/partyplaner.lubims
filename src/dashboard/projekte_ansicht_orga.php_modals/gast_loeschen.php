<?php
session_start();
$dsn = $GLOBALS['db_address'];
$user = $GLOBALS['db_user'];
$password = $GLOBALS['db_pw'];

try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    //Testen ob es den nutzer schon gibt
    $Stmt = $dbh->prepare("DELETE FROM projektuser WHERE projektid = ? AND userid = ?");
    $Stmt->execute([intval($_POST['projektid']), intval($_POST['userid'])]);

    $Stmt = $dbh->prepare("DELETE FROM produktliste WHERE projektid = ? AND userid = ?");
    $Stmt->execute([intval($_POST['projektid']), intval($_POST['userid'])]);

    header("Location: ../projekt_ansicht_orga.php?projektid=".$_POST['projektid']);
    die();
}
catch (PDOException $e) {
    header("Location: ../error.html");
    die();
}
?>
