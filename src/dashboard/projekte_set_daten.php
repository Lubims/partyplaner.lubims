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
    $selectStmt = $dbh->prepare("UPDATE projekte SET projektname = ?, termin = ?, zeit = ?, ort = ?, beschreibung = ? WHERE projektid = ?");
    $selectStmt->execute([htmlspecialchars($_POST['veranstaltungsname_neu']), htmlspecialchars($_POST['termin_neu']), htmlspecialchars($_POST['uhrzeit_neu']), htmlspecialchars($_POST['ort_neu']), htmlspecialchars($_POST['beschreibung_neu']), htmlspecialchars($_POST['projektid'])]);

    header("Location: projekte.php?projektid=".htmlspecialchars($_POST['projektid']));
    die();

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    die();
}

?>
