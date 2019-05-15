
<?php
if(session_id() == ''){

    session_start();
}
switch ($_SERVER["SCRIPT_NAME"]) {
  case    "/php-2019/project-barney/src/dashboard/profil.php":
          $CURRENT_PAGE = "Profil";
          $PAGE_TITLE = "Das ist das Profil";
          if (!isset($_SESSION['user'])){
            header("Location: /php-2019/project-barney/");
            exit;
          }
          break;
  case    "/php-2019/project-barney/src/index_log.php":
          $CURRENT_PAGE = "IndexLog";
          $PAGE_TITLE = "Index aber jetzt eingelogt";
          if (!isset($_SESSION['user'])){
            header("Location: /php-2019/project-barney/");
            exit;
          }
          break;
  default:
    			$CURRENT_PAGE = "Index";
    			$PAGE_TITLE = "Titel der Seite";

    }

    function getUserData(){
      $dsn = "mysql:host=localhost;dbname=alkdb";
      $user = "root";
      $password = "";

      try {
          $dbh = new PDO($dsn, $user, $password);
          $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
          //Testen ob es den nutzer schon gibt
          $testStmt = $dbh->prepare("SELECT Username, Email FROM benutzer WHERE Username = :username LIMIT 1");
          $testStmt->bindParam(":username", $_SESSION['user'], PDO::PARAM_STR, 12);
          $testStmt->execute();

          $user = $testStmt->fetch();

        return($user);

      } catch (PDOException $e) {
          echo 'Connection failed: ' . $e->getMessage();
          die();
      }
    }
?>
