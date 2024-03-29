<?php

if(session_id() == ''){

    session_start();
}


$dsn = $GLOBALS['db_address'];
$user = $GLOBALS['db_user'];
$password = $GLOBALS['db_pw'];


try {

    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    //Testen ob es den nutzer schon gibt
    $Stmt = $dbh->prepare("DELETE FROM projektuser WHERE projektid = :projektid AND userid = (SELECT userid FROM benutzer WHERE username = :username)");
    $Stmt->bindParam(":username",$_POST['userid'], PDO::PARAM_STR, 12);
    $Stmt->bindParam(":projektid",intval($_POST['projektid']), PDO::PARAM_STR, 12);
    $Stmt->execute();

    $Stmt = $dbh->prepare("DELETE FROM produktliste WHERE projektid = :projektid AND userid = (SELECT userid FROM benutzer WHERE username = :username)");
    $Stmt->bindParam(":username",$_POST['userid'], PDO::PARAM_STR, 12);
    $Stmt->bindParam(":projektid",intval($_POST['projektid']), PDO::PARAM_STR, 12);
    $Stmt->execute();
    echo "true";
}
catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    die();
}

 ?>
