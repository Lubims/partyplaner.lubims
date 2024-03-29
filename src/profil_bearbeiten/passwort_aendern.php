<?php session_start();

$dsn = $GLOBALS['db_address'];
$user = $GLOBALS['db_user'];
$password = $GLOBALS['db_pw'];

$old_pwd = htmlspecialchars($_POST["old_pwd"]);
$new_pwd = htmlspecialchars($_POST["new_pwd"]);

try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    $Stmt = $dbh->prepare("SELECT Passwort FROM Benutzer WHERE Username = ?");
    $Stmt->execute([$_SESSION['user']]);

    $pwd = $Stmt->fetch();

    if(password_verify($old_pwd, $pwd['Passwort'])) {
      //Update des Passworts
      $Stmt = $dbh->prepare("UPDATE benutzer SET Passwort = ? WHERE Username = ?");
      $Stmt->execute([password_hash($new_pwd, PASSWORD_BCRYPT), $_SESSION['user']]);

      echo 'true';
    } else {
      echo 'false';
    }
}
catch (PDOException $e) {
    echo 'error';
}
?>
