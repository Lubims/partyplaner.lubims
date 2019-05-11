
<?php
if(session_id() == ''){

    session_start();
}
switch ($_SERVER["SCRIPT_NAME"]) {
  case    "/php-2019/project-barney/src/profil.php":
          $CURRENT_PAGE = "Profil";
          $PAGE_TITLE = "Das ist das Profil";
          break;
  case    "/php-2019/project-barney/src/index_log.php":
          $CURRENT_PAGE = "IndexLog";
          $PAGE_TITLE = "Index aber jetzt eingelogt";
          if (!isset($_SESSION['user'])){
            header("Location: /project-barney");
            exit;
          }
          break;
  default:
    			$CURRENT_PAGE = "Index";
    			$PAGE_TITLE = "Titel der Seite";

    }
?>
