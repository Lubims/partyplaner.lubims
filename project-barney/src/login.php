<?php session_start();
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
    $Stmt = $dbh->prepare("SELECT Username, Passwort, Code FROM benutzer WHERE Username = :username LIMIT 1");
    $Stmt->bindParam(":username", $login_username, PDO::PARAM_STR, 12);
    $Stmt->execute();

    $user = $Stmt->fetch();

    if ($user) {
        if ($user['Username'] == $login_username) {
          if(password_verify($login_pwd, $user['Passwort'])){
            if(isset($user['Code'])){
              $_SESSION['code'] = $user['Code'];
            }
              $_SESSION['user'] = $login_username;
              header("Location: index_log.php");
              echo "string";
              exit;
          }
            else{
              header('Location: ../index.php');
              exit;
            }
        }else{
          header('Location: ../index.php');
          exit;
        }
    }
    else {
        header('Location: ../index.php');
    }

}
catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    die();
}
 ?>
