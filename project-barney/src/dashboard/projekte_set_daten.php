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
    $selectStmt = $dbh->prepare("UPDATE projekte SET projektname = ?, termin = ?, zeit = ?, ort = ?, beschreibung = ? WHERE projektid = ?");
    $selectStmt->execute([$_POST['veranstaltungsname_neu'], $_POST['termin_neu'], $_POST['uhrzeit_neu'], $_POST['ort_neu'], $_POST['beschreibung_neu'], $_POST['projektid']]);

    header("Location: projekte.php");
    die();

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    die();
}

?>
