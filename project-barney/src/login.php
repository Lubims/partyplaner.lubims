<?php
//Variablen
$login_username = htmlspecialchars($_POST["login_username"]);
$login_pwd = htmlspecialchars($_POST["login_pwd"]);
$dsn = "mysql:host=localhost;dbname=alkdb";
$user = "root";
$password = "";

try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    //Testen ob es den nutzer schon gibt
    $testStmt = $dbh->prepare("SELECT Username, Passwort FROM benutzer WHERE Username = :username LIMIT 1");
    $testStmt->bindParam(":username", $signup_username, PDO::PARAM_STR, 12);
    $testStmt->execute();

    $user = $testStmt->fetch();

    if ($user) {
        if ($user['Username'] === $signup_username) {
          if(password_verify($login_pwd, $user['Passwort'])){
              header("Location: profil.php");
          }
            else{
              echo "<script type='text/javascript'>alert('Falsches Passwort');</script>";
              header('Location: ../index.php');
              exit;
            }
        }
    }
    else {
      echo "<script type='text/javascript'>alert('Diesen User gibt es nicht');</script>";
      header('Location: ../index.php');
      exit;
    }

}
catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    die();
}
 ?>
