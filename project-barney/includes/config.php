
<?php
switch ($_SERVER["SCRIPT_NAME"]) {
  case    "/project-barney/src/profil.php":
          $CURRENT_PAGE = "Profil";
          $PAGE_TITLE = "Das ist das Profil";
          break;

  default:
    			$CURRENT_PAGE = "Index";
    			$PAGE_TITLE = "Titel der Seite";

    }
?>
