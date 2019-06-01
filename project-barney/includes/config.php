
<?php
if(session_id() == ''){

    session_start();
}
switch ($_SERVER["SCRIPT_NAME"]) {
  case    "/php-2019/project-barney/src/dashboard/profil.php":
          $CURRENT_PAGE = "Profil";
          $PAGE_TITLE = "Profil";
          if (!isset($_SESSION['user'])){
            header("Location: /php-2019/project-barney/");
            exit;
          }
          break;
  case    "/php-2019/project-barney/src/index_log.php":
          $CURRENT_PAGE = "IndexLog";
          $PAGE_TITLE = "Projekt Barney";
          if (!isset($_SESSION['user'])){
            header("Location: /php-2019/project-barney/");
            exit;
          }
          if($_SESSION['code'] != -1) {
            header("Location: /php-2019/project-barney/src/dashboard/profil.php");
            exit;
          }
          break;
  case    "/php-2019/project-barney/src/dashboard/projekte.php":
          $CURRENT_PAGE = "Projekte";
          $PAGE_TITLE = "Projekte";
          if (!isset($_SESSION['user'])){
            header("Location: /php-2019/project-barney/");
            exit;
          }
          if($_SESSION['code'] != -1) {
            header("Location: /php-2019/project-barney/src/dashboard/profil.php");
            exit;
          }
          break;
  case    "/php-2019/project-barney/src/dashboard/neue_projekte.php":
          $CURRENT_PAGE = "NeueProjekte";
          $PAGE_TITLE = "Neue Projekte";
          if (!isset($_SESSION['user'])){
            header("Location: /php-2019/project-barney/");
            exit;
          }
          if($_SESSION['code'] != -1) {
            header("Location: /php-2019/project-barney/src/dashboard/profil.php");
            exit;
          }
          break;
  case    "/php-2019/project-barney/src/freunde.php":
          $CURRENT_PAGE = "Freunde";
          $PAGE_TITLE = "Freunde";
          if (!isset($_SESSION['user'])){
            header("Location: /php-2019/project-barney/");
            exit;
          }
          if($_SESSION['code'] != -1) {
            header("Location: /php-2019/project-barney/src/dashboard/profil.php");
            exit;
          }
          break;
  case    "/php-2019/project-barney/src/profil_bearbeiten.php":
          $CURRENT_PAGE = "ProfilBearbeiten";
          $PAGE_TITLE = "Profil Bearbeiten";
          if (!isset($_SESSION['user'])){
            header("Location: /php-2019/project-barney/");
            exit;
          }
          if($_SESSION['code'] != -1) {
            header("Location: /php-2019/project-barney/src/dashboard/profil.php");
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

    function getFriendData(){
      $dsn = "mysql:host=localhost;dbname=alkdb";
      $user = "root";
      $password = "";

      try {
          $dbh = new PDO($dsn, $user, $password);
          $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
          //Testen ob es den nutzer schon gibt
          $testStmt = $dbh->prepare("SELECT Username FROM benutzer WHERE UserID IN (SELECT User2ID FROM freunde WHERE User1ID = (SELECT UserID FROM benutzer WHERE Username = :username))");
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
