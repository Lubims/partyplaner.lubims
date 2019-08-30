
<?php
if(session_id() == ''){

    session_start();
}

//Prüft ob der Nutzer eingelogt ist
//ist das nicht der fall wird er auf die Startseite weitergeleitet
switch ($_SERVER["SCRIPT_NAME"]) {
  case    "/src/dashboard/profil.php":
          $CURRENT_PAGE = "Profil";
          $PAGE_TITLE = "Profil";
          if (!isset($_SESSION['user'])){
            header("Location: /");
            exit;
          }
          break;
  case    "/src/index_log.php":
          $CURRENT_PAGE = "IndexLog";
          $PAGE_TITLE = "Projekt Barney";
          if (!isset($_SESSION['user'])){
            header("Location: /");
            exit;
          }
          if($_SESSION['code'] != -1) {
            header("Location: /src/dashboard/profil.php");
            exit;
          }
          break;
  case    "/src/dashboard/projekte.php":
          $CURRENT_PAGE = "Projekte";
          $PAGE_TITLE = "Projekte";
          if (!isset($_SESSION['user'])){
            header("Location: /");
            exit;
          }
          if($_SESSION['code'] != -1) {
            header("Location: /src/dashboard/profil.php");
            exit;
          }
          break;
  case    "/src/dashboard/neue_projekte.php":
          $CURRENT_PAGE = "NeueProjekte";
          $PAGE_TITLE = "Neue Projekte";
          if (!isset($_SESSION['user'])){
            header("Location: /");
            exit;
          }
          if($_SESSION['code'] != -1) {
            header("Location: /src/dashboard/profil.php");
            exit;
          }
          break;
  case    "/src/freunde.php":
          $CURRENT_PAGE = "Freunde";
          $PAGE_TITLE = "Freunde";
          if (!isset($_SESSION['user'])){
            header("Location: /");
            exit;
          }
          if($_SESSION['code'] != -1) {
            header("Location: /src/dashboard/profil.php");
            exit;
          }
          break;
  case    "/src/profil_bearbeiten.php":
          $CURRENT_PAGE = "ProfilBearbeiten";
          $PAGE_TITLE = "Profil Bearbeiten";
          if (!isset($_SESSION['user'])){
            header("Location: /");
            exit;
          }
          if($_SESSION['code'] != -1) {
            header("Location: /src/dashboard/profil.php");
            exit;
          }
          break;
  default:
    			$CURRENT_PAGE = "Index";
    			$PAGE_TITLE = "Lubims Partyplaner";

    }

//Funktion um die Daten über einen Nutzer zu bekommen
    function getUserData(){
      $dsn = "mysql:host=localhost:3306;dbname=kd58916_alkdb";
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

//Funktion um die Daten über die Freunde zu bekommen
    function getFriendData(){
      $dsn = "mysql:host=localhost:3306;dbname=kd58916_alkdb";
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
