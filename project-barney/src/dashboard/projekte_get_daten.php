<?php

if(session_id() == ''){

    session_start();
}

$dsn = "mysql:host=localhost;dbname=alkdb";
$user = "root";
$password = "";

try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    //Testen ob es den nutzer schon gibt
    $selectStmt = $dbh->prepare("SELECT * FROM projekte WHERE projektid = :projektid");
    $selectStmt->bindParam(":projektid", $_POST['id'], PDO::PARAM_STR, 12);
    $selectStmt->execute();

    $projekte = $selectStmt->fetchAll();

    echo json_encode($projekte);

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    die();
}

?>
