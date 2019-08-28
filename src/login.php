<?php session_start();
//Variablen
$login_username = htmlspecialchars($_POST["login_username"]);
$login_pwd = htmlspecialchars($_POST["login_pwd"]);
$dsn = "mysql:host=localhost;dbname=kd58916_alkdb";
$user = "kd58916_root";
$password = "At452B7L9s";

try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    //Testen ob es den nutzer schon gibt
    $Stmt = $dbh->prepare("SELECT UserID, Username, Passwort, Code FROM benutzer WHERE Username = :username LIMIT 1");
    $Stmt->bindParam(":username", $login_username, PDO::PARAM_STR, 12);
    $Stmt->execute();

    $user = $Stmt->fetch();

    if ($user) {
        if ($user['Username'] == $login_username) {
          if(password_verify($login_pwd, $user['Passwort'])){
              $_SESSION['code'] = $user['Code'];
              $_SESSION['user'] = $login_username;
              echo 'true';
          } else {
            echo 'false';
          }
        } else {
          echo 'false';
        }
    } else {
        echo 'false';
    }

}
catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    die();
}
 ?>
