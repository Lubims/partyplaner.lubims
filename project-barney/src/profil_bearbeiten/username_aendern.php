<?php
$dsn = "mysql:host=localhost;dbname=alkdb";
$user = "root";
$password = "";

try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    //Testen ob es den nutzer schon gibt
    $Stmt = $dbh->prepare("UPDATE benutzer SET Username = ? WHERE Username = ?");
    $Stmt->execute([$_POST['new_username'], $_SESSION['user']]);

    echo 'Success';
    header("Location: ../profil_bearbeiten.php");
    die();
}
catch (PDOException $e) {
    header("Location: ../error.html");
    die();
}
?>
