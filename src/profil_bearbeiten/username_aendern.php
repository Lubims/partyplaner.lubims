<?php session_start();

$new_username = htmlspecialchars($_POST["new_username"]);
$dsn = $GLOBALS['db_address'];
$user = $GLOBALS['db_user'];
$password = $GLOBALS['db_pw'];

try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    //Testen ob es den nutzer schon gibt
    $Stmt1 = $dbh->prepare("SELECT Username FROM benutzer WHERE Username = ?");
    $Stmt1->execute([$new_username]);
    $userExists = $Stmt1->fetch();

    if ($userExists) {
      echo 'false_exists';
    } else {
      $Stmt2 = $dbh->prepare("SELECT Username FROM benutzer WHERE username = ?");
      $Stmt2->execute([$_SESSION['user']]);
      $user = $Stmt2->fetch();
      if($user['Username'] === $new_username) {
        echo 'false_same';
      } else {
        //Update in die db
        $UpdateStmt = $dbh->prepare("UPDATE benutzer SET Username = ? WHERE Username = ?");
        $UpdateStmt->execute([$new_username, $_SESSION['user']]);
        $_SESSION['user'] = $new_username;
        echo 'true';
      }
  }
} catch (PDOException $e) {
    header("Location: ../error.html");
}

die();
?>
