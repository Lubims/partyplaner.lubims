<?php

if(session_id() == ''){

    session_start();
}


$dsn = "mysql:host=localhost;dbname=kd58916_alkdb";
$user = "kd58916_root";
$password = "At452B7L9s";


try {

    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    //Testen ob es den nutzer schon gibt
    $Stmt = $dbh->prepare("UPDATE projektuser SET zugesagt = 1 WHERE projektid = :projektid AND userid = (SELECT userid FROM benutzer WHERE username = :username)");
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
