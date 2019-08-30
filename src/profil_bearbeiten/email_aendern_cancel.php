<?php session_start();
/* Connect to a MySQL database using driver invocation */
if(session_id() == ''){
    session_start();
}
/* Connect to a MySQL database using driver invocation */
//Variablen
$dsn = "mysql:host=localhost:3306;dbname=kd58916_alkdb";
$user = "kd58916_root";
$password = "At452B7L9s";
try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $UpdateStmt = $dbh->prepare("UPDATE benutzer SET new_email = ?, newemail_code = ? WHERE Username = ?");
    $UpdateStmt->execute([NULL, NULL, $_SESSION['user']]);
    unset($_SESSION['new_email']);
    unset($_SESSION['newemail_code']);
    header("Location: ../profil_bearbeiten.php");
} catch (PDOException $e) {
    header("Location: ../error.html");
}
 die();
?>
