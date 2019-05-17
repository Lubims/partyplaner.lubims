<?php
$dsn = "mysql:host=localhost;dbname=alkdb";
$user = "root";
$password = "";

try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    //Testen ob es den nutzer schon gibt
    $Stmt = $dbh->prepare("UPDATE benutzer SET Passwort = ? WHERE Username = ?");
    $Stmt->execute([password_hash($_POST['new_pwd'], PASSWORD_BCRYPT), $_SESSION['user']]);

    echo 'Success';
    header("Location: ../profil_bearbeiten.php");
    die();
}
catch (PDOException $e) {
    header("Location: ../error.html");
    die();
}
?>
